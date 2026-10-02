@extends('admin.layout.root')
@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <h1>Site-wide Alerts</h1>
        <p class="text-secondary">NOTE: only use this at necessary times when needed.</p>
        <p class="text-secondary">
            Current Alert: {{ $latestAlert->alerttext ?? 'None' }}
        </p>
        <form method="POST">
            @csrf
            <input class="form-control mb-3" type="text" name="alerttext" placeholder="Alert text" required>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="confirm" value="1" id="checkChecked" required>
                <label class="form-check-label" for="checkChecked">I confirm that I want to change the site-wide alert.</label>
            </div>
            <button type="submit" class="btn btn-danger" id="applyBtn" disabled>Apply</button>
        </form>
    </main>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('checkChecked');
    const button = document.getElementById('applyBtn');
    checkbox.addEventListener('change', function () {
        button.disabled = !this.checked;
    });
});
</script>
@endsection
