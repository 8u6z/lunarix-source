@extends('admin.layout.root')
@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <h1>Access Keys</h1>
        <p class="mb-0 text-secondary">Don't Invite bad ppl please -sukaira</p>
        @if (session('error'))
        <p class="text-danger">{{ session('error') }}</p>
        @endif
        @if (session('success'))
        <p class="text-success">{{ session('success') }}</p>
        @endif
        <form method="POST" action="/administration/keys/create" class="mt-3 mb-3">
            @csrf
            <button type="submit" class="btn btn-light">Create Access Key</button>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Key</th>
                        <th>Created At</th>
                        <th>Used?</th>
                        <th>Registered User</th>
                    </tr>
                </thead>
                <tbody class="table-dark text-light">
                    @forelse ($keys as $index => $key)
                    <tr>
                        <td><code>{{ $key->key }}</code></td>
                        <td>{{ \Carbon\Carbon::parse($key->created_at)->format('Y-m-d H:i') }}</td>
                        <td>
                            @if ($key->is_used)
                            <span class="badge bg-success">Yes</span>
                            @else
                            <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        <td>{{ $key->registered_user ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-secondary">No access keys created yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
