<?php
namespace App\Http\Controllers\General\Frontend;
use App\Models\User;
use Illuminate\Http\Request;

class Home
{
    public function home(Request $request)
    {
        $currentUser = User::find(auth()->id());
        if (! $currentUser) {
            return redirect('/');
        }
        $userId = $currentUser->id;
        $friendFeeds = \DB::table('feeds')->join('friends', function ($join) use ($userId) {
            $join->where(function ($q) use ($userId) {
                $q->where('friends.user_id_one', $userId)->whereColumn('friends.user_id_two', 'feeds.user_id');
            })->orWhere(function ($q) use ($userId) {
                $q->where('friends.user_id_two', $userId)->whereColumn('friends.user_id_one', 'feeds.user_id');
            });
        })->join('users', 'feeds.user_id', '=', 'users.id')->select('feeds.id', 'feeds.content', 'feeds.created_at', 'users.id as uid', 'users.username');
        $feeds = \DB::table('feeds')->join('users', 'feeds.user_id', '=', 'users.id')->where('feeds.user_id', $userId)->select('feeds.id', 'feeds.content', 'feeds.created_at', 'users.id as uid', 'users.username')->union($friendFeeds)->orderBy('created_at', 'desc')->limit(9)->get()->map(function ($feed) {
            $feed->created_at = \Carbon\Carbon::parse($feed->created_at);
            return $feed;
        });
        return view('home', ['title' => 'Home - Lunarix', 'currentUser' => $currentUser, 'feeds' => $feeds]);
    }
}
