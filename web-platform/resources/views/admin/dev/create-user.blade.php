@extends('admin.layout.root')

@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="admin-page-header">
            <h1>Create User</h1>
            <p>Create a account for development or testing.</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>The user could not be created.</strong>
                <ul class="mb-0 mt-2">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.dev.create-user.store') }}">
            @csrf
            <div class="row g-4">
                <div class="col-xl-8">
                    <section class="admin-card p-4">
                        <h2 class="h5 mb-1">Account details</h2>
                        <p class="admin-muted mb-4">The account is created active with a standard Member role.</p>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="createUsername" class="form-label">Username</label>
                                <input id="createUsername" name="username" value="{{ old('username') }}" minlength="3" maxlength="20" pattern="[A-Za-z0-9]+(_?[A-Za-z0-9]+)?" class="form-control bg-dark border-secondary text-light" autocomplete="off" required>
                            </div>
                            <div class="col-md-6">
                                <label for="createBirthDate" class="form-label">Birth date</label>
                                <input id="createBirthDate" type="date" name="birth_date" value="{{ old('birth_date', now()->subYears(18)->format('Y-m-d')) }}" max="{{ now()->format('Y-m-d') }}" class="form-control bg-dark border-secondary text-light" required>
                            </div>
                            <div class="col-md-6">
                                <label for="createPassword" class="form-label">Password</label>
                                <input id="createPassword" type="password" name="password" minlength="6" class="form-control bg-dark border-secondary text-light" autocomplete="new-password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="createPasswordConfirmation" class="form-label">Confirm password</label>
                                <input id="createPasswordConfirmation" type="password" name="password_confirmation" minlength="6" class="form-control bg-dark border-secondary text-light" autocomplete="new-password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="createGender" class="form-label">Gender</label>
                                <select id="createGender" name="gender" class="form-select bg-dark border-secondary text-light" required>
                                    <option value="male" @selected(old('gender') === 'male')>Male</option>
                                    <option value="female" @selected(old('gender') === 'female')>Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="createMembership" class="form-label">Membership</label>
                                <select id="createMembership" name="membership" class="form-select bg-dark border-secondary text-light" required>
                                    @foreach(\App\Models\User::MEMBERSHIP_NAMES as $value => $name)
                                        <option value="{{ $value }}" @selected((int) old('membership', 0) === $value)>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="createMoons" class="form-label">Starting Bytes</label>
                                <input id="createMoons" type="number" name="moons" value="{{ old('moons', 0) }}" min="0" max="2147483647" class="form-control bg-dark border-secondary text-light" required>
                            </div>
                            <div class="col-12">
                                <label for="createDescription" class="form-label">Blurb <span class="admin-muted">(optional)</span></label>
                                <textarea id="createDescription" name="description" rows="4" maxlength="1000" class="form-control bg-dark border-secondary text-light">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="col-xl-4">
                    <section class="admin-card p-4 position-sticky" style="top:1rem;">
                        <h2 class="h5">Create account</h2>
                        <p class="admin-muted">Creating this user cannot be undone. Please make sure all information is correct.</p>
                        <button class="btn btn-primary btn-lg w-100" type="submit">Create user</button>
                    </section>
                </div>
            </div>
        </form>
    </main>
</div>
@endsection
