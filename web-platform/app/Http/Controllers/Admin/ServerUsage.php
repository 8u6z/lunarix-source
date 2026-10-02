<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ServerUsage
{
    public function index(): View
    {
        return view('admin.dev.vps', ['metrics' => $this->collectMetrics()]);
    }

    public function metrics(): JsonResponse
    {
        return response()->json($this->collectMetrics())->header('Cache-Control', 'no-store, no-cache, must-revalidate');
    }

    private function collectMetrics(): array
    {
        $load = function_exists('sys_getloadavg') ? sys_getloadavg() : false;
        $cores = $this->cpuCoreCount();
        $cpuPercent = PHP_OS_FAMILY === 'Windows' ? $this->windowsCpuPercent() : $this->cpuPercentFromProcStat();
        $memory = $this->memoryUsage();
        $disk = $this->diskActivity();
        return [
            'timestamp' => now()->toIso8601String(),
            'cpu' => [
                'percent' => $cpuPercent,
                'cores' => $cores,
                'load' => $load ? ['one' => round((float) $load[0], 2), 'five' => round((float) $load[1], 2), 'fifteen' => round((float) $load[2], 2)] : null,
            ],
            'memory' => $memory,
            'disk' => $disk,
            'uptime_seconds' => $this->uptimeSeconds(),
            'runtime' => ['hostname' => gethostname() ?: 'Unknown', 'os' => php_uname('s').' '.php_uname('r').' ('.php_uname('m').')', 'php' => PHP_VERSION, 'laravel' => app()->version()]
        ];
    }

    private function cpuCoreCount(): int
    {
        if (PHP_OS_FAMILY === 'Darwin') {
            $count = (int) trim((string) @shell_exec('/usr/sbin/sysctl -n hw.ncpu'));
            return max(1, $count);
        }
        if (is_readable('/proc/cpuinfo')) {
            preg_match_all('/^processor\s*:/m', (string) file_get_contents('/proc/cpuinfo'), $matches);
            return max(1, count($matches[0]));
        }
        if (PHP_OS_FAMILY === 'Windows') {
            return max(1, (int) getenv('NUMBER_OF_PROCESSORS'));
        }
        return 1;
    }

    private function cpuPercentFromProcStat(): ?float
    {
        if (! is_readable('/proc/stat')) {
            return null;
        }
        $sample = $this->readProcStatTotals();
        if ($sample === null) {
            return null;
        }
        $cacheKey = 'admin:vps:cpu-stat:'.(gethostname() ?: 'unknown');
        $previous = Cache::get($cacheKey);
        Cache::put($cacheKey, $sample, now()->addMinutes(10));
        if (! is_array($previous)) {
            return null;
        }
        $totalDelta = $sample['total'] - (int) $previous['total'];
        $idleDelta = $sample['idle'] - (int) $previous['idle'];
        if ($totalDelta <= 0) {
            return null;
        }
        return round(min(100, max(0, (1 - ($idleDelta / $totalDelta)) * 100)), 1);
    }

    private function readProcStatTotals(): ?array
    {
        $line = (string) @file_get_contents('/proc/stat');
        if (! preg_match('/^cpu\s+(.+)$/m', $line, $m)) {
            return null;
        }
        $fields = array_map('intval', preg_split('/\s+/', trim($m[1])));
        [$user, $nice, $system, $idle, $iowait, $irq, $softirq, $steal] = array_pad($fields, 8, 0);
        $idleAll = $idle + $iowait;
        $nonIdle = $user + $nice + $system + $irq + $softirq + $steal;
        return ['idle' => $idleAll, 'total' => $idleAll + $nonIdle];
    }

    private function memoryUsage(): ?array
    {
        if (is_readable('/proc/meminfo')) {
            $data = (string) file_get_contents('/proc/meminfo');
            preg_match('/MemTotal:\s+(\d+)/', $data, $totalMatch);
            preg_match('/MemAvailable:\s+(\d+)/', $data, $availableMatch);
            $total = ((int) ($totalMatch[1] ?? 0)) * 1024;
            $available = ((int) ($availableMatch[1] ?? 0)) * 1024;
            return $this->capacity($total - $available, $total);
        }
        if (PHP_OS_FAMILY === 'Darwin') {
            $total = (int) trim((string) @shell_exec('/usr/sbin/sysctl -n hw.memsize'));
            $vmStat = (string) @shell_exec('/usr/bin/vm_stat');
            preg_match('/page size of (\d+) bytes/', $vmStat, $pageSizeMatch);
            $pageSize = (int) ($pageSizeMatch[1] ?? 4096);
            $availablePages = 0;
            foreach (['Pages free', 'Pages inactive', 'Pages speculative'] as $label) {
                if (preg_match('/'.preg_quote($label, '/').':\s+(\d+)/', $vmStat, $match)) {
                    $availablePages += (int) $match[1];
                }
            }
            $available = $availablePages * $pageSize;
            return $this->capacity(max(0, $total - $available), $total);
        }
        if (PHP_OS_FAMILY === 'Windows') {
            $data = $this->powershellJson("Get-CimInstance Win32_OperatingSystem | Select-Object TotalVisibleMemorySize,FreePhysicalMemory | ConvertTo-Json -Compress");
            $total = (int) ($data['TotalVisibleMemorySize'] ?? 0) * 1024;
            $available = (int) ($data['FreePhysicalMemory'] ?? 0) * 1024;
            return $this->capacity(max(0, $total - $available), $total);
        }
        return null;
    }

    private function diskActivity(): ?array
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $data = $this->powershellJson("Get-CimInstance Win32_PerfFormattedData_PerfDisk_PhysicalDisk | Where-Object Name -EQ '_Total' | Select-Object PercentDiskTime,DiskReadBytesPersec,DiskWriteBytesPersec | ConvertTo-Json -Compress");
            if (! is_array($data)) {
                return null;
            }
            return ['utilization_percent' => round(min(100, max(0, (float) ($data['PercentDiskTime'] ?? 0))), 1), 'read_bytes_per_second' => max(0, (int) ($data['DiskReadBytesPersec'] ?? 0)), 'write_bytes_per_second' => max(0, (int) ($data['DiskWriteBytesPersec'] ?? 0))];
        }
        if (! is_readable('/proc/diskstats')) {
            return null;
        }
        $readSectors = 0;
        $writtenSectors = 0;
        $busyMilliseconds = 0;
        $deviceCount = 0;
        foreach (file('/proc/diskstats', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [] as $line) {
            $fields = preg_split('/\s+/', trim($line));
            $device = $fields[2] ?? '';
            if (! preg_match('/^(?:sd[a-z]+|vd[a-z]+|xvd[a-z]+|nvme\d+n\d+|mmcblk\d+)$/', $device)) {
                continue;
            }
            $readSectors += (int) ($fields[5] ?? 0);
            $writtenSectors += (int) ($fields[9] ?? 0);
            $busyMilliseconds += (int) ($fields[12] ?? 0);
            $deviceCount++;
        }
        if ($deviceCount === 0) {
            return null;
        }
        $sample = ['timestamp' => microtime(true), 'read_bytes' => $readSectors * 512, 'written_bytes' => $writtenSectors * 512, 'busy_milliseconds' => $busyMilliseconds, 'device_count' => $deviceCount];
        $cacheKey = 'admin:vps:disk-activity:'.(gethostname() ?: 'unknown');
        $previous = Cache::get($cacheKey);
        Cache::put($cacheKey, $sample, now()->addMinutes(10));
        if (! is_array($previous)) {
            return ['utilization_percent' => 0.0, 'read_bytes_per_second' => 0, 'write_bytes_per_second' => 0];
        }
        $elapsedSeconds = max(0.001, $sample['timestamp'] - (float) $previous['timestamp']);
        $elapsedMilliseconds = $elapsedSeconds * 1000;
        return [
            'utilization_percent' => round(min(100, max(0, ($sample['busy_milliseconds'] - (int) $previous['busy_milliseconds']) / ($elapsedMilliseconds * max(1, $deviceCount)) * 100)), 1),
            'read_bytes_per_second' => max(0, (int) round(($sample['read_bytes'] - (int) $previous['read_bytes']) / $elapsedSeconds)),
            'write_bytes_per_second' => max(0, (int) round(($sample['written_bytes'] - (int) $previous['written_bytes']) / $elapsedSeconds))
        ];
    }

    private function capacity(int|float $used, int|float $total): ?array
    {
        if ($total <= 0) {
            return null;
        }
        return ['used_bytes' => (int) $used, 'total_bytes' => (int) $total, 'percent' => round(($used / $total) * 100, 1)];
    }

    private function uptimeSeconds(): ?int
    {
        if (is_readable('/proc/uptime')) {
            return (int) floor((float) explode(' ', trim((string) file_get_contents('/proc/uptime')))[0]);
        }
        if (PHP_OS_FAMILY === 'Darwin') {
            $bootTime = (string) @shell_exec('/usr/sbin/sysctl -n kern.boottime');
            if (preg_match('/sec = (\d+)/', $bootTime, $match)) {
                return max(0, time() - (int) $match[1]);
            }
        }
        if (PHP_OS_FAMILY === 'Windows') {
            $output = $this->powershell("[int]((New-TimeSpan -Start (Get-CimInstance Win32_OperatingSystem).LastBootUpTime -End (Get-Date)).TotalSeconds)");
            return is_numeric($output) ? max(0, (int) $output) : null;
        }
        return null;
    }

    private function windowsCpuPercent(): ?float
    {
        $output = $this->powershell("(Get-CimInstance Win32_PerfFormattedData_PerfOS_Processor | Where-Object Name -EQ '_Total').PercentProcessorTime");
        return is_numeric($output) ? round(min(100, max(0, (float) $output)), 1) : null;
    }

    private function powershellJson(string $command): ?array
    {
        $output = $this->powershell($command);
        if ($output === null || $output === '') {
            return null;
        }
        $decoded = json_decode($output, true);
        return is_array($decoded) ? $decoded : null;
    }

    private function powershell(string $command): ?string
    {
        if (PHP_OS_FAMILY !== 'Windows' || ! function_exists('shell_exec')) {
            return null;
        }
        $escapedCommand = str_replace('"', '\\"', $command);
        $output = @shell_exec('powershell.exe -NoLogo -NoProfile -NonInteractive -Command "'.$escapedCommand.'"');
        if (! is_string($output)) {
            return null;
        }
        $output = trim($output);
        return $output === '' ? null : $output;
    }
}