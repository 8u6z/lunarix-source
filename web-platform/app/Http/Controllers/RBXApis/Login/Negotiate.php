<?php
namespace App\Http\Controllers\RBXApis\Login;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class Negotiate extends Controller
{
    public function handle(Request $request): Response
    {
        $suggest = $request->query('suggest');
        if (!$suggest) {
            return response('Missing suggest', 400);
        }
        $ticket = DB::table('place_tickets')->where('ticket', $suggest)->where('expires_at', '>', now())->first();
        if (!$ticket) {
            return response('Invalid or expired ticket', 403);
        }
        $user = DB::table('users')->where('id', $ticket->user_id)->first();
        if (!$user) {
            return response('User not found', 404);
        }
        auth()->loginUsingId($user->id);
        \Log::info('login complete', ['session_id' => $request->session()->getId(), 'cookie_header' => $request->header('Cookie'), 'set_cookie_will_send' => session()->getId(), 'auth_id_after_login' => auth()->id(), 'user_id' => $user->id]);
		return response('', 200);
    }
}
