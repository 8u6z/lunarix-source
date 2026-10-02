<?php
namespace App\Http\Controllers\General\Backend;
use App\Models\User;
use App\Models\Friends\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BCEligibility
{
    const BC_MIN_KNOCKOUTS = 50;
    const BC_MIN_GAMES = 5;
    const BC_MIN_ACCOUNT_AGE_DAYS = 7;
    const BC_MIN_FRIENDS = 3;
    const BC_BAN_FREE_DAYS = 14;
    public static function getBcEligibility(Request $request): array
    {
        $user = $request->user();
        if ($user->membership >= 1) {
            return ['eligible' => false, 'reason' => 'already_redeemed', 'message' => 'You already have Bloxxers Club or a higher tier.', 'checks' => []];
        }
        $accountAgeDays = Carbon::parse($user->created_at)->diffInDays(now());
        $friendCount = Friend::where('user_id_one', $user->id)->orWhere('user_id_two', $user->id)->count();
        $recentBan = DB::table('user_bans')->where('userid', $user->id)->where('is_warning', false)->whereNull('revoked_at')->where('created_at', '>=', now()->subDays(self::BC_BAN_FREE_DAYS))->exists();
        $checks = ['knockouts' => $user->knockout >= self::BC_MIN_KNOCKOUTS, 'account_age' => $accountAgeDays >= self::BC_MIN_ACCOUNT_AGE_DAYS, 'friends' => $friendCount >= self::BC_MIN_FRIENDS, 'no_recent_punishment' => !$recentBan];
        return ['eligible' => !in_array(false, $checks, true), 'checks' => $checks, 'knockouts' => $user->knockout, 'account_age_days' => $accountAgeDays, 'friend_count' => $friendCount];
    }

    public function checkBcEligibility(Request $request)
    {
        return response()->json(self::getBcEligibility($request));
    }

    public function redeemBc(Request $request)
    {
        $eligibility = self::getBcEligibility($request);
        if (!$eligibility['eligible']) {
            return response()->json(['success' => false, 'message' => 'Not eligible.'], 403);
        }
        $user = $request->user();
        $user->update(['membership' => 1]);
        $user->increment('moons', 100);
        return response()->json(['success' => true, 'membership' => $user->membership]);
    }
}