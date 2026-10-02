<?php
namespace App\Http\Controllers\Admin;
use App\Helpers\Filter;
use App\Models\User;
use App\Services\AdminAudit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CreateUser
{
    public function index(): View
    {
        return view('admin.dev.create-user');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'min:3',
                'max:20',
                'regex:/^[a-zA-Z0-9]+(_?[a-zA-Z0-9]+)?$/',
                function ($attribute, $value, $fail) {
                    if (User::whereRaw('LOWER(username) = ?', [strtolower($value)])->exists()) {
                        $fail('That username is already taken.');
                    }
                    if (Filter::isInappropriate($value)) {
                        $fail('That username contains inappropriate words.');
                    }
                },
            ],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'birth_date' => ['required', 'date', 'before_or_equal:today'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'moons' => ['required', 'integer', 'min:0', 'max:2147483647'],
            'membership' => ['required', 'integer', Rule::in(array_keys(User::MEMBERSHIP_NAMES))],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);
        $newUser = DB::transaction(function () use ($request, $validated) {
            $newUser = User::create([
                'username' => $validated['username'],
                'password' => Hash::make($validated['password']),
                'birth_date' => $validated['birth_date'],
                'gender' => $validated['gender'],
                'description' => $validated['description'] ?? null,
                'status' => 1,
                'moons' => $validated['moons'],
                'membership' => $validated['membership'],
                'roleset' => 0,
                'last_activity' => now(),
                'last_reward_time' => now(),
                'is_verified' => false,
                'is_kattus' => false,
            ]);
            $torsoColors = [26, 21, 23, 37, 6];
            DB::table('user_body')->insert([
                'userid' => $newUser->id,
                'headcolor' => 1,
                'leftarmcolor' => 1,
                'rightarmcolor' => 1,
                'torsocolor' => $torsoColors[array_rand($torsoColors)],
                'leftlegcolor' => 45,
                'rightlegcolor' => 45,
                'avatartype' => 'R6',
            ]);
            AdminAudit::record('user.created', ['username' => $newUser->username, 'initial_bytes' => (int) $newUser->moons, 'membership' => $newUser->membership_name], $newUser->id, $request->user()->id);
            return $newUser;
        });
        return redirect()->route('admin.users.show', $newUser)->with('success', 'User '.$newUser->username.' was created successfully.');
    }
}
