<?php
namespace App\Http\Controllers\RBXApis;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Helpers\Filter;

class Feed
{
    public function post(Request $request)
    {
        $auth = app(AuthController::class);
        $currentUser = $auth->getAuthenticatedUser($request);
        if (!$currentUser) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        $content = trim($request->input('content', ''));
        if (!$content || mb_strlen($content) > 50) {
            return response()->json(['success' => false, 'message' => 'Invalid content.'], 422);
        }
        $content = Filter::isTagged($content);
        \DB::table('feeds')->insert(['user_id' => $currentUser->id, 'content' => $content, 'created_at' => now()]);
        \DB::table('users')->where('id', $currentUser->id)->update(['blurb' => $content]);
        return response()->json(['success' => true]);
    }
}