<?php
namespace App\Http\Controllers\RBXApis\Mobile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaticResp extends Controller
{
    public function checkAppVersion(Request $request)
    {
        return response()->json(['data' => ['UpgradeAction' => 'None']]);
    }
    public function initializeDevice(Request $request)
    {
        return response()->json(['browserTrackerId' => '0', 'appDeviceIdentifier' => null]);
    }
    public function telemetry(Request $request)
    {
        return response('', 200, ['Content-Type' => 'text/plain']);
    }
}