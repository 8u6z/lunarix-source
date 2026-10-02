<?php
namespace App\Http\Controllers\RBXApis\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AppSettings
{
    public function client(Request $request): Response
    {
        $path = storage_path('app/public/ClientAppSettings.json');
        if (!file_exists($path)) {
            return response('ClientAppSettings not found', 404);
        }
        return response(file_get_contents($path), 200)->header('Content-Type', 'application/json');
    }

    public function shared(Request $request): Response
    {
        $path = storage_path('app/public/ClientSharedSettings.json');
        if (!file_exists($path)) {
            return response('ClientSharedSettings not found', 404);
        }
        return response(file_get_contents($path), 200)->header('Content-Type', 'application/json');
    }

    public function android(Request $request): Response
    {
        $path = storage_path('app/public/AndroidAppSettings.json');
        if (!file_exists($path)) {
            return response('AndroidAppSettings not found', 404);
        }
        return response(file_get_contents($path), 200)->header('Content-Type', 'application/json');
    }

    public function rcc(Request $request): Response
    {
        $path = storage_path('app/public/RCC.json');
        if (!file_exists($path)) {
            return response('RCCServiceSettings not found', 404);
        }
        return response(file_get_contents($path), 200)->header('Content-Type', 'application/json');
    }

    public function xbox(Request $request): Response
    {
        $path = storage_path('app/public/XboxAppSettings.json');
        if (!file_exists($path)) {
            return response('XboxAppSettings not found', 404);
        }
        return response(file_get_contents($path), 200)->header('Content-Type', 'application/json');
    }
}