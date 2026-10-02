@extends('admin.layout.root')
@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="admin-page-header">
            <h1>Migrate Asset</h1>
            <p>Migrate a Lunarix asset to Lunarix.</p>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <section class="admin-card p-4" style="max-width:720px">
            <form method="POST" action="{{ route('admin.assets.migrate-roblox') }}" class="row g-3 align-items-end">
                @csrf
                <div class="col-md-8">
                    <label for="migrateAsset" class="form-label">Lunarix Catalog URL or Asset ID</label>
                    <input id="migrateAsset" type="text" name="url" value="{{ old('url') }}" class="form-control bg-dark border-secondary text-light" required>
                </div>
                <div class="col-md-4 d-grid">
                    <button class="btn btn-primary">Migrate Asset</button>
                </div>
            </form>
        </section>
    </main>
</div>
@endsection