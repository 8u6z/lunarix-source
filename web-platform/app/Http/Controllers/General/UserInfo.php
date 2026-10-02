<?php
namespace App\Http\Controllers\General;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserInfo
{
    public function show(int $id): JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['errors' => [['code' => 3, 'message' => 'User not found']]], 404);
        }
        $render = \DB::table('user_renders')->where('user_id', $user->id)->first();
        return response()->json([
            'Id' => $user->id,
            'Username' => $user->username,
            'AvatarUri' => $render ? "//cdn.lunarix.lol/{$render->render_path}" : '',
            'AvatarFinal' => $render ? !$render->outdated : false,
            'IsOnline' => $user->last_activity ? $user->last_activity->gt(now()->subMinutes(1)) : false,
        ]);
    }
}