<?php
namespace App\Http\Controllers\RBXApis\Friends;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CountRequests extends Controller
{
    public function count()
    {
        $userId = request()->user_id;
        if (!$userId) {
            return response()->json(["count" => 0]);
        }
        $count = DB::table('friend_requests')->where('user_id_two', $userId)->count();
        return response()->json(["count" => $count]);
    }
}