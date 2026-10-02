<?php
namespace App\Http\Controllers\Admin;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class Dashboard
{
    public function index(): View
    {
        return view('admin.dashboard', ['stats' => ['users' => User::query()->count(), 'users_in_game' => DB::table('game_presences')->count(), 'games' => Asset::query()->where('type', Asset::TYPE_PLACE)->count(), 'groups' => DB::table('groups')->count()]]);
    }
}
