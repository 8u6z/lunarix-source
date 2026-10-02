@extends('admin.layout.root')

@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h1>VPS Monitor</h1>
                <p class="mb-0 text-secondary">System metrics for {{ $metrics['runtime']['hostname'] }}.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="text-secondary small" id="lastUpdated">Waiting for update…</span>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-xl-3">
                <section class="card bg-dark text-light border-secondary p-4 h-100">
                    <div class="text-secondary small text-uppercase fw-semibold">CPU load</div>
                    <div class="h3 mt-2 mb-0" id="cpuValue">{{ $metrics['cpu']['percent'] !== null ? $metrics['cpu']['percent'].'%' : 'Unavailable' }}</div>
                    <div class="progress mt-3" role="progressbar" aria-label="CPU load">
                        <div id="cpuProgress" class="progress-bar" style="width: {{ $metrics['cpu']['percent'] ?? 0 }}%"></div>
                    </div>
                    <div class="text-secondary small mt-2">{{ $metrics['cpu']['cores'] }} logical cores</div>
                </section>
            </div>
            <div class="col-sm-6 col-xl-3">
                <section class="card bg-dark text-light border-secondary p-4 h-100">
                    <div class="text-secondary small text-uppercase fw-semibold">Memory</div>
                    <div class="h3 mt-2 mb-0" id="memoryValue">{{ $metrics['memory'] ? $metrics['memory']['percent'].'%' : 'Unavailable' }}</div>
                    <div class="progress mt-3" role="progressbar" aria-label="Memory usage">
                        <div id="memoryProgress" class="progress-bar bg-info" style="width: {{ $metrics['memory']['percent'] ?? 0 }}%"></div>
                    </div>
                    <div class="text-secondary small mt-2" id="memoryDetail">Calculating…</div>
                </section>
            </div>
            <div class="col-sm-6 col-xl-3">
                <section class="card bg-dark text-light border-secondary p-4 h-100">
                    <div class="text-secondary small text-uppercase fw-semibold">Disk activity</div>
                    <div class="h3 mt-2 mb-0" id="diskValue">{{ $metrics['disk'] ? $metrics['disk']['utilization_percent'].'%' : 'Unavailable' }}</div>
                    <div class="progress mt-3" role="progressbar" aria-label="Disk activity">
                        <div id="diskProgress" class="progress-bar bg-warning" style="width: {{ $metrics['disk']['utilization_percent'] ?? 0 }}%"></div>
                    </div>
                    <div class="text-secondary small mt-2" id="diskDetail">Read 0 B/s · Write 0 B/s</div>
                </section>
            </div>
            <div class="col-sm-6 col-xl-3">
                <section class="card bg-dark text-light border-secondary p-4 h-100">
                    <div class="text-secondary small text-uppercase fw-semibold">Uptime</div>
                    <div class="h3 mt-2 mb-0" id="uptimeValue">—</div>
                    <div class="text-secondary small mt-3">System uptime since last restart</div>
                </section>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-xl-8">
                <section class="card bg-dark text-light border-secondary p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h2 class="h5 mb-1">Resource history</h2>
                            <p class="text-secondary small mb-0">CPU and memory usage over the last five minutes</p>
                        </div>
                    </div>
                    <div class="admin-chart-wrap"><canvas id="resourceChart"></canvas></div>
                </section>
            </div>
            <div class="col-xl-4">
                <section class="card bg-dark text-light border-secondary p-4 h-100">
                    <h2 class="h5 mb-1">Load averages</h2>
                    <p class="text-secondary small mb-4">System load averages from the last 15 minutes</p>
                    <div class="admin-chart-wrap"><canvas id="loadChart"></canvas></div>
                </section>
            </div>
        </div>

        <section class="card bg-dark text-light border-secondary p-4">
            <h2 class="h5 mb-3">Runtime details</h2>
            <div class="row g-3">
                <div class="col-md-6 col-xl-3">
                    <div class="text-secondary small text-uppercase fw-semibold">Host</div>
                    <div class="mt-1">{{ $metrics['runtime']['hostname'] }}</div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-secondary small text-uppercase fw-semibold">Operating system</div>
                    <div class="mt-1 text-break">{{ $metrics['runtime']['os'] }}</div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-secondary small text-uppercase fw-semibold">PHP</div>
                    <div class="mt-1">{{ $metrics['runtime']['php'] }}</div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-secondary small text-uppercase fw-semibold">Laravel</div>
                    <div class="mt-1">{{ $metrics['runtime']['laravel'] }}</div>
                </div>
            </div>
        </section>
    </main>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
