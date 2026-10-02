@extends('admin.layout.root')

@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="admin-page-header">
            <h1>Feed Monitor</h1>
            <p>Review recent feed messages and remove unsafe content.</p>
        </div>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <section class="admin-card p-4 mb-4">
            <form method="GET" action="{{ route('admin.feeds.index') }}" class="row g-3 align-items-end">
                <div class="col-lg-6">
                    <label for="feedQuery" class="form-label">Search</label>
                    <input id="feedQuery" name="q" value="{{ $query }}" class="form-control bg-dark border-secondary text-light" placeholder="Feed ID, user ID, or message text">
                </div>
                <div class="col-lg-2 d-grid">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </section>

        <section class="admin-card overflow-hidden">
            <div class="p-4 border-bottom border-secondary">
                <h2 class="h5 mb-1">Recent Feed Messages</h2>
                <p class="admin-muted mb-0">{{ number_format($feeds->total()) }} total</p>
            </div>
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>User</th>
                            <th>Message</th>
                            <th>Created</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($feeds as $feed)
                            <tr>
                                <td class="ps-4 admin-muted">#{{ $feed->id }}</td>
                                <td>
                                    @if($feed->user)
                                        <a href="{{ route('admin.users.show', $feed->user_id) }}" class="text-light">{{ $feed->user->username }} ({{ $feed->user_id }})</a>
                                    @else
                                        User {{ $feed->user_id }}
                                    @endif
                                </td>
                                <td style="max-width: 520px;">{{ $feed->content ?: 'None' }}</td>
                                <td class="admin-muted">{{ optional($feed->created_at)->format('M j, Y g:i A') }}</td>
                                <td class="text-end pe-4">
                                    @if($feed->content !== '[ Content Deleted ]')
                                        <form method="POST" action="{{ route('admin.feeds.content-deletion', $feed) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit">Content Delete</button>
                                        </form>
                                    @else
                                        <span class="badge text-bg-secondary">Deleted</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center admin-muted py-5">No feed messages found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($feeds->hasPages())
                <div class="p-4 border-top border-secondary">{{ $feeds->links() }}</div>
            @endif
        </section>
    </main>
</div>
@endsection
