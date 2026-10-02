<?php
namespace App\Http\Controllers\General\Frontend\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Inventory
{
    public function userInventory(Request $request, $id)
    {
        $user = auth()->user();
        $vieweduser = DB::table('users')->select('id', 'username')->where('id', $id)->first();
        abort_if(! $vieweduser, 404);
        return view('inventory', ['vieweduser' => $vieweduser, 'user' => $user, 'title' => 'Inventory - Lunarix']);
    }
}
