@extends('admin.layout.root')

@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="admin-page-header">
            <a href="{{ route('admin.games.find', ['q' => $game->id]) }}" class="admin-muted text-decoration-none">&larr; Back to Game Lookup</a>
            <h1 class="mt-2">Edit Game</h1>
            <p>{{ $game->name }} ({{ $game->id }})</p>
        </div>

        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif

        <div class="row g-4">
            <div class="col-xl-8">
                <form method="POST" action="{{ route('admin.games.update', $game) }}" class="admin-asset-form">
                    @csrf
                    @method('PUT')
                    <section class="admin-card p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label" for="gameName">Name</label>
                                <input id="gameName" name="name" value="{{ old('name', $game->name) }}" maxlength="50" class="form-control bg-dark border-secondary text-light" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="gameDescription">Description</label>
                                <textarea id="gameDescription" name="description" maxlength="1000" rows="5" class="form-control bg-dark border-secondary text-light">{{ old('description', $game->description) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="maxPlayers">Maximum players</label>
                                <input id="maxPlayers" type="number" name="max_players" value="{{ old('max_players', $game->max_players) }}" min="1" max="100" class="form-control bg-dark border-secondary text-light" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="gameAccess">Access level</label>
                                <select id="gameAccess" name="access" class="form-select bg-dark border-secondary text-light">
                                    <option value="0" @selected(old('access', $game->access) == 0)>Private</option>
                                    <option value="1" @selected(old('access', $game->access) == 1)>Public</option>
                                    <option value="2" @selected(old('access', $game->access) == 2)>Friends</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check border border-secondary rounded-2 bg-dark p-3 ps-5 h-100">
                                    <input id="gameComments" class="form-check-input" type="checkbox" name="can_comment" value="1" @checked(old('can_comment', $game->can_comment))>
                                    <label for="gameComments" class="form-check-label">Allow comments</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check border border-secondary rounded-2 bg-dark p-3 ps-5 h-100">
                                    <input id="gameDeleted" class="form-check-input" type="checkbox" name="ghosted" value="1" @checked(old('ghosted', $game->ghosted))>
                                    <label for="gameDeleted" class="form-check-label">Mark game as deleted</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check border border-secondary rounded-2 bg-dark p-3 ps-5 h-100">
                                    <input id="gameStaffPicks" class="form-check-input" type="checkbox" name="staff_picks" value="1" @checked(old('staff_picks', $game->staff_picks))>
                                    <label for="gameStaffPicks" class="form-check-label">Staff Picks</label>
                                    <div class="small text-secondary">Show this game in the Staff Picks row.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check border border-secondary rounded-2 bg-dark p-3 ps-5 h-100">
                                    <input id="gameLunarixClassic" class="form-check-input" type="checkbox" name="lunarix_classic" value="1" @checked(old('lunarix_classic', $game->lunarix_classic))>
                                    <label for="gameLunarixClassic" class="form-check-label">Lunarix Classic</label>
                                    <div class="small text-secondary">Show this game in the Lunarix Classics row.</div>
                                </div>
                            </div>
                            <div class="col-12 text-end"><button class="btn btn-primary px-4">Save Changes</button></div>
                        </div>
                    </section>
                </form>
            </div>
            <div class="col-xl-4">
                <section class="admin-card p-4">
                    <img src="/Thumbs/Asset.ashx?assetId={{ $game->id }}" class="img-fluid rounded w-100 mb-3" alt="{{ $game->name }}">
                    <p class="mb-1"><span class="text-secondary">Creator:</span> {{ $game->creator?->username ?? '[unknown]' }} ({{ $game->creator_id }})</p>
                    <p><span class="text-secondary">Visits:</span> {{ number_format($game->visits) }}</p>
                    <a href="/games/{{ $game->id }}/{{ $game->getSlug() }}" target="_blank" rel="noopener" class="btn btn-outline-light w-100">Open Game Page ↗</a>
                    <button type="button" class="btn btn-outline-danger w-100 mt-2" data-bs-toggle="modal" data-bs-target="#gameContentDeletionModal">Content Deletion</button>
                </section>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="gameContentDeletionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light border-secondary">
            <form method="POST" action="{{ route('admin.games.content-deletion', $game) }}">
                @csrf
                <div class="modal-header border-secondary">
                    <div>
                        <h2 class="modal-title h5">Game Content Deletion</h2>
                        <div class="admin-muted small">Choose how to moderate game {{ $game->id }}.</div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-grid gap-2">
                        <label class="form-check border border-warning rounded-2 p-3 ps-5">
                            <input class="form-check-input" type="radio" name="moderation_action" value="hide" required>
                            <span class="form-check-label"><strong>Hide for pending moderation</strong><span class="d-block admin-muted">Keep its content, make it private, block launches, and mark it pending.</span></span>
                        </label>
                        <label class="form-check border border-danger rounded-2 p-3 ps-5">
                            <input class="form-check-input" type="radio" name="moderation_action" value="delete" required>
                            <span class="form-check-label"><strong>Delete game</strong><span class="d-block admin-muted">Delete its public name and description, block delivery and launches, and mark it rejected.</span></span>
                        </label>
                    </div>
                    <div class="alert alert-warning mt-3 mb-0">Both actions stop running game servers when possible. Database records and uploaded place versions remain for moderation and audit history.</div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apply this moderation action to the game?');">Apply moderation</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
