<?php

if (!function_exists('shortNum')) {
    function formatnum(int $n): string
    {
        if ($n >= 1000000000) return round($n / 1000000000, 1) . 'B+';
        if ($n >= 1000000) return round($n / 1000000, 1) . 'M+';
        if ($n >= 1000) return round($n / 1000, 1) . 'K+';
        return number_format($n);
    }
}