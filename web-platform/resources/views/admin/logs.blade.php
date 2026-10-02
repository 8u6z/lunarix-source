@extends('admin.layout.root')
@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="admin-page-header">
            <h1>Mod Logs</h1>
            <p>Review staff moderation activity and account changes.</p>
        </div>
        <section class="admin-card p-4 mb-4">
            <form method="GET" action="{{ route('admin.logs') }}" class="row g-3 align-items-end">
                <div class="col-lg-7">
                    <label for="logQuery" class="form-label">User, User ID, or log ID</label>
                    <input id="logQuery" name="q" value="{{ $query }}" class="form-control bg-dark border-secondary text-light" placeholder="Search moderators or affected users">
                </div>
                <div class="col-lg-3">
                    <label for="logAction" class="form-label">Action</label>
                    <select id="logAction" name="action" class="form-select bg-dark border-secondary text-light">
                        <option value="">All actions</option>
                        @foreach($actions as $actionOption)
                            <option value="{{ $actionOption }}" @selected($action === $actionOption)>
                                @if($actionOption === 'punishment.reactivated')
                                    Action Reversed
                                @elseif($actionOption === 'user.reactivated')
                                    User Reactivated
                                @else
                                    {{ Str::headline(str_replace('.', ' ', $actionOption)) }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 d-grid"><button class="btn btn-primary" type="submit">Filter logs</button></div>
            </form>
        </section>
        <section class="admin-card overflow-hidden">
            <div class="p-4 border-bottom border-secondary d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h5 mb-1">Recorded actions</h2>
                    <p class="admin-muted mb-0">{{ number_format($logs->total()) }} {{ Str::plural('entry', $logs->total()) }}</p>
                </div>
                @if($query !== '' || $action !== '')<a href="{{ route('admin.logs') }}" class="btn btn-sm btn-outline-light">Clear filters</a>@endif
            </div>
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0">
                    <thead>
                        <tr><th class="ps-4">ID</th><th>Moderator</th><th>Action</th><th>Scope</th><th>Details</th><th class="pe-4">Date</th></tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            @php $details = json_decode($log->details ?? '{}', true) ?: []; @endphp
                            <tr>
                                <td class="ps-4 admin-muted">#{{ $log->id }}</td>
                                <td>
                                    <a href="{{ route('admin.users.show', $log->actor_id) }}" class="text-light">
                                        {{ $log->actor_name ?? 'Unknown' }} ({{ $log->actor_id }})
                                    </a>
                                </td>
                                <td>
                                    @if($log->action === 'punishment.reactivated')
                                        Action Reversed
                                    @elseif($log->action === 'user.reactivated')
                                        User Reactivated
                                    @else
                                        {{ Str::headline(str_replace('.', ' ', $log->action)) }}
                                    @endif
                                </td>
                                <td>
                                    @if($log->target_id)
                                        <a href="{{ route('admin.users.show', $log->target_id) }}" class="text-light">
                                            {{ $log->target_name ?? 'Unknown' }} ({{ $log->target_id }})
                                        </a>
                                    @else
                                        Site
                                    @endif
                                </td>
                                <td>
                                    @if($details)
                                        <button class="btn btn-sm btn-outline-light" type="button" data-bs-toggle="collapse" data-bs-target="#log-details-{{ $log->id }}">View details</button>
                                        <div class="collapse mt-2" id="log-details-{{ $log->id }}">
                                            <div class="bg-black border border-secondary rounded p-2 small">
                                                @foreach($details as $key => $value)
                                                    <div><span class="admin-muted">{{ Str::headline($key) }}:</span> {{ is_array($value) ? json_encode($value) : $value }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <span class="admin-muted">None</span>
                                    @endif
                                </td>
                                <td class="pe-4">
                                    <div>{{ \Carbon\Carbon::parse($log->created_at)->format('M j, Y g:i A') }}</div>
                                    <div class="admin-muted small">{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center admin-muted py-5">No moderation actions match these filters.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($logs->hasPages())
                <div class="p-4 border-top border-secondary">{{ $logs->links() }}</div>
            @endif
        </section>
    </main>
</div>
@endsection
