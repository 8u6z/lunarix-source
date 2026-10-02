@extends('admin.layout.root')
@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="mb-4">
            <h1>Welcome, {{ $currentUser->username }}!</h1>
            <p class="mb-0 text-secondary">Role: {{ $currentUser->roleset_name ?? 'User' }}</p>
        </div>
        <div class="row g-3">
            <div class="col-sm-6 col-xl-3">
                <section class="card bg-dark text-light border-secondary p-4 h-100">
                    <div class="text-secondary small text-uppercase fw-semibold">Total Users</div>
                    <div class="display-6 fw-semibold mt-2">{{ number_format($stats['users']) }}</div>
                </section>
            </div>
            <div class="col-sm-6 col-xl-3">
                <section class="card bg-dark text-light border-secondary p-4 h-100">
                    <div class="text-secondary small text-uppercase fw-semibold">Users In-Game</div>
                    <div class="display-6 fw-semibold mt-2">{{ number_format($stats['users_in_game']) }}</div>
                </section>
            </div>
            <div class="col-sm-6 col-xl-3">
                <section class="card bg-dark text-light border-secondary p-4 h-100">
                    <div class="text-secondary small text-uppercase fw-semibold">Total Games</div>
                    <div class="display-6 fw-semibold mt-2">{{ number_format($stats['games']) }}</div>
                </section>
            </div>
            <div class="col-sm-6 col-xl-3">
                <section class="card bg-dark text-light border-secondary p-4 h-100">
                    <div class="text-secondary small text-uppercase fw-semibold">Total Groups</div>
                    <div class="display-6 fw-semibold mt-2">{{ number_format($stats['groups']) }}</div>
                </section>
            </div>
        </div>
    </main>
</div>
@endsection
