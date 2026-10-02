<?php
namespace App\Http\Controllers\Admin;
use App\Models\Asset;
use App\Models\Videos\Video;
use App\Services\AdminAudit;
use App\Services\AssetRenderQueue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AssetReview
{
    public function index(Request $request): View
    {
        $status = (int) $request->query('status', 0);
        if (! in_array($status, [0, 1, 2], true)) {
            $status = 0;
        }
        $query = trim((string) $request->query('q', ''));
        $page = max(1, (int) $request->query('page', 1));
        $perPage = 30;
        $assetApproval = $status === 2 ? Asset::APPROVAL_REJECTED : $status;
        $assets = Asset::query()->requiresReview()->where('approval', $assetApproval)->whereNotExists(function ($subquery) {
                $subquery->selectRaw('1')->from('assets as parent')->whereColumn('parent.related_to', 'assets.id');
            })->with('creator:id,username');
        if ($query !== '') {
            $assets->where(function ($builder) use ($query) {
                if (ctype_digit($query)) {
                    $builder->orWhere('id', (int) $query);
                }
                $builder->orWhereRaw('LOWER(name) LIKE ?', ['%'.strtolower($query).'%']);
            });
        }
        $videoApproval = $status === 2 ? Video::APPROVAL_DENIED : $status;
        $videos = Video::query()->where('approval', $videoApproval)->with('creator:id,username');
        if ($query !== '') {
            $videos->where(function ($builder) use ($query) {
                if (ctype_digit($query)) {
                    $builder->orWhere('id', (int) $query);
                }
                $builder->orWhereRaw('LOWER(name) LIKE ?', ['%'.strtolower($query).'%']);
            });
        }
        $thumbnailRows = DB::table('asset_renders')->join('assets', 'assets.id', '=', 'asset_renders.asset_id')->where('asset_renders.is_place_thumbnail', true)->where(function ($q) use ($status) {
                $q->where(function ($inner) use ($status) {
                    $inner->where('asset_renders.render_type', 'place')->where('assets.thumbnail_approval', $status);
                })->orWhere(function ($inner) use ($status) {
                    $inner->where('asset_renders.render_type', 'place_square')->where('assets.thumbnail_square_approval', $status);
                });
            })->when($query !== '', function ($q) use ($query) {
                $q->where(function ($inner) use ($query) {
                    if (ctype_digit($query)) {
                        $inner->orWhere('assets.id', (int) $query);
                    }
                    $inner->orWhereRaw('LOWER(assets.name) LIKE ?', ['%'.strtolower($query).'%']);
                });
            })->select(['asset_renders.id as render_id', 'asset_renders.asset_id', 'asset_renders.render_type', 'asset_renders.render_path', 'asset_renders.created_at', 'assets.name', 'assets.creator_id'])->orderBy('asset_renders.created_at')->get();
        $creatorIds = $thumbnailRows->pluck('creator_id')->unique()->filter();
        $creators = DB::table('users')->whereIn('id', $creatorIds)->pluck('username', 'id');
        $thumbnails = $thumbnailRows->map(fn ($row) => (object) ['review_type' => 'thumbnail', 'model' => $row, 'created_at' => $row->created_at, 'creator_username' => $creators->get($row->creator_id, '[unknown]')]);
        $items = $assets->get()->map(fn ($a) => (object) ['review_type' => 'asset', 'model' => $a, 'created_at' => $a->created_at])->concat($videos->get()->map(fn ($v) => (object) ['review_type' => 'video', 'model' => $v, 'created_at' => $v->created_at])) ->concat($thumbnails)->sortBy('created_at')->values();
        $paginated = new LengthAwarePaginator($items->forPage($page, $perPage)->values(), $items->count(), $perPage, $page, ['path' => $request->url(), 'query' => $request->query()]);
        return view('admin.assets.review', ['status' => $status, 'query' => $query, 'assets' => $paginated]);
    }

    public function update(Request $request, Asset $asset, AssetRenderQueue $renders): RedirectResponse
    {
        if ($request->filled('render_type')) {
            $validated = $request->validate(['approval' => ['required', 'integer', Rule::in([Asset::APPROVAL_APPROVED, Asset::APPROVAL_REJECTED])], 'render_type' => ['required', 'string', Rule::in(['place', 'place_square'])]]);
            $column = $validated['render_type'] === 'place_square' ? 'thumbnail_square_approval' : 'thumbnail_approval';
            $approval = (int) $validated['approval'];
            $asset->update([$column => $approval]);
            AdminAudit::record($approval === Asset::APPROVAL_APPROVED ? 'thumbnail.approved' : 'thumbnail.rejected', ['asset_id' => $asset->id, 'render_type' => $validated['render_type']], $asset->creator_id, $request->user()->id);
            return back()->with('success', 'Thumbnail for asset '.$asset->id.' ('.$validated['render_type'].') marked '.($approval === Asset::APPROVAL_APPROVED ? 'approved' : 'not approved').'.');
        }
        abort_unless($asset->needsReview(), 404);
        $validated = $request->validate(['approval' => ['required', 'integer', Rule::in([Asset::APPROVAL_APPROVED, Asset::APPROVAL_REJECTED])]]);
        $approval = (int) $validated['approval'];
        DB::transaction(function () use ($asset, $approval) {
            $asset->update(['approval' => $approval]);
            if ($asset->related_to) {
                Asset::whereKey($asset->related_to)->update(['approval' => $approval]);
            }
        });
        if ($approval === Asset::APPROVAL_APPROVED) {
            $renders->queue($asset, true);
        }
        AdminAudit::record($approval === 1 ? 'asset.approved' : 'asset.rejected', ['asset_id' => $asset->id, 'asset_type' => $asset->getTypeName()], $asset->creator_id, $request->user()->id);
        return back()->with('success', 'Asset '.$asset->id.' marked '.($approval === 1 ? 'approved' : 'not approved').'.');
    }

    public function preview(Asset $asset)
    {
        abort_unless($asset->needsReview(), 404);
        if ($asset->related_to) {
            $asset = Asset::findOrFail($asset->related_to);
        }
        if (in_array($asset->type, [Asset::TYPE_IMAGE, Asset::TYPE_TSHIRT], true)) {
            $version = DB::table('asset_versions')->where('asset_id', $asset->id)->latest('created_at')->first();
            abort_unless($version, 404);
            $path = ltrim($version->path, '/');
            return redirect()->away('https://asset.lunarix.lol/' . $path);
        }
        $render = DB::table('asset_renders')->where('asset_id', $asset->id)->latest('created_at')->first();
        if ($render) {
            $path = trim($render->render_path);
            $path = preg_replace('#^https?://[^/]+/#i', '', $path);
            $path = preg_replace('#^(?:Thumbs/)?synvo\.live/#i', '', $path);
            $path = ltrim($path, '/');
            return redirect()->away('https://cdn.lunarix.lol/' . $path);
        }
        return redirect('/img/ph/user_placeholder.png');
    }

    public function download(Asset $asset)
    {
        abort_unless($asset->needsReview(), 404);
        $version = DB::table('asset_versions')->where('asset_id', $asset->id)->latest('created_at')->first();
        abort_unless($version, 404);
        $path = ltrim($version->path, '/');
        $disk = Storage::disk('asset');
        abort_unless($disk->exists($path), 404);

        return response()->streamDownload(function () use ($disk, $path) {
            $stream = $disk->readStream($path);
            fpassthru($stream);
            if (is_resource($stream)) {
                fclose($stream);
            }
        }, $asset->id.'-'.$asset->getSlug());
    }

    public function updateVideo(Request $request, Video $video): RedirectResponse
    {
        abort_unless($video->needsReview(), 404);
        $validated = $request->validate(['approval' => ['required', 'integer', Rule::in([Video::APPROVAL_APPROVED, Video::APPROVAL_DENIED])]]);
        $approval = (int) $validated['approval'];
        $video->update(['approval' => $approval]);
        AdminAudit::record($approval === Video::APPROVAL_APPROVED ? 'video.approved' : 'video.rejected', ['video_id' => $video->id], $video->creator_id, $request->user()->id);
        return back()->with('success', 'Video '.$video->id.' marked '.($approval === Video::APPROVAL_APPROVED ? 'approved' : 'not approved').'.');
    }

    public function previewVideo(Video $video)
    {
        if (! $video->thumbnail_path) {
            return redirect('/img/ph/user_placeholder.png');
        }
        return redirect()->away($video->thumbnail_url);
    }

    public function downloadVideo(Video $video)
    {
        $disk = Storage::disk('videos');
        abort_unless($video->video_path && $disk->exists($video->video_path), 404);
        return response()->streamDownload(function () use ($disk, $video) {
            $stream = $disk->readStream($video->video_path);
            fpassthru($stream);
            if (is_resource($stream)) {
                fclose($stream);
            }
        }, $video->id.'-'.$video->name.'.mp4');
    }
}