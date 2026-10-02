@extends('admin.layout.root')

@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="admin-page-header d-flex justify-content-between align-items-start gap-3">
            <div>
                <h1>Abuse Report #{{ $report->id }}</h1>
                <p>Submitted {{ optional($report->CreatedAt)->format('M j, Y g:i A') }}</p>
            </div>
            <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-light">Back to reports</a>
        </div>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <section class="admin-card p-4 mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h2 class="h5 mb-1">Status</h2>
                    <p class="admin-muted mb-0">{{ $report->MarkAsResolved ? 'Resolved' : 'Open' }}</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    @if($report->MarkAsResolved)
                        <form method="POST" action="{{ route('admin.reports.update', $report) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="action" value="reopen">
                            <button class="btn btn-outline-warning" type="submit">Reopen Report</button>
                        </form>
                    @else
                        @if($canContentDelete)
                            <form method="POST" action="{{ route('admin.reports.update', $report) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="content_deletion">
                                <button class="btn btn-danger" type="submit">Content Delete</button>
                            </form>
                        @endif
                        <form method="POST" action="{{ route('admin.reports.update', $report) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="action" value="ignore">
                            <button class="btn btn-outline-light" type="submit">Ignore</button>
                        </form>
                    @endif
                </div>
            </div>
        </section>

        <div class="row g-4">
            <div class="col-xl-5">
                <section class="admin-card p-4">
                    <h2 class="h5">Report Information</h2>
                    <dl class="row mb-0">
                        <dt class="col-sm-4 admin-muted">Reporter</dt>
                        <dd class="col-sm-8">
                            @if($report->reporter)
                                <a href="{{ route('admin.users.show', $report->UserId) }}" class="text-light">{{ $report->reporter->username }} ({{ $report->UserId }})</a>
                            @else
                                User {{ $report->UserId }}
                            @endif
                        </dd>
                        <dt class="col-sm-4 admin-muted">Abuser</dt>
                        <dd class="col-sm-8">
                            @if($abuser)
                                <a href="{{ route('admin.users.show', $abuser->id) }}" class="text-light">{{ $abuser->username }} ({{ $abuser->id }})</a>
                            @elseif($parsed['abuser_id'])
                                User {{ $parsed['abuser_id'] }}
                            @else
                                Unknown
                            @endif
                        </dd>
                        <dt class="col-sm-4 admin-muted">Type</dt>
                        <dd class="col-sm-8">{{ $parsed['type'] ?: 'Other' }}</dd>
                        <dt class="col-sm-4 admin-muted">Comment</dt>
                        <dd class="col-sm-8">{{ $parsed['comment'] ?: 'None' }}</dd>
                        <dt class="col-sm-4 admin-muted">Place</dt>
                        <dd class="col-sm-8">
                            @if($report->PlaceId > 0)
                                {{ $report->place?->name ?? 'Place' }} ({{ $report->PlaceId }})
                            @else
                                Website
                            @endif
                        </dd>
                        <dt class="col-sm-4 admin-muted">Job ID</dt>
                        <dd class="col-sm-8">{{ $report->JobId ?: 'None' }}</dd>
                        <dt class="col-sm-4 admin-muted">Target</dt>
                        <dd class="col-sm-8">{{ $subject['type'] ?: 'Unknown' }} #{{ $subject['id'] ?: 'unknown' }}</dd>
                    </dl>
                </section>
            </div>

            <div class="col-xl-7">
                <section class="admin-card p-4 mb-4">
                    <h2 class="h5">Reported Content</h2>
                    @if($target['kind'] === 'feed')
                        @if($target['record'])
                            <dl class="row mb-0">
                                <dt class="col-sm-3 admin-muted">Feed ID</dt><dd class="col-sm-9">#{{ $target['record']->id }}</dd>
                                <dt class="col-sm-3 admin-muted">User</dt>
                                <dd class="col-sm-9">
                                    @if($target['record']->user)
                                        <a href="{{ route('admin.users.show', $target['record']->user_id) }}" class="text-light">{{ $target['record']->user->username }} ({{ $target['record']->user_id }})</a>
                                    @else
                                        User {{ $target['record']->user_id }}
                                    @endif
                                </dd>
                                <dt class="col-sm-3 admin-muted">Posted</dt><dd class="col-sm-9">{{ optional($target['record']->created_at)->format('M j, Y g:i A') }}</dd>
                                <dt class="col-sm-3 admin-muted">Message</dt><dd class="col-sm-9">{{ $target['record']->content ?: 'None' }}</dd>
                            </dl>
                        @else
                            <p class="admin-muted mb-0">The reported feed message no longer exists.</p>
                        @endif
                    @elseif($target['kind'] === 'asset')
                        @if($target['record'])
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <img src="/Thumbs/Asset.ashx?assetId={{ $target['record']->id }}" alt="" class="img-fluid rounded bg-dark border border-secondary">
                                </div>
                                <div class="col-sm-8">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-4 admin-muted">Asset ID</dt><dd class="col-sm-8">#{{ $target['record']->id }}</dd>
                                        <dt class="col-sm-4 admin-muted">Name</dt><dd class="col-sm-8">{{ $target['record']->name }}</dd>
                                        <dt class="col-sm-4 admin-muted">Type</dt><dd class="col-sm-8">{{ $target['record']->getTypeName() }}</dd>
                                        <dt class="col-sm-4 admin-muted">Creator</dt>
                                        <dd class="col-sm-8">
                                            @if($target['record']->creator)
                                                <a href="{{ route('admin.users.show', $target['record']->creator_id) }}" class="text-light">{{ $target['record']->creator->username }} ({{ $target['record']->creator_id }})</a>
                                            @else
                                                User {{ $target['record']->creator_id }}
                                            @endif
                                        </dd>
                                        <dt class="col-sm-4 admin-muted">Description</dt><dd class="col-sm-8">{{ $target['record']->description ?: 'None' }}</dd>
                                        <dt class="col-sm-4 admin-muted">State</dt><dd class="col-sm-8">{{ $target['record']->ghosted ? 'Deleted/Ghosted' : 'Visible' }}</dd>
                                    </dl>
                                </div>
                            </div>
                        @else
                            <p class="admin-muted mb-0">The reported catalog item no longer exists.</p>
                        @endif
                    @elseif($target['kind'] === 'user')
                        @if($target['record'])
                            <dl class="row mb-0">
                                <dt class="col-sm-3 admin-muted">User</dt><dd class="col-sm-9"><a href="{{ route('admin.users.show', $target['record']->id) }}" class="text-light">{{ $target['record']->username }} ({{ $target['record']->id }})</a></dd>
                                <dt class="col-sm-3 admin-muted">Description</dt><dd class="col-sm-9">{{ $target['record']->description ?: 'None' }}</dd>
                                <dt class="col-sm-3 admin-muted">Blurb</dt><dd class="col-sm-9">{{ $target['record']->blurb ?: 'None' }}</dd>
                            </dl>
                        @else
                            <p class="admin-muted mb-0">The reported user no longer exists.</p>
                        @endif
                    @else
                        <p class="admin-muted mb-0">No detailed preview is available for this report type.</p>
                    @endif
                </section>

                <section class="admin-card p-4 mb-4">
                    <h2 class="h5">Chat Logs</h2>
                    @php $messages = $report->messagesArray(); @endphp
                    @if($messages)
                        <div class="table-responsive">
                            <table class="table admin-table align-middle mb-0">
                                <thead><tr><th>User ID</th><th>GUID</th><th>Message</th></tr></thead>
                                <tbody>
                                    @foreach($messages as $message)
                                        <tr>
                                            <td>{{ $message['userID'] ?? '' }}</td>
                                            <td class="admin-muted small">{{ $message['guid'] ?? '' }}</td>
                                            <td>{{ $message['text'] ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="admin-muted mb-0">No chat logs stored for this report.</p>
                    @endif
                </section>

                <section class="admin-card p-4">
                    <h2 class="h5">Raw XML</h2>
                    <pre class="bg-black border border-secondary rounded p-3 text-light small mb-0" style="white-space: pre-wrap;">{{ $report->RawXML }}</pre>
                </section>
            </div>
        </div>
    </main>
</div>
@endsection
