<?php
namespace App\Http\Controllers\General\Frontend\Messages;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Compose
{
    public function composeMessage(Request $request)
    {
        $auth = app(AuthController::class);
        $currentUser = $auth->getAuthenticatedUser($request);
        if (! $currentUser) {
            return redirect('/login');
        }
        $recipientId = $request->query('recipientId');
        $recipient = null;
        if ($recipientId) {
            if ($currentUser->id == $recipientId) {
                return redirect('/my/messages');
            }
            $recipient = DB::table('users')->select('id', 'username')->where('id', $recipientId)->first();
            if (! $recipient) {
                abort(404);
            }
        }
        return view('messages.compose', ['title' => 'Send Message - Lunarix', 'currentUser' => $currentUser, 'recipient' => $recipient]);
    }
}
