<?php
namespace App\Http\Controllers\General\Backend\Economy;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetCurrency
{
    public function getCurrency(Request $request, $userid)
    {
        $authController = new AuthController;
        $user = $authController->getAuthenticatedUser($request);
        if (! $user || (int) $user->id !== (int) $userid) {
            return response()->json(['errors' => [['code' => 1, 'message' => 'The user is invalid.']]], 403);
        }
        $dbUser = DB::table('users')->where('id', $userid)->first();
        if (! $dbUser) {
            return response()->json(['errors' => [['code' => 1, 'message' => 'The user is invalid.']]], 404);
        }
        return response()->json(['robux' => (int) $dbUser->moons]);
    }
}
