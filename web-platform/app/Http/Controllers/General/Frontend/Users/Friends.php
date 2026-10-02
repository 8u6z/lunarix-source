<?php
namespace App\Http\Controllers\General\Frontend\Users;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Friends
{
    public function userFriends(Request $request, $id)
    {
        $authController = app(AuthController::class);
        $currentUser = $authController->getAuthenticatedUser($request);
        $vieweduser = DB::table('users')->select('id', 'username')->where('id', $id)->first();
        abort_if(! $vieweduser, 404);
        return view('friends', ['vieweduser' => $vieweduser, 'currentUser' => $currentUser, 'title' => 'Friends - Lunarix']);
    }
}
