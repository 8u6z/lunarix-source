<?php
namespace App\Http\Controllers\Admin;
use App\Models\Feed;
use App\Models\User;
use App\Services\AdminAudit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class FeedMonitor
{
    public function index(Request $request): View
    {
        $query = trim((string) $request->query('q', ''));
        $feeds = Feed::query()->with('user:id,username,blurb')->when($query !== '', function ($builder) use ($query) {
                $builder->where(function ($inner) use ($query) {
                    if (ctype_digit($query)) {
                        $inner->orWhere('id', (int) $query)->orWhere('user_id', (int) $query);
                    }
                    $inner->orWhereRaw('LOWER(content) LIKE ?', ['%'.strtolower($query).'%']);
                });
            })->orderByDesc('created_at')->paginate(50)->withQueryString();
        return view('admin.feeds.index', compact('feeds', 'query'));
    }

    public function deleteContent(Request $request, Feed $feed): RedirectResponse
    {
        DB::transaction(function () use ($request, $feed) {
            $lockedFeed = Feed::query()->lockForUpdate()->findOrFail($feed->id);
            $before = (string) $lockedFeed->content;
            $lockedFeed->update(['content' => '[ Content Deleted ]']);
            User::query()->where('id', $lockedFeed->user_id)->where('blurb', $before)->update(['blurb' => '[ Content Deleted ]']);
            AdminAudit::record('feed.content_deleted', ['feed_id' => $lockedFeed->id, 'before' => $before], $lockedFeed->user_id, $request->user()->id);
        });
        return back()->with('status', 'Feed message was content deleted.');
    }
}
