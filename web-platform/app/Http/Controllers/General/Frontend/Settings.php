<?php
namespace App\Http\Controllers\General\Frontend;
use App\Models\UserPrivacy;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class Settings
{
    public function settings(): View|RedirectResponse
    {
        $user = auth()->user();
        if (! $user) {
            return redirect('/login');
        }
        $privacy = UserPrivacy::firstOrCreate(['user_id' => $user->id], ['ChatPrivacy' => UserPrivacy::CHAT_NORMAL, 'GuestMode' => UserPrivacy::GUEST_DISABLED, 'PrivateMessagePrivacy' => UserPrivacy::SCOPE_FRIENDS, 'FollowMePrivacy' => UserPrivacy::SCOPE_ALL, 'FriendMePrivacy' => UserPrivacy::SCOPE_ALL]);
        $birthdate = $user->birth_date ? \Carbon\Carbon::parse($user->birth_date) : null;
        return view('my.account', ['title' => 'My Account - Lunarix', 'user' => $user, 'privacy' => $privacy, 'birthMonth' => $birthdate?->month, 'birthDay' => $birthdate?->day, 'birthYear' => $birthdate?->year, 'chatPrivacyLabels' => array_flip(UserPrivacy::CHAT_PRIVACY_MAP), 'guestModeLabels' => array_flip(UserPrivacy::GUEST_MODE_MAP), 'scopeLabels' => array_flip(UserPrivacy::SCOPE_MAP)]);
    }
}
