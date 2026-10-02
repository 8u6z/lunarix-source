@extends('admin.layout.root')

@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="admin-page-header">
            <h1>Asset Review Queue</h1>
            <p>Review assets waiting for moderation.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <section class="card bg-dark text-light border-secondary p-4 mb-4">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-7">
                    <label class="form-label">Asset ID or Name</label>
                    <input name="q" value="{{ $query }}" class="form-control bg-dark border-secondary text-light">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select bg-dark border-secondary text-light">
                        <option value="0" @selected($status === 0)>Pending</option>
                        <option value="1" @selected($status === 1)>Approved</option>
                        <option value="2" @selected($status === 2)>Not approved</option>
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary">Filter</button>
                </div>
            </form>
        </section>

        <div class="row g-4">
            @forelse($assets as $item)
                @php($asset = $item->model)
                <div class="col-xl-4 col-md-6">
                    <section class="admin-card p-3 h-100">
                        @if($item->review_type === 'video')
                            <video controls poster="{{ config('app.cdn_url') }}/{{ $asset->thumbnail_path }}" class="w-100 mb-3" src="{{ route('admin.videos.review.download', $asset) }}"></video>
                            <h2 class="h5 mb-1">{{ $asset->name }}</h2>
                            <p class="text-secondary small">
                                ID {{ $asset->id }} · Video ·
                                {{ $asset->creator?->username ?? '[unknown]' }} ({{ $asset->creator_id }})
                            </p>
                            <p class="small">{{ Str::limit($asset->description, 150) }}</p>

                            @if($status === 0)
                                <div class="d-flex gap-2 mt-auto">
                                    <form method="POST" action="{{ route('admin.videos.review.update', $asset) }}" class="flex-fill">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="approval" value="{{ \App\Models\Videos\Video::APPROVAL_APPROVED }}">
                                        <button class="btn btn-success w-100">Approve</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.videos.review.update', $asset) }}" class="flex-fill">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="approval" value="{{ \App\Models\Videos\Video::APPROVAL_DENIED }}">
                                        <button class="btn btn-danger w-100">Not Approved</button>
                                    </form>
                                </div>
                            @else
                                <div class="badge {{ $status === 1 ? 'text-bg-success' : 'text-bg-danger' }}">
                                    {{ $status === 1 ? 'Approved' : 'Not approved' }}
                                </div>
                            @endif
                            @elseif($item->review_type === 'thumbnail')
                                @php($render = $item->model)
                                <div class="ratio ratio-1x1 bg-dark rounded overflow-hidden mb-3">
                                    <img src="{{ rtrim(config('app.cdn_url'), '/') }}/{{ ltrim($render->render_path, '/') }}" class="object-fit-contain" alt="">
                                </div>
                                <h2 class="h5 mb-1">{{ $render->name }}</h2>
                                <p class="text-secondary small">Asset ID {{ $render->asset_id }} · Place Thumbnail · {{ $item->creator_username }} ({{ $render->creator_id }}) ·
                                    <span class="badge text-bg-secondary">{{ $render->render_type === 'place_square' ? 'Square' : 'Large' }}</span>
                                </p>
                                @if($status === 0)
                                    <div class="d-flex gap-2 mt-auto">
                                        <form method="POST" action="{{ route('admin.assets.review.update', ['asset' => $render->asset_id]) }}" class="flex-fill">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="approval" value="{{ \App\Models\Asset::APPROVAL_APPROVED }}">
                                            <input type="hidden" name="render_type" value="{{ $render->render_type }}">
                                            <button class="btn btn-success w-100">Approve</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.assets.review.update', ['asset' => $render->asset_id]) }}" class="flex-fill">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="approval" value="{{ \App\Models\Asset::APPROVAL_REJECTED }}">
                                            <input type="hidden" name="render_type" value="{{ $render->render_type }}">
                                            <button class="btn btn-danger w-100">Not Approved</button>
                                        </form>
                                    </div>
                                @else
                                    <div class="badge {{ $status === 1 ? 'text-bg-success' : 'text-bg-danger' }}">
                                        {{ $status === 1 ? 'Approved' : 'Not approved' }}
                                    </div>
                                @endif
                        @else
                            <div class="ratio ratio-1x1 bg-dark rounded overflow-hidden mb-3">
                                <img src="{{ route('admin.assets.review.preview', $asset) }}" class="object-fit-contain" alt="">
                            </div>
                            <h2 class="h5 mb-1">{{ $asset->name }}</h2>
                            <p class="text-secondary small">
                                ID {{ $asset->id }} · {{ $asset->getTypeName() }} ·
                                {{ $asset->creator?->username ?? '[unknown]' }} ({{ $asset->creator_id }})
                            </p>
                            <p class="small">{{ Str::limit($asset->description, 150) }}</p>
                            <a href="{{ route('admin.assets.review.download', $asset) }}" class="btn btn-sm btn-outline-light mb-3">
                                Download uploaded file
                            </a>

                            @if($asset->type === \App\Models\Asset::TYPE_AUDIO)
                                <audio controls class="w-100 mb-3" src="{{ route('admin.assets.review.download', $asset) }}"></audio>
                            @endif

                            @if($status === 0)
                                <div class="d-flex gap-2 mt-auto">
                                    <form method="POST" action="{{ route('admin.assets.review.update', $asset) }}" class="flex-fill">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="approval" value="1">
                                        <button class="btn btn-success w-100">Approve</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.assets.review.update', $asset) }}" class="flex-fill">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="approval" value="2">
                                        <button class="btn btn-danger w-100">Not Approved</button>
                                    </form>
                                </div>
                            @else
                                <div class="badge {{ $status === 1 ? 'text-bg-success' : 'text-bg-danger' }}">
                                    {{ $status === 1 ? 'Approved' : 'Not approved' }}
                                </div>
                            @endif
                        @endif
                    </section>
                </div>
            @empty
                <div class="col-12">
                    <section class="admin-card p-5 text-center">
                    <tr>
                       <td colspan="7" class="text-center py-5">
                          <i class="bi bi-box-seam fs-1 text-secondary"></i>
                          <p class="mt-3 mb-1 fw-semibold">No assets left to review</p>
                          <p class="text-secondary mb-0">Thank you for reviewing all assets.</p>
                       </td>
                    </tr>
                    </section>
                </div>
            @endforelse
        </div>

        @if($assets->hasPages())
            <div class="mt-4">{{ $assets->links() }}</div>
        @endif
    </main>
</div>
@endsection
