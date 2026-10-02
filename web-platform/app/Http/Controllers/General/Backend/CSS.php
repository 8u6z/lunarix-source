<?php
namespace App\Http\Controllers\General\Backend;
use Illuminate\Http\Request;

class CSS
{
    public function cssfetch(Request $request)
    {
        $hash = $request->query('path');
        if (! $hash || ! preg_match('/^[a-zA-Z0-9_\-.]+$/', $hash)) {
            return response('Invalid hash', 400);
        }
        $basePath = storage_path('css');
        $bundlePath = $basePath.'/bundles.json';
        if (! file_exists($bundlePath)) {
            return response('Bundle not found', 500);
        }
        $bundle = json_decode(file_get_contents($bundlePath), true);
        if (! is_array($bundle) || ! isset($bundle[$hash])) {
            return response('Stylesheet not found', 404);
        }
        $files = $bundle[$hash];
        if (! is_array($files)) {
            return response('Invalid bundle format', 500);
        }
        $output = '';
        $output .= "/* 2025-2026 Lunarix.my: Be anything, Build Anything. */\n";
        $output .= "/* 2024-2026 Skyler's Fridge */\n";
        foreach ($files as $file) {
            $file = preg_replace('#^CSS/#', '', $file);
            $file = preg_replace('#^~/#', '', $file);
            $file = ltrim($file, '/');
            $file = preg_replace('/^~\//', '', $file);
            if (str_contains($file, '..') || ! preg_match('/^[a-zA-Z0-9_\/\-.]+\.css$/', $file)) {
                return response('Invalid stylesheet name', 500);
            }
            $filePath = storage_path('css/'.$file);
            if (! file_exists($filePath)) {
                return response("Missing stylesheet: {$file}", 404);
            }
            $contents = trim(file_get_contents($filePath));
            $output .= "/* {$file} */\n";
            $output .= $contents."\n\n";
        }
        return response($output, 200, ['Content-Type' => 'text/css; charset=UTF-8', 'Cache-Control' => 'public, max-age=31536000, immutable', 'X-Content-Type-Options' => 'nosniff']);
    }
}
