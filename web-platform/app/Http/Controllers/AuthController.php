<?php
namespace App\Http\Controllers;
use App\Helpers\Filter;
use App\Models\User;
use App\Services\OfficialNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signup(Request $request, OfficialNotification $notifications)
    {
        if (!env('LUNARIX_CREATE_ACCOUNT', false)) {
            return response()->json(['error' => 'Signups are currently disabled.'], 403);
        }
        $request->merge(['username' => $request->input('userName', $request->input('username')), 'birthdate' => $request->input('birthdate') ?? implode('-', [$request->input('lstYears'), str_pad($request->input('lstMonths'), 2, '0', STR_PAD_LEFT), str_pad($request->input('lstDays'), 2, '0', STR_PAD_LEFT)])]);
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'min:3', 'max:20', 'regex:/^[a-zA-Z0-9]+(_?[a-zA-Z0-9]+)?$/',
                function ($attribute, $value, $fail) {
                    if (User::whereRaw('LOWER(username) = ?', [strtolower($value)])->exists()) {
                        $fail('Username is already taken');
                    }
                    if (Filter::isInappropriate($value)) {
                        $fail('Username contains inappropriate words');
                    }
                },
            ],
            'password' => 'required|string|min:6',
            'passwordConfirm' => 'required|same:password',
            'birthdate' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'accesskey' => config('app.access_key_enabled') ? 'required|string' : 'nullable|string'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if (config('services.turnstile.enabled')) {
            $turnstileToken = $request->input('cf-turnstile-response');
            if (empty($turnstileToken)) {
                return response()->json(['errors' => ['turnstile' => ['Please complete the Turnstile verification.']]], 422);
            }
            try {
                $turnstileResponse = Http::asForm()->timeout(10)->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', ['secret' => config('services.turnstile.secret_key'), 'response' => $turnstileToken, 'remoteip' => $request->ip()]);
                if (! $turnstileResponse->successful() || ! $turnstileResponse->json('success')) {
                    \Log::warning('Turnstile verification failed', ['errors' => $turnstileResponse->json('error-codes', []), 'ip' => $request->ip()]);
                    return response()->json(['errors' => ['turnstile' => ['Turnstile verification failed. Please try again.']]], 422);
                }
            } catch (\Throwable $e) {
                \Log::error('Turnstile verification request failed', ['error' => $e->getMessage()]);
                return response()->json(['error' => 'Unable to verify Turnstile. Please try again later.'], 503);
            }
        }
        try {
            $user = DB::transaction(function () use ($request, $notifications) {
                if (config('app.access_key_enabled')) {
                    $affected = DB::table('access_keys')->where('key', trim($request->accesskey))->where('is_used', 0)->update(['is_used' => 1, 'updated_at' => now()]);
                    if ($affected !== 1) {
                        throw new \RuntimeException('Invalid or already used access key');
                    }
                }
                $user = User::create(['username' => $request->username, 'password' => Hash::make($request->password), 'birth_date' => $request->birthdate, 'status' => 1, 'moons' => 0, 'last_activity' => now(), 'is_verified' => 0, 'is_kattus' => 0, 'membership' => 0, 'gender' => $request->gender]);
                $torsoColors = [26, 21, 23, 37, 6];
                DB::table('user_body')->insert(['userid' => $user->id, 'headcolor' => 1, 'leftarmcolor' => 1, 'rightarmcolor' => 1, 'torsocolor' => $torsoColors[array_rand($torsoColors)], 'leftlegcolor' => 45, 'rightlegcolor' => 45, 'avatartype' => 'R6']);
                if (config('app.access_key_enabled')) {
                    DB::table('access_keys')->where('key', trim($request->accesskey))->update(['registered_user' => $user->id]);
                }
                $notifications->sendWelcome($user);
                return $user;
            });
        } catch (\Throwable $e) {
            \Log::error('Signup failed', ['error' => $e->getMessage(), 'username' => $request->username ?? null]);
            return response()->json(['error' => $e->getMessage()], 409);
        }
        Auth::login($user);
        return redirect('/home');
    }

    public function login(Request $request)
    {
        $username = $request->input('username') ?? $request->input('Username');
        $password = $request->input('password') ?? $request->input('Password');
        $returnUrl = $request->input('ReturnUrl', '/home');
        try {
            if (Auth::attempt(['username' => $username, 'password' => $password])) {
                $request->session()->regenerate();
                return redirect()->to($returnUrl);
            }
            return redirect('/login')->with('error', 'Invalid username or password');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong, sorry.');
        }
    }

    public function loginMobile(Request $request)
    {
        $username = $request->input('username') ?? $request->input('Username');
        $password = $request->input('password') ?? $request->input('Password');
        if (!Auth::attempt(['username' => $username, 'password' => $password])) {
            return response()->json(['Status' => 'Error', 'Message' => 'Invalid username or password'], 401);
        }
        $request->session()->regenerate();
        $user = Auth::user();
        return response()->json(['Status' => 'OK', 'UserInfo' => ['UserID' => $user->id, 'UserName' => $user->username, 'RobuxBalance' => (int) $user->moons, 'TicketsBalance' => 0, 'IsAnyBuildersClubMember' => $user->membership >= 1, 'ThumbnailUrl' => 'https://lunarix.lol/Thumbs/Avatar.ashx?userId=' . $user->id]]);
    }

    public function isAuthenticated(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        return Auth::user();
    }

    public function getAuthenticatedUser(Request $request)
    {
        return Auth::user();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
