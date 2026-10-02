<?php
namespace App\Http\Controllers\Admin;
use App\Models\AbuseReport;
use App\Models\Asset;
use App\Models\Feed;
use App\Models\User;
use App\Services\AdminAudit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AbuseReportManagement
{
    public function index(Request $request): View
    {
        $status = $request->query('status', 'open');
        $query = AbuseReport::query()->with(['reporter:id,username', 'place:id,name']);
        if ($status === 'resolved') {
            $query->where('MarkAsResolved', true);
        } elseif ($status !== 'all') {
            $query->where('MarkAsResolved', false);
            $status = 'open';
        }
        $reports = $query->orderByDesc('CreatedAt')->paginate(50)->withQueryString();
        $abuserIds = $reports->getCollection()->map(fn (AbuseReport $report) => $report->parsedComment()['abuser_id'])->filter()->unique()->values();
        $abusers = User::query()->whereIn('id', $abuserIds)->pluck('username', 'id');
        return view('admin.reports.index', compact('reports', 'abusers', 'status'));
    }

    public function show(AbuseReport $report): View
    {
        $report->load(['reporter:id,username', 'place:id,name']);
        $parsed = $report->parsedComment();
        $subject = $report->subject();
        $abuser = $parsed['abuser_id'] ? User::query()->find($parsed['abuser_id']) : null;
        $target = $this->targetContext($subject);
        $canContentDelete = $this->canDeleteReportedContent($target);
        return view('admin.reports.show', compact('report', 'parsed', 'subject', 'abuser', 'target', 'canContentDelete'));
    }

    public function update(Request $request, AbuseReport $report): RedirectResponse
    {
        $action = (string) $request->input('action', 'ignore');
        if ($action === 'content_deletion') {
            $this->deleteReportedContent($request, $report);
            $report->update(['MarkAsResolved' => true]);
            return back()->with('status', 'Reported content was deleted and the report was closed.');
        }
        if ($action === 'reopen') {
            $report->update(['MarkAsResolved' => false]);
            return back()->with('status', 'Report reopened.');
        }
        $report->update(['MarkAsResolved' => true]);
        return back()->with('status', 'Report ignored and closed.');
    }

    private function targetContext(array $subject): array
    {
        $type = $subject['type'];
        $id = (int) $subject['id'];
        if ($type === 'feed') {
            $feed = Feed::query()->with('user:id,username,blurb')->find($id);
            return ['kind' => 'feed', 'record' => $feed];
        }
        if ($type === 'asset') {
            $asset = Asset::query()->with('creator:id,username')->find($id);
            return ['kind' => 'asset', 'record' => $asset];
        }
        if (in_array($type, ['user', 'userprofile'], true)) {
            $user = User::query()->find($id);
            return ['kind' => 'user', 'record' => $user];
        }
        return ['kind' => $type, 'record' => null];
    }

    private function deleteReportedContent(Request $request, AbuseReport $report): void
    {
        $subject = $report->subject();
        $type = $subject['type'];
        $id = (int) $subject['id'];
        if ($type === 'feed') {
            $feed = Feed::query()->lockForUpdate()->findOrFail($id);
            $before = (string) $feed->content;
            DB::transaction(function () use ($request, $feed, $before, $report) {
                $feed->update(['content' => '[ Content Deleted ]']);
                User::query()->where('id', $feed->user_id)->where('blurb', $before)->update(['blurb' => '[ Content Deleted ]']);
                AdminAudit::record('feed.content_deleted', ['feed_id' => $feed->id, 'report_id' => $report->id, 'before' => $before], $feed->user_id, $request->user()->id);
            });
            return;
        }
        if ($type === 'asset') {
            $asset = Asset::query()->lockForUpdate()->findOrFail($id);
            abort_if($asset->isPlace(), 422, 'Place reports must be handled from game moderation.');
            $before = $asset->only(['name', 'description', 'ghosted', 'onsale', 'can_comment', 'approval']);
            $asset->update([
                'name' => '[ Content Deleted ]',
                'description' => '[ Content Deleted ]',
                'ghosted' => true,
                'onsale' => false,
                'can_comment' => false,
                'approval' => Asset::APPROVAL_REJECTED,
            ]);
            AdminAudit::record('asset.content_deleted_from_report', ['asset_id' => $asset->id, 'report_id' => $report->id, 'before' => $before], $asset->creator_id, $request->user()->id);
            return;
        }
        if (in_array($type, ['user', 'userprofile'], true)) {
            $user = User::query()->lockForUpdate()->findOrFail($id);
            $before = (string) $user->description;
            $user->update(['description' => '[ Content Deleted ]']);
            AdminAudit::record('user.profile_content_deleted_from_report', ['report_id' => $report->id, 'before' => $before], $user->id, $request->user()->id);
            return;
        }
        throw ValidationException::withMessages(['action' => 'This report type does not support content deletion.']);
    }

    private function canDeleteReportedContent(array $target): bool
    {
        if (! $target['record']) {
            return false;
        }
        if ($target['kind'] === 'asset') {
            return ! $target['record']->isPlace();
        }
        return in_array($target['kind'], ['feed', 'user'], true);
    }
}
