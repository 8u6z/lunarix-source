@extends('admin.layout.root')

@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="admin-page-header">
            <h1>Create Asset</h1>
            <p>Publish a asset to the lunarix catalog.</p>
        </div>

        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>The asset could not be created.</strong>
                <ul class="mb-0 mt-2">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.assets.create.store') }}" enctype="multipart/form-data" class="admin-asset-form">
            @csrf
            <div class="row g-4">
                <div class="col-xl-8">
                    <section class="admin-card p-4">
                        <div class="admin-form-section">
                            <h2 class="admin-form-section-title">Asset information</h2>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="assetType" class="form-label">Asset type</label>
                                    <select id="assetType" name="type" class="form-select bg-dark border-secondary text-light" required>
                                        <option value="hat" @selected(old('type') === 'hat')>Hat</option>
                                        <option value="face" @selected(old('type') === 'face')>Face</option>
                                        <option value="gear" @selected(old('type') === 'gear')>Gear</option>
                                        <option value="image" @selected(old('type') === 'image')>Image</option>
                                        <option value="mesh" @selected(old('type') === 'mesh')>Mesh</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="assetName" class="form-label">Name</label>
                                    <input id="assetName" name="name" value="{{ old('name') }}" maxlength="50" class="form-control bg-dark border-secondary text-light" required>
                                </div>
                                <div class="col-12">
                                    <label for="assetDescription" class="form-label">Description</label>
                                    <textarea id="assetDescription" name="description" rows="4" maxlength="1000" class="form-control bg-dark border-secondary text-light">{{ old('description') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label for="assetFile" class="form-label">Asset file</label>
                                    <input id="assetFile" type="file" name="file" class="form-control bg-dark border-secondary text-light" accept=".lrxm" required>
                                    <div id="assetFileHelp" class="form-text admin-muted">Upload an .lrxm Hat file. Maximum size: 50 MB.</div>
                                </div>
                            </div>
                        </div>

                        <div class="admin-form-section">
                            <h2 class="admin-form-section-title">Sales and availability</h2>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="assetPrice" class="form-label">Price in Bytes</label>
                                    <input id="assetPrice" type="number" name="price" value="{{ old('price', 0) }}" min="0" max="2147483647" class="form-control bg-dark border-secondary text-light" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="assetLimitedQuantity" class="form-label">Limited quantity</label>
                                    <input id="assetLimitedQuantity" type="number" name="limited_quantity" value="{{ old('limited_quantity') }}" min="1" max="2147483647" class="form-control bg-dark border-secondary text-light">
                                    <div class="form-text admin-muted">Required only when Limited is enabled.</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check border border-secondary rounded-2 bg-dark p-3 ps-5 h-100">
                                        <input id="assetOnSale" class="form-check-input" type="checkbox" name="onsale" value="1" @checked(old('onsale'))>
                                        <label class="form-check-label w-100" for="assetOnSale">
                                            <span class="d-block fw-semibold">On sale</span>
                                            <small class="text-secondary">Allow users to purchase this asset.</small>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check border border-secondary rounded-2 bg-dark p-3 ps-5 h-100">
                                        <input id="assetLimited" class="form-check-input" type="checkbox" name="is_limited" value="1" @checked(old('is_limited'))>
                                        <label class="form-check-label w-100" for="assetLimited">
                                            <span class="d-block fw-semibold">Limited</span>
                                            <small class="text-secondary">Cap the number of copies sold.</small>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check border border-secondary rounded-2 bg-dark p-3 ps-5 h-100">
                                        <input id="assetUnique" class="form-check-input" type="checkbox" name="is_limited_unique" value="1" @checked(old('is_limited_unique'))>
                                        <label class="form-check-label w-100" for="assetUnique">
                                            <span class="d-block fw-semibold">Unique</span>
                                            <small class="text-secondary">Give each purchase a serial number.</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-xl-4">
                    <section class="admin-card p-4 position-sticky" style="top:1rem;">
                        <h2 class="h5">Publish asset</h2>
                        <p id="assetFlowDescription" class="admin-muted">Please make sure to only upload working assets!</p>
                        <button class="btn btn-primary btn-lg w-100" type="submit">Create asset</button>
                    </section>
                </div>
            </div>
        </form>
    </main>
</div>
@endsection

@push('js')
<script>
(() => {
    const type = document.getElementById('assetType');
    const file = document.getElementById('assetFile');
    const help = document.getElementById('assetFileHelp');
    const limited = document.getElementById('assetLimited');
    const quantity = document.getElementById('assetLimitedQuantity');
    const unique = document.getElementById('assetUnique');
    const refresh = () => {
        if (type.value === 'face' || type.value === 'image') {
            file.accept = '.png,.jpg,.jpeg,image/png,image/jpeg';
            help.textContent = 'Upload a PNG or JPEG image. Maximum size: 50 MB.';
            return;
        }
        if (type.value === 'mesh') {
            file.accept = '.mesh';
            help.textContent = 'Upload a .MESH file. Maximum size: 50 MB.';
            return;
        }
        file.accept = '.lrxm';
        const label = type.value === 'gear' ? 'Gear' : 'Hat';
        help.textContent = `Upload an .lrxm ${label} file. Maximum size: 50 MB.`;
    };
    type.addEventListener('change', refresh);
    const refreshLimited = () => {
        quantity.disabled = !limited.checked;
        quantity.required = limited.checked;
        unique.disabled = !limited.checked;
        if (!limited.checked) unique.checked = false;
    };
    limited.addEventListener('change', refreshLimited);
    refresh();
    refreshLimited();
})();
</script>
@endpush
