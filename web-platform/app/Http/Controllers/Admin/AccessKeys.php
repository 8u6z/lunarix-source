<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\AdminAudit;

class AccessKeys extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect("/login");
        }
        $keys = DB::table('access_keys')->leftJoin('users', 'access_keys.registered_user', '=', 'users.id')->where('access_keys.creator_id', $user->id)->orderByDesc('access_keys.created_at')->select('access_keys.*', 'users.username as registered_username')->get();
        return view('admin.keys', ['keys' => $keys]);
    }
    public function createAccessKey(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect("/login");
        }
        try {
            DB::transaction(function () use ($user) {
                $keyId = DB::table('access_keys')->insertGetId(['key' => 'Lunar-' . strtoupper(Str::random(12)) . '-AccessKey', 'creator_id' => $user->id, 'is_used' => 0, 'registered_user' => null, 'created_at' => now(), 'updated_at' => now()]);
                AdminAudit::record('access_key.created', ['key_id' => $keyId], null, $user->id);
            });
            return redirect()->back()->with('success', 'Successfully made a key, DO NOT share it with suspicious people.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Whoops, seems like something went wrong.');
        }
    }
}
