<?php
namespace App\Http\Controllers\General\Backend;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class Heartbeat
{
    public function heartbeat(Request $request)
    {
        $data = $request->validate(['presenceType' => 'nullable|integer|min:0|max:3', 'placeId' => 'nullable|integer', 'universeId' => 'nullable|integer']);
        $request->user()->update(['last_activity' => now(), 'presence_type' => $data['presenceType'] ?? Presence::OFFLINE, 'place_id' => $data['placeId'] ?? null, 'universe_id' => $data['universeId'] ?? null]);
        return $this->blankPngResponse();
    }

    private function blankPngResponse()
    {
        $img = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAASsJTYQAAAAASUVORK5CYII=');
        return Response::make($img, 200, ['Content-Type' => 'image/png', 'Cache-Control' => 'no-cache, no-store, must-revalidate', 'Pragma' => 'no-cache', 'Expires' => '0']);
    }
}
