@extends('admin.layout.root')

@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h1>GameEx</h1>
                <p class="mb-0 text-secondary">Developer controls for game-execution services.</p>
            </div>
            <a href="{{ route('admin.dev.gameex') }}" class="btn btn-outline-light">Refresh</a>
        </div>
        <section class="card bg-dark text-light border-secondary overflow-hidden">
            <div class="p-4 border-bottom border-secondary">
                <h2 class="h5 mb-1">Choose a server</h2>
                <p class="text-secondary mb-0">All open Game Servers declared in the database.</p>
            </div>
            <div class="table-responsive">
                <table class="table table-dark table-bordered align-middle mb-0">
                    <thead class="text-secondary">
                        <tr>
                            <th class="ps-4">Place</th>
                            <th>Connection</th>
                            <th>Health</th>
                            <th>Started</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($servers as $server)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-semibold">{{ $server->place?->name ?? 'Missing place' }}</div>
                                    <a href="/games/{{ $server->asset_id }}/game" target="_blank" rel="noopener" class="small">Place {{ $server->asset_id }} ↗</a>
                                    <div class="small text-secondary text-break" title="{{ $server->job_id }}">Job {{ Str::limit($server->job_id, 18) }}</div>
                                </td>
                                <td>
                                    <div>{{ $server->ip_address }}:{{ $server->port }}</div>
                                    <div class="small text-secondary">SOAP {{ $server->soap_port }}</div>
                                </td>
                                <td>
                                    @if($server->status === 2)
                                        <span class="badge text-bg-success">Running</span>
                                    @elseif($server->status === 1)
                                        <span class="badge text-bg-warning">Starting</span>
                                    @else
                                        <span class="badge text-bg-secondary">Status {{ $server->status }}</span>
                                    @endif
                                    <div class="small text-secondary mt-1">{{ $server->ping !== null ? $server->ping.' ms' : 'Ping unavailable' }} · {{ $server->fps !== null ? $server->fps.' FPS' : 'FPS unavailable' }}</div>
                                </td>
                                <td>
                                    <div>{{ $server->created_at?->diffForHumans() ?? 'Unknown' }}</div>
                                    <div class="small text-secondary">{{ $server->created_at?->format('M j, Y g:i A') }}</div>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.dev.gameex.manage', ['jobId' => $server->job_id]) }}" class="btn btn-sm btn-primary">Manage</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center py-5"><p class="fw-semibold mb-1">No active game servers</p></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<div class="modal fade" id="serverConfirmation" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light border-secondary">
            <div class="modal-header border-secondary"><h2 class="modal-title h5" id="serverConfirmationTitle">Confirm action</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body" id="serverConfirmationBody"></div>
            <div class="modal-footer border-secondary"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button><button type="button" class="btn btn-danger" id="serverConfirmationSubmit">Continue</button></div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
(() => {
    const modalElement = document.getElementById('serverConfirmation');
    const modal = new bootstrap.Modal(modalElement);
    let pendingForm = null;
    document.querySelectorAll('[data-confirm-form]').forEach(button => button.addEventListener('click', () => {
        pendingForm = document.getElementById(button.dataset.confirmForm);
        document.getElementById('serverConfirmationTitle').textContent = button.dataset.confirmTitle;
        document.getElementById('serverConfirmationBody').textContent = button.dataset.confirmBody;
        modal.show();
    }));
    document.getElementById('serverConfirmationSubmit').addEventListener('click', () => {
        if (!pendingForm) return;
        const submit = document.getElementById('serverConfirmationSubmit');
        submit.disabled = true;
        submit.textContent = 'Working…';
        pendingForm.submit();
    });
    modalElement.addEventListener('hidden.bs.modal', () => {
        pendingForm = null;
        const submit = document.getElementById('serverConfirmationSubmit');
        submit.disabled = false;
        submit.textContent = 'Continue';
    });
})();
</script>
@endpush
