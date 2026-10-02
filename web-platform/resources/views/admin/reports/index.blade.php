@extends('admin.layout.root')

@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="admin-page-header">
            <h1>Abuse Reports</h1>
            <p>Review in-game and website reports.</p>
        </div>

        <section class="admin-card p-4 mb-4">
            <form method="GET" action="{{ route('admin.reports.index') }}" class="row g-3 align-items-end">
                <div class="col-lg-4">
                    <label for="reportStatus" class="form-label">Status</label>
                    <select id="reportStatus" name="status" class="form-select bg-dark border-secondary text-light">
                        <option value="open" @selected($status === 'open')>Open</option>
                        <option value="resolved" @selected($status === 'resolved')>Resolved</option>
                        <option value="all" @selected($status === 'all')>All</option>
                    </select>
                </div>
                <div class="col-lg-2 d-grid">
                    <button class="btn btn-primary" type="submit">Filter</button>
                </div>
            </form>
        </section>

        <section class="admin-card overflow-hidden">
            <div class="p-4 border-bottom border-secondary">
                <h2 class="h5 mb-1">Reports</h2>
                <p class="admin-muted mb-0">{{ number_format($reports->total()) }} total</p>
            </div>
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Reporter</th>
                            <th>Place</th>
                            <th>Abuser</th>
                            <th>Type</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                            @php $parsed = $report->parsedComment(); @endphp
                            <tr>
                                <td class="ps-4 admin-muted">#{{ $report->id }}</td>
                                <td>
                                    @if($report->reporter)
                                        <a href="{{ route('admin.users.show', $report->UserId) }}" class="text-light">{{ $report->reporter->username }} ({{ $report->UserId }})</a>
                                    @else
                                        User {{ $report->UserId }}
                                    @endif
                                </td>
                                <td>
                                    @if($report->PlaceId > 0)
                                        {{ $report->place?->name ?? 'Place' }} ({{ $report->PlaceId }})
                                    @else
                                        <span class="admin-muted">Website</span>
                                    @endif
                                </td>
                                <td>
                                    @if($parsed['abuser_id'])
                                        @if($abusers->has($parsed['abuser_id']))
                                            <a href="{{ route('admin.users.show', $parsed['abuser_id']) }}" class="text-light">{{ $abusers[$parsed['abuser_id']] }} ({{ $parsed['abuser_id'] }})</a>
                                        @else
                                            User {{ $parsed['abuser_id'] }}
                                        @endif
                                    @else
                                        <span class="admin-muted">Unknown</span>
                                    @endif
                                </td>
                                <td>{{ $parsed['type'] ?: 'Other' }}</td>
                                <td class="text-truncate" style="max-width: 280px;">{{ $parsed['comment'] ?: $report->Comment }}</td>
                                <td>
                                    @if($report->MarkAsResolved)
                                        <span class="badge text-bg-success">Resolved</span>
                                    @else
                                        <span class="badge text-bg-warning">Open</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4"><a href="{{ route('admin.reports.show', $report) }}" class="btn btn-sm btn-outline-light">View</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center admin-muted py-5">No reports found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($reports->hasPages())
                <div class="p-4 border-top border-secondary">{{ $reports->links() }}</div>
            @endif
        </section>
    </main>
</div>
@endsection
