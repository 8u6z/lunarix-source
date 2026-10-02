<?php
namespace App\Http\Controllers\RBXApis\Game;
use App\Http\Controllers\Controller;
use App\Helpers\Signer;
use App\Traits\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Joinscript extends Controller
{
    use Ticket;
    public function handle(Request $request): Response
    {
        if (!auth()->user()) {
            return response()->json(['status' => 12, 'message' => 'You are not authorized to join'], 403);
        }
        $jobId = $request->query('jobId');
        if (!$jobId) {
            return response('Missing jobId', 400);
        }
        $server = DB::table('game_servers')->where('job_id', $jobId)->first();
        if (!$server) {
            return response('Server not found', 404);
        }
        $place = DB::table('assets')->where('id', $server->asset_id)->first();
        if (!$place) {
            return response('Place not found', 404);
        }
        if ($place->ghosted) {
            return response('Place is unavailable', 404);
        }
        $userId = auth()->id();
        if (!$userId) {
            return response('Unauthorized', 401);
        }
        $user = DB::table('users')->where('id', $userId)->first();
        if (!$user) {
            return response('User not found', 404);
        }
        $universe = DB::table('universes')->where('asset_id', $place->id)->first();
        if (!$universe) {
          return response('Universe not found', 404);
        }
        $membershipMap = [1 => 'BuildersClub', 2 => 'TurboBuildersClub', 3 => 'OutrageousBuildersClub'];
        $privacy = DB::table('user_privacy')->where('user_id', $user->id)->first();
        $isGuest = $privacy && (int) $privacy->GuestMode === 1;
        $displayUsername = $isGuest ? ('Guest ' . random_int(1, 9999)) : $user->username;
        $displayUserId = $isGuest ? -$user->id : $user->id;
        $characterAppearanceUserId = $isGuest ? 26 : $user->id;
        $membership = $isGuest ? 'None' : ($membershipMap[$user->membership] ?? 'None');
        $ticket = $this->generateAuthTicket($user->id);
        $now = now()->format('n/j/Y g:i:s A');
        $payload = [
            'ClientPort' => 0,
            'MachineAddress' => $server->ip_address ?? 'localhost',
            'ServerPort' => $server->port,
            'PingUrl' => '',
            'PingInterval' => 120,
            'UserName' => $displayUsername,
            'SeleniumTestMode' => false,
            'UserId' => $displayUserId,
            'CharacterAppearance' => config('app.url') . '/Asset/CharacterFetch.ashx?userId=' . $characterAppearanceUserId,
            'SuperSafeChat' => false,
            'PlaceId' => $place->id,
            'GameId' => $place->id,
            'MeasurementUrl' => '',
            'WaitingForCharacterGuid' => (string) Str::uuid(),
            'BaseUrl' => config('app.url') . '/',
            'ChatStyle' => 'ClassicAndBubble',
            'VendorId' => 0,
            'ScreenShotInfo' => '',
            'VideoInfo' => '<?xml version="1.0"?><entry xmlns="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:yt="http://gdata.youtube.com/schemas/2007"><media:group><media:title type="plain"><![CDATA[ROBLOX Place]]></media:title><media:description type="plain"><![CDATA[ For more games visit http://www.roblox.com]]></media:description><media:category scheme="http://gdata.youtube.com/schemas/2007/categories.cat">Games</media:category><media:keywords>ROBLOX, video, free game, online virtual world</media:keywords></media:group></entry>',
            'CreatorId' => $place->creator_id,
            'CreatorTypeEnum' => 'User',
            'MembershipType' => $membership,
            'AccountAge' => 0,
            'CookieStoreFirstTimePlayKey' => 'rbx_evt_ftp',
            'CookieStoreFiveMinutePlayKey'=> 'rbx_evt_fmp',
            'CookieStoreEnabled' => true,
            'IsRobloxPlace' => false,
            'GenerateTeleportJoin' => false,
            'IsUnknownOrUnder13' => false,
            'SessionId' => implode('|', [(string) Str::uuid(), $jobId, '0', $server->ip_address ?? 'localhost', '8', $now, '0', 'null', $ticket, 'null', 'null', 'null']),
            'DataCenterId' => 0,
            'FollowUserId' => 0,
            'UniverseId' => $universe->id,
        ];
        $signed = Signer::signJson($payload);
        return response($signed, 200)->header('Content-Type', 'text/plain');
    }
}
