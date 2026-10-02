<?php
namespace App\Http\Controllers\RBXApis\RCC;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Traits\AccessKey;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KillLogger extends Controller
{
    use AccessKey;
    private const STAT_COLUMN_MAP = ['kos' => 'knockout', 'knockouts' => 'knockout', 'wos' => 'wipeout', 'wipeouts' => 'wipeout'];
    public function update(Request $request): JsonResponse
    {
        if (! $this->isRCC($request)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $validated = $request->validate(['playerid' => 'required|integer', 'jobid' => 'required|string', 'stat' => 'required|string', 'delta' => 'required|integer']);
        if ($validated['playerid'] < 0) {
            return response()->json(['error' => 'Guests cannot be logged'], 200);
        }
        $statKey = strtolower($validated['stat']);
        if (! array_key_exists($statKey, self::STAT_COLUMN_MAP)) {
            return response()->json(['error' => 'Unrecognized stat'], 422);
        }
        if ($validated['delta'] === 0) {
            return response()->json(['success' => true]);
        }
        $userExists = DB::table('users')->where('id', $validated['playerid'])->exists();
        if (! $userExists) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $column = self::STAT_COLUMN_MAP[$statKey];
        if ($validated['delta'] > 0) {
            DB::table('users')->where('id', $validated['playerid'])->increment($column, $validated['delta']);
        } else {
            DB::table('users')->where('id', $validated['playerid'])->decrement($column, abs($validated['delta']));
        }
        return response()->json(['success' => true]);
    }
}