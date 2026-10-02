<?php
namespace App\Http\Controllers\RBXApis;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Helpers\Filter;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class Messages extends Controller
{
    public function getMessages(Request $request): JsonResponse
    {
        $auth = app(AuthController::class);
        $currentUser = $auth->getAuthenticatedUser($request);
        if (!$currentUser) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $messageTab = (int) $request->query('messageTab', 0);
        $pageNumber = (int) $request->query('pageNumber', 0);
        $pageSize = (int) $request->query('pageSize', 20);
        $offset = $pageNumber * $pageSize;
        $query = DB::table('user_messages')->join('users as sender', 'user_messages.sender_id', '=', 'sender.id')->join('users as recipient', 'user_messages.user_id', '=', 'recipient.id')->where('user_messages.is_system_message', false);
        switch ($messageTab) {
            case 0:
                $query->where('user_messages.user_id', $currentUser->id)->where('user_messages.is_archived', false);
                break;
            case 1:
                $query->where('user_messages.sender_id', $currentUser->id);
                break;
            case 3:
                $query->where('user_messages.user_id', $currentUser->id)->where('user_messages.is_archived', true);
                break;
            default:
                return response()->json(['error' => 'Invalid tab'], 400);
        }
        $total = $query->count();
        $messages = $query->select('user_messages.id', 'user_messages.subject', 'user_messages.body', 'user_messages.is_read', 'user_messages.created_at', 'sender.id as sender_id', 'sender.username as sender_username', 'recipient.id as recipient_id', 'recipient.username as recipient_username')->orderBy('user_messages.created_at', 'desc')->offset($offset)->limit($pageSize)->get()->map(function ($message) {
            return [
                'Id' => $message->id,
                'Sender' => [
                    'UserId' => $message->sender_id,
                    'UserName' => $message->sender_username,
                ],
                'SenderAbsoluteUrl' => '/users/' . $message->sender_id . '/profile',
                'SenderThumbnail' => [
                    'Url' => '/Thumbs/Avatar.ashx?userId=' . $message->sender_id,
                    'Final' => true,
                ],
                'Recipient' => [
                    'UserId' => $message->recipient_id,
                    'UserName' => $message->recipient_username,
                ],
                'RecipientAbsoluteUrl' => '/users/' . $message->recipient_id . '/profile',
                'Subject' => $message->subject,
                'Body' => $message->body,
                'IsRead' => (bool) $message->is_read,
                'IsSystemMessage' => false,
                'DateSent' => \Carbon\Carbon::parse($message->created_at)->format('Y-m-d\TH:i:s\Z'),
            ];
        });
        return response()->json(['Collection' => $messages, 'TotalCollectionSize' => $total, 'PageNumber' => $pageNumber, 'PageSize' => $pageSize, 'TotalPages' => (int) ceil($total / $pageSize)]);
    }

    public function sendMessage(Request $request): JsonResponse
    {
        $auth = app(AuthController::class);
        $currentUser = $auth->getAuthenticatedUser($request);
        if (!$currentUser) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $request->validate(['recipientId' => 'required|integer|exists:users,id', 'subject' => 'required|string|max:255', 'body' => 'required|string|max:2000', 'replyMessageId' => 'nullable|integer|exists:user_messages,id', 'includePreviousMessage' => 'nullable|boolean']);
        if ($currentUser->id == $request->recipientId) {
            return response()->json(['error' => 'You cannot send a message to yourself.'], 400);
        }
        $subject = Filter::isTagged($request->subject);
        $body = Filter::isTagged($request->body);
        if ($request->replyMessageId) {
            $previousMessage = DB::table('user_messages')->where('id', $request->replyMessageId)->first();
            if ($previousMessage) {
                $subject = 'RE: ' . Filter::isTagged($previousMessage->subject);
                if ($request->includePreviousMessage) {
                    $body .= '<br><br>--- Previous Message ---<br>' . $previousMessage->body;
                }
            }
        }
        DB::table('user_messages')->insert(['user_id' => $request->recipientId, 'sender_id' => $currentUser->id, 'subject' => $subject, 'body' => $body, 'is_read' => false, 'is_archived' => false, 'is_system_message' => false, 'created_at' => now()]);
        return response()->json(['success' => true]);
    }

    public function markMessagesRead(Request $request): JsonResponse
    {
        $auth = app(AuthController::class);
        $currentUser = $auth->getAuthenticatedUser($request);
        if (!$currentUser) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $request->validate(['messageIds' => 'required|array', 'messageIds.*' => 'integer|exists:user_messages,id']);
        DB::table('user_messages')->whereIn('id', $request->messageIds)->where('user_id', $currentUser->id)->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }
}