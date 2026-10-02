<?php
namespace App\Http\Controllers\General\Backend;
use App\Helpers\Filter;
use App\Models\UserPrivacy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateSettings
{
    public function updateSettings(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $validated = $request->validate(['BirthMonth' => ['required', 'integer', 'between:1,12'], 'BirthDay' => ['required', 'integer', 'between:1,31'], 'BirthYear' => ['required', 'integer', 'between:'.(now()->year - 99).','.now()->year], 'Gender' => ['required', Rule::in(['2', '3'])], 'PersonalBlurb' => ['nullable', 'string', 'max:1000'], 'DiscordNotifications' => ['required', 'boolean'], 'ChatVisibilityPrivacy' => ['required', Rule::in(array_keys(UserPrivacy::CHAT_PRIVACY_MAP))], 'GuestMode' => ['required', Rule::in(array_keys(UserPrivacy::GUEST_MODE_MAP))], 'PrivateMessagePrivacy' => ['required', Rule::in(array_keys(UserPrivacy::SCOPE_MAP))], 'FollowMePrivacy' => ['required', Rule::in(array_keys(UserPrivacy::SCOPE_MAP))], 'FriendMePrivacy' => ['required', Rule::in(array_keys(UserPrivacy::SCOPE_MAP))]]);
        if (! checkdate($validated['BirthMonth'], $validated['BirthDay'], $validated['BirthYear'])) {
            return back()->withError(['BirthDay' => 'That is not a valid date.'])->withInput();
        }
        $user->birth_date = sprintf('%04d-%02d-%02d', $validated['BirthYear'], $validated['BirthMonth'], $validated['BirthDay']);
        $user->gender = $validated['Gender'] === '2' ? 'male' : 'female';
        $user->description = Filter::isTagged($validated['PersonalBlurb'] ?? '');
        $user->save();
        UserPrivacy::updateOrCreate(['user_id' => $user->id], ['ChatPrivacy' => UserPrivacy::CHAT_PRIVACY_MAP[$validated['ChatVisibilityPrivacy']], 'GuestMode' => UserPrivacy::GUEST_MODE_MAP[$validated['GuestMode']], 'PrivateMessagePrivacy' => UserPrivacy::SCOPE_MAP[$validated['PrivateMessagePrivacy']], 'FollowMePrivacy' => UserPrivacy::SCOPE_MAP[$validated['FollowMePrivacy']], 'FriendMePrivacy' => UserPrivacy::SCOPE_MAP[$validated['FriendMePrivacy']], 'discord_notifications' => (bool) $validated['DiscordNotifications']]);
        return back();
    }
}
