<?php
namespace App\Http\Controllers\General\Backend\Users;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdateUsername
{
    public function verifyUsernameUpdate(Request $request)
    {
        $user = $request->user();
        $error = $this->validateUsernameChange($user, $request->input('username'), $request->input('password'));
        if ($error !== null) {
            return response()->json(['success' => false, 'message' => $error]);
        }
        return response()->json(['success' => true, 'remainingBalance' => number_format((int) $user->moons - 1000)]);
    }

    public function updateUsername(Request $request)
    {
        $result = DB::transaction(function () use ($request) {
            $user = User::query()->lockForUpdate()->findOrFail($request->user()->id);
            $username = trim((string) $request->input('username'));
            $error = $this->validateUsernameChange($user, $username, $request->input('password'));
            if ($error !== null) {
                return ['success' => false, 'message' => $error];
            }
            $user->username = $username;
            $user->moons -= 1000;
            $user->save();
            return ['success' => true, 'username' => $user->username, 'remainingBalance' => (int) $user->moons];
        });
        return response()->json($result);
    }

    private function validateUsernameChange(User $user, mixed $requestedUsername, mixed $password): ?string
    {
        $username = trim((string) $requestedUsername);
        if (! User::isUsernameValid($username)) {
            return 'Usernames must be 3–20 characters and contain only letters, numbers, and underscores.';
        }
        if (! is_string($password) || $password === '' || ! Hash::check($password, $user->password)) {
            return 'The password you entered is incorrect.';
        }
        if (strcasecmp($username, $user->username) === 0) {
            return 'That is already your username.';
        }
        $usernameTaken = User::query()->where('id', '!=', $user->id)->whereRaw('LOWER(username) = LOWER(?)', [$username])->exists();
        if ($usernameTaken) {
            return 'That username is already taken.';
        }
        if ((int) $user->moons < 1000) {
            return 'You need at least 1,000 Bytes to change your username.';
        }
        return null;
    }
}
