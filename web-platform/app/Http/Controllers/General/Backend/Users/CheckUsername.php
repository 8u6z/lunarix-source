<?php
namespace App\Http\Controllers\General\Backend\Users;
use App\Helpers\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckUsername
{
    public function checkUsername(Request $request)
    {
        $username = trim($request->query('username', ''));
        if (Filter::isInappropriate($username)) {
            return response()->json(['data' => 3]);
        }
        $taken = DB::table('users')->whereRaw('LOWER(username) = ?', [strtolower($username)])->exists();
        if ($taken) {
            return response()->json(['data' => 2]);
        }
        return response()->json(['data' => 1]);
    }
}
