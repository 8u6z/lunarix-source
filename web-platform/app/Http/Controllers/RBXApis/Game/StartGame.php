<?php
namespace App\Http\Controllers\RBXApis\Game;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Traits\Ticket;

class StartGame extends Controller
{
    use Ticket;
    public function handle(Request $request): Response|RedirectResponse
    {
        if (!auth()->user()) {
            return response()->json(['status' => 12, 'message' => 'You are not authorized to join'], 403);
        }
        $placeId = $request->query('placeid');
        if (!$placeId) {
            return response('Missing placeid', 400);
        }
        $place = DB::table('assets')->where('id', $placeId)->first();
        if (!$place) {
            return response('Place not found', 404);
        }
        if ($place->ghosted) {
            return response('Place is unavailable', 403);
        }
        $ticket = $this->generateAuthTicket(auth()->id());
        $placeLauncherUrl = 'Game/PlaceLauncher.ashx' . '?' . http_build_query(['request' => 'RequestGame', 'placeId' => $placeId]);
        $launcherArgs = implode('+', ['lunarixmobile://' . $placeLauncherUrl]);
        return redirect()->away($launcherArgs);
    }
}