(() => {
    const initialMetrics = @json($metrics);
    const historyLimit = 60;
    const chartColors = {
        grid: 'rgba(255,255,255,.08)',
        text: '#94a3b8',
        cpu: '#5b8cff',
        memory: '#22d3ee'
    };
    Chart.defaults.color = chartColors.text;
    Chart.defaults.borderColor = chartColors.grid;

    const resourceChart = new Chart(document.getElementById('resourceChart'), {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                { label: 'CPU %', data: [], borderColor: chartColors.cpu, backgroundColor: 'rgba(91,140,255,.15)', fill: true, tension: .35, pointRadius: 0 },
                { label: 'Memory %', data: [], borderColor: chartColors.memory, backgroundColor: 'rgba(34,211,238,.10)', fill: true, tension: .35, pointRadius: 0 }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: false,
            interaction: { intersect: false, mode: 'index' },
            scales: { y: { beginAtZero: true, max: 100, ticks: { callback: value => value + '%' } } }
        }
    });

    const loadChart = new Chart(document.getElementById('loadChart'), {
        type: 'bar',
        data: {
            labels: ['1 min', '5 min', '15 min'],
            datasets: [{ label: 'Load', data: [0, 0, 0], backgroundColor: ['#5b8cff', '#7c6cff', '#a855f7'], borderRadius: 8 }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    const formatBytes = bytes => {
        if (bytes === null || bytes === undefined) return 'Unavailable';
        const units = ['B', 'KB', 'MB', 'GB', 'TB'];
        let value = Number(bytes);
        let unit = 0;
        while (value >= 1024 && unit < units.length - 1) {
            value /= 1024;
            unit++;
        }
        return `${value.toFixed(unit >= 3 ? 1 : 0)} ${units[unit]}`;
    };

    const formatUptime = seconds => {
        if (seconds === null || seconds === undefined) return 'Unavailable';
        const days = Math.floor(seconds / 86400);
        const hours = Math.floor((seconds % 86400) / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        return days > 0 ? `${days}d ${hours}h` : `${hours}h ${minutes}m`;
    };

    const setProgress = (id, value) => {
        document.getElementById(id).style.width = `${Math.max(0, Math.min(100, value || 0))}%`;
    };

    const renderMetrics = metrics => {
        const cpu = metrics.cpu.percent;
        const memory = metrics.memory?.percent ?? null;
        const disk = metrics.disk?.utilization_percent ?? null;
        document.getElementById('cpuValue').textContent = cpu === null ? 'Unavailable' : `${Number(cpu).toFixed(1)}%`;
        document.getElementById('memoryValue').textContent = memory === null ? 'Unavailable' : `${Number(memory).toFixed(1)}%`;
        document.getElementById('diskValue').textContent = disk === null ? 'Unavailable' : `${Number(disk).toFixed(1)}%`;
        document.getElementById('memoryDetail').textContent = metrics.memory ? `${formatBytes(metrics.memory.used_bytes)} of ${formatBytes(metrics.memory.total_bytes)}` : 'Unavailable';
        document.getElementById('diskDetail').textContent = metrics.disk
            ? `Read ${formatBytes(metrics.disk.read_bytes_per_second)}/s · Write ${formatBytes(metrics.disk.write_bytes_per_second)}/s`
            : 'Unavailable';
        document.getElementById('uptimeValue').textContent = formatUptime(metrics.uptime_seconds);
        setProgress('cpuProgress', cpu ?? 0);
        setProgress('memoryProgress', memory ?? 0);
        setProgress('diskProgress', disk ?? 0);

        const timestamp = new Date(metrics.timestamp);
        document.getElementById('lastUpdated').textContent = `Last Updated at ${timestamp.toLocaleTimeString()}`;
        const label = timestamp.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        resourceChart.data.labels.push(label);
        resourceChart.data.datasets[0].data.push(cpu);
        resourceChart.data.datasets[1].data.push(memory);
        if (resourceChart.data.labels.length > historyLimit) {
            resourceChart.data.labels.shift();
            resourceChart.data.datasets.forEach(dataset => dataset.data.shift());
        }
        resourceChart.update();

        const load = metrics.cpu.load;
        loadChart.data.datasets[0].data = load ? [load.one, load.five, load.fifteen] : [null, null, null];
        loadChart.update();
    };

    const refresh = async () => {
        try {
            const response = await fetch('/administration/dev/vps/metrics', { cache: 'no-store', headers: { Accept: 'application/json' } });
            if (!response.ok) throw new Error(`HTTP ${response.status}`);
            renderMetrics(await response.json());
        } catch (error) {
            document.getElementById('lastUpdated').textContent = 'Metrics unavailable';
        }
    };

    renderMetrics(initialMetrics);
    window.setInterval(refresh, 5000);
})();
</script>
@endpush
