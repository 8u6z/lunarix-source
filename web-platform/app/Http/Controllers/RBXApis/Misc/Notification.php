<?php

namespace App\Http\Controllers\RBXApis\Misc;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Notification extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $pageNumber = max(0, (int) $request->query('pageNumber', 0));
        $pageSize = min(100, max(1, (int) $request->query('pageSize', 20)));

        $query = DB::table('user_messages')
            ->join('users as sender', 'sender.id', '=', 'user_messages.sender_id')
            ->where('user_messages.user_id', $user->id)
            ->where('user_messages.is_system_message', true);

        $total = (clone $query)->count();
        $notifications = $query
            ->select([
                'user_messages.id',
                'user_messages.subject',
                'user_messages.body',
                'user_messages.is_read',
                'user_messages.created_at',
                'sender.id as sender_id',
                'sender.username as sender_username',
            ])
            ->latest('user_messages.created_at')
            ->offset($pageNumber * $pageSize)
            ->limit($pageSize)
            ->get()
            ->map(fn ($notification) => [
                'Id' => $notification->id,
                'Sender' => [
                    'UserId' => $notification->sender_id,
                    'UserName' => $notification->sender_username,
                ],
                'SenderAbsoluteUrl' => '/users/'.$notification->sender_id.'/profile',
                'SenderThumbnail' => [
                    'Url' => '/Thumbs/Avatar.ashx?userId='.$notification->sender_id,
                    'Final' => true,
                ],
                'Subject' => $notification->subject,
                'Body' => $notification->body,
                'IsRead' => (bool) $notification->is_read,
                'IsSystemMessage' => true,
                'DateSent' => Carbon::parse($notification->created_at)->format('Y-m-d\TH:i:s\Z'),
            ]);

        DB::table('user_messages')
            ->where('user_id', $user->id)
            ->where('is_system_message', true)
            ->whereIn('id', $notifications->pluck('Id'))
            ->update(['is_read' => true]);

        return response()->json([
            'Collection' => $notifications,
            'TotalCollectionSize' => $total,
            'TotalMessages' => $total,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ]);
    }
}
