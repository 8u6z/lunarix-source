<?php
namespace App\Http\Controllers\General\Frontend;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class Suspension
{
    public function membershipSuspended(Request $request): View|RedirectResponse
    {
        $currentUser = $request->user();
        if (! $currentUser) {
            return redirect('/login');
        }
        if ((int) $currentUser->status === 1) {
            return redirect('/home');
        }
        $punishment = DB::table('user_bans')->where('userid', $currentUser->id)->whereNull('revoked_at')->latest('id')->first();
        $reasonIds = $punishment ? json_decode($punishment->reasonids ?? '[]', true) : [];
        $reasons = empty($reasonIds) ? collect() : DB::table('user_ban_reasons')->whereIn('id', $reasonIds)->get();
        $canReactivate = (int) $currentUser->status === 3 || ((int) $currentUser->status === 4 && $punishment?->expiry && now()->gte(Carbon::parse($punishment->expiry)));
        return view('membership.suspended', compact('currentUser', 'punishment', 'reasons', 'canReactivate') + ['title' => 'Account Suspended - Lunarix']);
    }

    public function reactivateAccount(Request $request): RedirectResponse
    {
        $currentUser = $request->user();
        abort_unless($currentUser, 403);
        $punishment = DB::table('user_bans')->where('userid', $currentUser->id)->whereNull('revoked_at')->latest('id')->first();
        $canReactivate = (int) $currentUser->status === 3 || ((int) $currentUser->status === 4 && $punishment?->expiry && now()->gte(Carbon::parse($punishment->expiry)));
        abort_unless($canReactivate, 403, 'This account cannot be reactivated yet.');
        DB::transaction(function () use ($currentUser) {
            User::whereKey($currentUser->id)->update(['status' => 1]);
            DB::table('user_bans')->where('userid', $currentUser->id)->whereNull('revoked_at')->update(['revoked_at' => now(), 'updated_at' => now()]);
            DB::table('admin_user_actions')->insert(['actor_id' => $currentUser->id, 'target_id' => $currentUser->id, 'action' => 'user.reactivated', 'details' => json_encode([]), 'created_at' => now()]);
        });
        return redirect('/home');
    }
}
