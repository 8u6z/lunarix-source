@extends('admin.layout.root')

@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="mb-4">
            <h1>Asset Lookup</h1>
            <p class="mb-0 text-secondary">Search by an exact Asset ID or an asset name.</p>
        </div>

        <section class="card bg-dark text-light border-secondary p-4 mb-4">
            <form method="GET" action="{{ route('admin.assets.find') }}" class="row g-3 align-items-end">
                <div class="col-lg-9">
                    <label for="assetLookupQuery" class="form-label text-secondary fw-semibold">Asset ID or Name</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-dark border-secondary text-secondary"><i class="bi bi-search"></i></span>
                        <input id="assetLookupQuery" name="q" value="{{ $query }}" class="form-control bg-dark border-secondary text-light" placeholder="For example: 1 or Classic Hat" maxlength="50" autofocus>
                    </div>
                </div>
                <div class="col-lg-3 d-grid">
                    <button class="btn btn-primary btn-lg" type="submit">Search assets</button>
                </div>
            </form>
        </section>

        <section class="card bg-dark text-light border-secondary overflow-hidden">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-secondary">
                <div>
                    <h2 class="h5 mb-1">{{ $query !== '' ? 'Search results' : 'All assets' }}</h2>
                    <p class="text-secondary mb-0">
                        {{ number_format($assets->total()) }} {{ Str::plural('asset', $assets->total()) }}
                        @if($query !== '') found for “{{ $query }}” @else total @endif
                    </p>
                </div>
                @if($query !== '')<a href="{{ route('admin.assets.find') }}" class="btn btn-sm btn-outline-light">Clear search</a>@endif
            </div>

            <div class="table-responsive">
                <table class="table table-dark table-bordered table-striped align-middle mb-0">
                    <thead class="text-secondary">
                        <tr>
                            <th class="ps-4">Asset</th>
                            <th>Type</th>
                            <th>Creator</th>
                            <th>Price</th>
                            <th>Availability</th>
                            <th>Sales</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $asset)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="/Thumbs/Asset.ashx?assetId={{ $asset->id }}" alt="" width="52" height="52" class="rounded bg-dark object-fit-contain">
                                        <div>
                                            <div class="fw-semibold">{{ $asset->name }}</div>
                                            <div class="text-secondary small">ID {{ $asset->id }} · Updated {{ $asset->updated_at?->format('M j, Y') ?? 'Unknown' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $asset->getTypeName() }}</td>
                                <td>{{ $asset->creator?->username ?? '[unknown]' }} <span class="text-secondary">({{ $asset->creator_id }})</span></td>
                                <td>{{ number_format($asset->robux) }} Bytes</td>
                                <td>
                                    @if($asset->ghosted)
                                        <span class="badge text-bg-danger">Deleted</span>
                                    @elseif($asset->isSoldOut())
                                        <span class="badge text-bg-warning">Sold out</span>
                                    @elseif($asset->onsale)
                                        <span class="badge text-bg-success">On sale</span>
                                    @else
                                        <span class="badge text-bg-secondary">Off sale</span>
                                    @endif
                                    @if($asset->is_limited_unique)
                                        <span class="badge text-bg-warning">Limited Unique</span>
                                    @elseif($asset->is_limited)
                                        <span class="badge text-bg-warning">Limited</span>
                                    @endif
                                </td>
                                <td>{{ number_format($asset->sales_count) }}</td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.assets.edit', $asset) }}" class="btn btn-sm btn-outline-light">Edit Asset</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-box-seam fs-1 text-secondary"></i>
                                    <p class="mt-3 mb-1 fw-semibold">No matching assets</p>
                                    <p class="text-secondary mb-0">Try a different ID or a shorter asset-name fragment.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($assets->hasPages())
                <div class="p-4 border-top border-secondary">{{ $assets->links() }}</div>
            @endif
        </section>
    </main>
</div>
@endsection
