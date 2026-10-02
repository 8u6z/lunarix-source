<?php
namespace App\Http\Controllers\General\Backend\Users;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserInformation
{
    public function userInformation(Request $request): JsonResponse
    {
        $request->validate(['userId' => ['required_without:username', 'integer', 'min:1'], 'username' => ['required_without:userId', 'string']]);
        $query = User::select(['id', 'username', 'created_at', 'description', 'blurb', 'roleset', 'moons']);
        if ($request->filled('userId')) {
            $user = $query->find($request->query('userId'));
        } else {
            $user = $query->whereRaw('LOWER(username) = LOWER(?)', [$request->query('username')])->first();
        }
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $description = str_replace('${bytes}', 'Bytes [' . number_format($user->moons ?? 0) . ']', $user->description ?? '');
        return response()->json(['id' => $user->id, 'username' => $user->username, 'createdAt' => $user->created_at?->format('Y-m-d'), 'description' => $description, 'blurb' => $user->blurb, 'staff' => $user->roleset >= 1, 'avatar' => rtrim(config('app.url'), '/') . "/Thumbs/Avatar.ashx?userId={$user->id}"]);
    }
}
