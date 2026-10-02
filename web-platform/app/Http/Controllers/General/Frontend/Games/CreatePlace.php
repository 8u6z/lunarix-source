<?php
namespace App\Http\Controllers\General\Frontend\Games;
use App\Models\Asset;
use Illuminate\Http\Request;

class CreatePlace
{
    public function createPlace(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/login');
        }
        $placeCount = Asset::where('creator_id', $user->id)->where('type', 9)->count();
        $placeNumber = $placeCount + 1;
        $defaultName = "{$user->username}'s Place Number: {$placeNumber}";
        return view('places.create', ['defaultName' => $defaultName]);
    }
}
