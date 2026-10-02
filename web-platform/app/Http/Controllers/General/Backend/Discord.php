<?php
namespace App\Http\Controllers\General\Backend;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class Discord
{
    public function discordRedirect(Request $request): RedirectResponse
    {
        session(['discord_link_redirect' => url()->previous()]);
        return Socialite::driver('discord')->setScopes(['identify'])->redirect();
    }

    public function discordCallback(Request $request): RedirectResponse
    {
        $discordUser = Socialite::driver('discord')->setScopes(['identify'])->user();
        $user = $request->user();
        $returnTo = session('discord_link_redirect', '/');
        session()->forget('discord_link_redirect');
        $existing = User::where('discord_id', $discordUser->getId())->where('id', '!=', $user->id)->first();
        if ($existing) {
            return redirect($returnTo)->with('error', 'That Discord account is already linked to another user.');
        }
        $user->update(['discord_id' => $discordUser->getId()]);
        return redirect($returnTo)->with('status', 'Discord account linked successfully!');
    }

    public function discordUnlink(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $user->update(['discord_id' => null]);
        return redirect(url()->previous())->with('status', 'Discord account unlinked.');
    }
}
