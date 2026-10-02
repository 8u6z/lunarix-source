@extends('admin.layout.root')

@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="admin-page-header">
            <a href="{{ route('admin.assets.find', ['q' => $asset->id]) }}" class="admin-muted text-decoration-none">&larr; Back to Asset Lookup</a>
            <h1 class="mt-2">Edit Asset</h1>
            <p>Update catalog information for {{ $asset->name }} ({{ $asset->id }}).</p>
        </div>

        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>The asset could not be updated.</strong>
                <ul class="mb-0 mt-2">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-xl-8">
                <form method="POST" action="{{ route('admin.assets.update', $asset) }}" class="admin-asset-form">
                    @csrf
                    @method('PUT')
                    <section class="admin-card p-4">
                        <div class="admin-form-section">
                            <h2 class="admin-form-section-title">Asset information</h2>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="assetName" class="form-label">Name</label>
                                    <input id="assetName" name="name" value="{{ old('name', $asset->name) }}" maxlength="50" class="form-control bg-dark border-secondary text-light" required>
                                </div>
                                <div class="col-12">
                                    <label for="assetDescription" class="form-label">Description</label>
                                    <textarea id="assetDescription" name="description" rows="5" maxlength="1000" class="form-control bg-dark border-secondary text-light">{{ old('description', $asset->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="admin-form-section">
                            <h2 class="admin-form-section-title">Sales and availability</h2>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="assetPrice" class="form-label">Price in Bytes</label>
                                    <input id="assetPrice" type="number" name="price" value="{{ old('price', $asset->robux) }}" min="0" max="2147483647" class="form-control bg-dark border-secondary text-light" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="assetLimitedQuantity" class="form-label">Limited quantity</label>
                                    <input id="assetLimitedQuantity" type="number" name="limited_quantity" value="{{ old('limited_quantity', $asset->limited_quantity) }}" min="{{ max(1, $asset->sales_count) }}" max="2147483647" class="form-control bg-dark border-secondary text-light">
                                    <div class="form-text admin-muted">Cannot be lower than {{ number_format($asset->sales_count) }} already sold.</div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-check border border-secondary rounded-2 bg-dark p-3 ps-5 h-100">
                                        <input id="assetOnSale" class="form-check-input" type="checkbox" name="onsale" value="1" @checked(old('onsale', $asset->onsale))>
                                        <label class="form-check-label w-100" for="assetOnSale">
                                            <span class="d-block fw-semibold">On sale</span>
                                            <small class="text-secondary">Allow purchases.</small>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-check border border-secondary rounded-2 bg-dark p-3 ps-5 h-100">
                                        <input id="assetComments" class="form-check-input" type="checkbox" name="can_comment" value="1" @checked(old('can_comment', $asset->can_comment))>
                                        <label class="form-check-label w-100" for="assetComments">
                                            <span class="d-block fw-semibold">Comments</span>
                                            <small class="text-secondary">Allow comments.</small>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-check border border-secondary rounded-2 bg-dark p-3 ps-5 h-100">
                                        <input id="assetLimited" class="form-check-input" type="checkbox" name="is_limited" value="1" @checked(old('is_limited', $asset->is_limited))>
                                        <label class="form-check-label w-100" for="assetLimited">
                                            <span class="d-block fw-semibold">Limited</span>
                                            <small class="text-secondary">Cap copies sold.</small>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-check border border-secondary rounded-2 bg-dark p-3 ps-5 h-100">
                                        <input id="assetUnique" class="form-check-input" type="checkbox" name="is_limited_unique" value="1" @checked(old('is_limited_unique', $asset->is_limited_unique))>
                                        <label class="form-check-label w-100" for="assetUnique">
                                            <span class="d-block fw-semibold">Unique</span>
                                            <small class="text-secondary">Assign serials.</small>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end pt-2">
                                    <button class="btn btn-primary px-4" type="submit">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>

            <div class="col-xl-4">
                <section class="admin-card p-4">
                    <img src="/Thumbs/Asset.ashx?assetId={{ $asset->id }}" alt="{{ $asset->name }}" class="img-fluid rounded bg-dark mb-3 w-100">
                    <dl class="row mb-0">
                        <dt class="col-5 text-secondary">Asset ID</dt><dd class="col-7">{{ $asset->id }}</dd>
                        <dt class="col-5 text-secondary">Type</dt><dd class="col-7">{{ $asset->getTypeName() }}</dd>
                        <dt class="col-5 text-secondary">Creator</dt><dd class="col-7">{{ $asset->creator?->username ?? '[unknown]' }} ({{ $asset->creator_id }})</dd>
                        <dt class="col-5 text-secondary">Sales</dt><dd class="col-7">{{ number_format($asset->sales_count) }}</dd>
                        <dt class="col-5 text-secondary">Created</dt><dd class="col-7">{{ $asset->created_at?->format('M j, Y') ?? 'Unknown' }}</dd>
                    </dl>
                    <a href="/{{ $asset->getSlug() }}-item?id={{ $asset->id }}" target="_blank" rel="noopener" class="btn btn-outline-light w-100 mt-3">Open Catalog Page ↗</a>
                    <button type="button" class="btn btn-outline-danger w-100 mt-2" data-bs-toggle="modal" data-bs-target="#contentDeletionModal">Content Deletion</button>
                </section>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="contentDeletionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light border-secondary">
            <form method="POST" action="{{ route('admin.assets.update', $asset) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="action" value="content_deletion">
                <div class="modal-header border-secondary">
                    <div>
                        <h2 class="modal-title h5">Content Deletion</h2>
                        <div class="admin-muted small">Select which content to remove from asset {{ $asset->id }}.</div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-grid gap-2">
                        <label class="form-check border border-secondary rounded-2 p-3 ps-5">
                            <input class="form-check-input" type="checkbox" name="delete_name" value="1">
                            <span class="form-check-label"><strong>Name</strong><span class="d-block admin-muted">Replace with [ Content Deleted ]</span></span>
                        </label>
                        <label class="form-check border border-secondary rounded-2 p-3 ps-5">
                            <input class="form-check-input" type="checkbox" name="delete_description" value="1">
                            <span class="form-check-label"><strong>Description</strong><span class="d-block admin-muted">Replace with [ Content Deleted ]</span></span>
                        </label>
                        <label class="form-check border border-danger rounded-2 p-3 ps-5">
                            <input class="form-check-input" type="checkbox" name="delete_asset" value="1">
                            <span class="form-check-label"><strong>Delete asset</strong><span class="d-block admin-muted">Remove it from sale and prevent catalog, inventory, thumbnail, and asset delivery access.</span></span>
                        </label>
                    </div>
                    <div class="alert alert-warning mt-3 mb-0">Existing ownership records will remain for moderation and audit history.</div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete the selected asset content?');">Delete selected content</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
(() => {
    const limited = document.getElementById('assetLimited');
    const quantity = document.getElementById('assetLimitedQuantity');
    const unique = document.getElementById('assetUnique');
    const refreshLimited = () => {
        quantity.disabled = !limited.checked;
        quantity.required = limited.checked;
        unique.disabled = !limited.checked;
        if (!limited.checked) unique.checked = false;
    };
    limited.addEventListener('change', refreshLimited);
    refreshLimited();
})();
</script>
@endpush
