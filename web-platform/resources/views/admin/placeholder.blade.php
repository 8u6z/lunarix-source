@extends('admin.layout.root')
@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="admin-page-header">
            <h1>{{ $pageTitle }}</h1>
            <p>{{ $pageDescription }}</p>
        </div>
        <div class="card bg-dark text-light border-secondary">
            <div class="card-body p-4">
                <h2 class="h5">Placeholder</h2>
                <p class="text-secondary mb-0">
                    This page is currently a placeholder for a internal tool that has not been developed yet.
                </p>
            </div>
        </div>
    </main>
</div>
@endsection
