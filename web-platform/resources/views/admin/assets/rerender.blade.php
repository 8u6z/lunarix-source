@extends('admin.layout.root')

@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="admin-page-header">
            <h1>Re-render Asset</h1>
            <p>Queue an existing asset for a fresh thumbnail render.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <section class="admin-card p-4" style="max-width:720px">
            <form method="POST" action="{{ route('admin.assets.rerender.store') }}" class="row g-3 align-items-end">
                @csrf
                <div class="col-md-8">
                    <label for="rerenderAsset" class="form-label">Asset ID</label>
                    <input
                        id="rerenderAsset"
                        type="number"
                        name="asset_id"
                        value="{{ old('asset_id') }}"
                        min="1"
                        class="form-control bg-dark border-secondary text-light"
                        required
                    >
                </div>
                <div class="col-md-4 d-grid">
                    <button class="btn btn-primary">Queue Render</button>
                </div>
            </form>
        </section>
    </main>
</div>
@endsection
