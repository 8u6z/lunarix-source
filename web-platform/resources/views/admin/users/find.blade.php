@extends('admin.layout.root')
@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="mb-4">
            <h1>User Lookup</h1>
            <p class="mb-0 text-secondary">Search by an exact UserID or Username.</p>
        </div>
        <section class="card bg-dark text-light border-secondary p-4 mb-4">
            <form method="GET" action="/administration/find" class="row g-3 align-items-end">
                <div class="col-lg-9">
                    <label for="userLookupQuery" class="form-label text-secondary fw-semibold">UserID, Discord ID, or Username</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-dark border-secondary text-secondary"><i class="bi bi-search"></i></span>
                        <input id="userLookupQuery" name="q" value="{{ $query }}" class="form-control bg-dark border-secondary text-light" placeholder="For example: 1, Lunarix, or 735668954214694912" maxlength="50" autofocus>
                    </div>
                </div>
                <div class="col-lg-3 d-grid">
                    <button class="btn btn-primary btn-lg" type="submit">Search users</button>
                </div>
            </form>
        </section>
            <section class="card bg-dark text-light border-secondary overflow-hidden">
                <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-secondary">
                    <div>
                        <h2 class="h5 mb-1">{{ $query !== '' ? 'Search results' : 'All users' }}</h2>
                        <p class="text-secondary mb-0">
                            {{ number_format($users->total()) }} {{ Str::plural('account', $users->total()) }}
                            @if($query !== '') found for “{{ $query }}” @else total @endif
                        </p>
                    </div>
                    @if($query !== '')<a href="/administration/find" class="btn btn-sm btn-outline-light">Clear search</a>@endif
                </div>
                <div class="table-responsive">
                    <table class="table table-dark table-bordered table-striped align-middle mb-0">
                        <thead class="text-secondary">
                            <tr>
                                <th class="ps-4">User</th>
                                <th>Role</th>
                                <th>Membership</th>
                                <th>Status</th>
                                <th>Balance</th>
                                <th>Last active</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $account)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="/Thumbs/Avatar.ashx?userId={{ $account->id }}" alt="" width="44" height="44" class="rounded bg-dark">
                                            <div>
                                                <div class="fw-semibold">{{ $account->username }}</div>
                                                <div class="text-secondary small">ID {{ $account->id }} · Joined {{ $account->created_at?->format('M j, Y') ?? 'Unknown' }}</div>
                                                @if($account->discord_id)
                                                    <div class="text-secondary small">Discord {{ $account->discord_username ?: 'Linked user' }} ({{ $account->discord_id }})</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge text-bg-primary">{{ $account->roleset_name ?? 'Member' }}</span></td>
                                    <td>{{ $account->membership_name }}</td>
                                    <td>
                                    @php
                                    $statuses = [1 => 'Active', 2 => 'Inactive', 3 => 'Warning', 4 => 'Temporarily banned', 5 => 'Permanently banned', 6 => 'Disabled'];
                                    @endphp
                                        @if((int) $account->status === 1)
                                            <span class="badge text-bg-success">Active</span>
                                        @else
                                            <span class="badge text-bg-warning">{{ $statuses[(int) $account->status] ?? 'Status '.$account->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($account->moons) }} Bytes</td>
                                    <td>{{ $account->last_activity ? \Carbon\Carbon::parse($account->last_activity)->diffForHumans() : 'Never' }}</td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.users.show', $account) }}" class="btn btn-sm btn-outline-light">Management</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="bi bi-person-x fs-1 text-secondary"></i>
                                        <p class="mt-3 mb-1 fw-semibold">No matching users</p>
                                        <p class="text-secondary mb-0">Try a different UserID or a shorter username fragment.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($users->hasPages())
                    <div class="p-4 border-top border-secondary text-light">{{ $users->links() }}</div>
                @endif
            </section>
    </main>
</div>
@endsection
