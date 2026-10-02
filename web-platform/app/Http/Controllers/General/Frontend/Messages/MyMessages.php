<?php
namespace App\Http\Controllers\General\Frontend\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyMessages
{
    public function mymessages(Request $request)
    {
        $user = auth()->user();
        if (! $user) {
            return redirect('/login');
        }
        $notificationCount = DB::table('user_messages')->where('user_id', $user->id)->where('is_system_message', true)->count();
        return view('my.messages', ['notificationCount' => $notificationCount, 'title' => 'My Messages - Lunarix']);
    }
}
