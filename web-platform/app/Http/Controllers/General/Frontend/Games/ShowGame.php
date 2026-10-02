<?php
namespace App\Http\Controllers\General\Frontend\Games;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;

class ShowGame
{
    public function showGame($id, $slug)
    {
        $game = Asset::with(['creator'])->where('id', $id)->where('type', Asset::TYPE_PLACE)->firstOrFail();
        if ($game->ghosted && (! auth()->check() || (int) auth()->user()->roleset < 1)) {
            abort(404);
        }
        $expectedSlug = $game->getSlug();
        if ($slug !== $expectedSlug) {
            return redirect()->route('games.view', ['id' => $game->id, 'slug' => $expectedSlug]);
        }
        $creatorName = 'Guest';
        $creatorId = 0;
        if ($game->creator) {
            $creatorName = $game->creator->username ?? 'Guest';
            $creatorId = $game->creator->id;
        }
        $likes = DB::table('rates')->where('asset_id', $game->id)->where('rate_type', 1)->count();
        $dislikes = DB::table('rates')->where('asset_id', $game->id)->where('rate_type', 2)->count();
        $favoriteCount = DB::table('favourites')->where('asset_id', $game->id)->count();
        $currentUserId = auth()->id();
        $isFavorited = $currentUserId ? DB::table('favourites')->where('asset_id', $game->id)->where('user_id', $currentUserId)->exists() : false;
        $userVote = $currentUserId ? DB::table('rates')->where('asset_id', $game->id)->where('user_id', $currentUserId)->value('rate_type') : null;
        $gameData = ['id' => $game->id, 'name' => $game->name, 'slug' => $expectedSlug, 'creator_id' => $creatorId, 'creator_name' => $creatorName, 'description' => $game->description ?: 'Looks like there is nothing in here.', 'likes' => $likes, 'dislikes' => $dislikes, 'favorite_count' => $favoriteCount, 'is_favorited' => $isFavorited, 'user_vote' => $userVote, 'visits' => $game->visits ?? 0, 'universe_id' => $game->universe_id, 'onsale' => $game->onsale, 'robux' => $game->robux, 'created_at' => $game->created_at, 'updated_at' => $game->updated_at, 'max_players' => $game->max_players, 'genres' => $game->genres ?? [], 'gear_types' => $game->gear_types ?? []];
        return view('games.view', ['game' => $gameData, 'title' => $game->name . ' - Lunarix']);
    }
}
