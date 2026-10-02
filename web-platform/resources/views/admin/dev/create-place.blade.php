@extends('admin.layout.root')

@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="admin-page-header">
            <h1>Create Place</h1>
            <p>Publish a Lunarix game.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                @if(session('created_place_id'))
                    <a class="alert-link ms-1" href="{{ route('admin.games.find', ['q' => session('created_place_id')]) }}">Manage game</a>
                @endif
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>The place could not be created.</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.dev.create-place.store') }}" enctype="multipart/form-data" class="admin-asset-form">
            @csrf
            <div class="row g-4">
                <div class="col-xl-8">
                    <section class="admin-card p-4">
                        <h2 class="admin-form-section-title">Game ownership</h2>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label for="placeCreator" class="form-label">Owner user ID</label>
                                <input id="placeCreator" type="number" name="creator_id" value="{{ old('creator_id') }}" min="1" step="1" class="form-control bg-dark border-secondary text-light" placeholder="Enter a user ID" required>
                            </div>
                        </div>

                        <h2 class="admin-form-section-title">Place information</h2>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="placeName" class="form-label">Name</label>
                                <input id="placeName" name="name" value="{{ old('name') }}" maxlength="50" class="form-control bg-dark border-secondary text-light" required>
                            </div>
                            <div class="col-12">
                                <label for="placeDescription" class="form-label">Description</label>
                                <textarea id="placeDescription" name="description" rows="5" maxlength="1000" class="form-control bg-dark border-secondary text-light">{{ old('description') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="placeAccess" class="form-label">Access level</label>
                                <select id="placeAccess" name="access" class="form-select bg-dark border-secondary text-light" required>
                                    <option value="0" @selected((string) old('access', '1') === '0')>Private</option>
                                    <option value="1" @selected((string) old('access', '1') === '1')>Public</option>
                                    <option value="2" @selected((string) old('access', '1') === '2')>Friends</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="placeMaxPlayers" class="form-label">Maximum players</label>
                                <input id="placeMaxPlayers" type="number" name="max_players" value="{{ old('max_players', 8) }}" min="1" max="100" class="form-control bg-dark border-secondary text-light" required>
                            </div>
                            <div class="col-12">
                                <label for="placeFile" class="form-label">Place file</label>
                                <input id="placeFile" type="file" name="file" class="form-control bg-dark border-secondary text-light" accept=".lrxl,.lrxlx" required>
                                <div class="form-text admin-muted">Upload a valid .lrxl or .lrxlx place. Maximum size: 50 MB.</div>
                            </div>
                            <div class="col-12">
                                <div class="form-check border border-secondary rounded-2 bg-dark p-3 ps-5">
                                    <input id="placeComments" class="form-check-input" type="checkbox" name="can_comment" value="1" @checked(old('can_comment', true))>
                                    <label for="placeComments" class="form-check-label">Allow comments</label>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-xl-4">
                    <section class="admin-card p-4 position-sticky" style="top:1rem;">
                        <h2 class="h5">Publish place</h2>
                        <p class="admin-muted">This creates the game, first place version, universe, owner inventory entry, and thumbnail jobs.</p>
                        <button class="btn btn-primary btn-lg w-100" type="submit">Create place</button>
                    </section>
                </div>
            </div>
        </form>
    </main>
</div>
@endsection
