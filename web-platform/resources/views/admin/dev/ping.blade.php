@extends('admin.layout.root')
@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <h1>Ping Site</h1>
		<p class="text-secondary" id="status"></p>
        <button class="btn btn-danger" id="pingBtn">Ping</button>
    </main>
</div>
<script>
const btn = document.getElementById('pingBtn');
const status = document.getElementById('status');
btn.addEventListener('click', async () => {
    btn.disabled = true;
    const start = performance.now();
    try {
        await fetch('/administration/dev/ping/now', {
            cache: 'no-store'
        });
        const ms = (performance.now() - start).toFixed(2);
        status.innerText = `Pinged | Time: ${ms} ms`;
    } catch (e) {
        status.innerText = "FAIL";
    }
    btn.disabled = false;
});
</script>
@endsection
