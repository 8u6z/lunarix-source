<?php
namespace App\Http\Controllers\General\Backend\Games;
use App\Models\Asset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoteOnGame
{
    public function voteOnGame(Request $request): JsonResponse
    {
        $assetId = (int) $request->query('assetId');
        $voteRaw = $request->query('vote');
        $vote = match ($voteRaw) {
            'true' => 1,
            'false' => 2,
            'null', null, '' => null,
            default => null
        };
        if (!$assetId || !Asset::query()->whereKey($assetId)->where('type', Asset::TYPE_PLACE)->exists()) {
            return response()->json(['Success' => false, 'ModalType' => 'UnknownProblem']);
        }
        if (!$request->user()) {
            return response()->json(['Success' => false, 'ModalType' => 'Guest']);
        }
        $userId = $request->user()->id;
        if ($vote === null) {
            DB::table('rates')->where('asset_id', $assetId)->where('user_id', $userId)->delete();
        } else {
            DB::table('rates')->updateOrInsert(['asset_id' => $assetId, 'user_id' => $userId], ['rate_type' => $vote]);
        }
        $upVotes = DB::table('rates')->where('asset_id', $assetId)->where('rate_type', 1)->count();
        $downVotes = DB::table('rates')->where('asset_id', $assetId)->where('rate_type', 2)->count();
        $userVote = match(DB::table('rates')->where('asset_id', $assetId)->where('user_id', $userId)->value('rate_type')) {
            1 => true,
            2 => false,
            default => null
        };
        return response()->json(['Success' => true, 'Model' => ['UpVotes' => $upVotes, 'DownVotes' => $downVotes, 'UserVote' => $userVote]]);
    }
}
