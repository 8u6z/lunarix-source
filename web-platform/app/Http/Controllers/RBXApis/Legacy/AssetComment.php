<?php
namespace App\Http\Controllers\RBXApis\Legacy;
use App\Models\Asset;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssetComment extends Controller
{
    public function legacyApi(Request $request): JsonResponse
    {
        $rqtype = $request->query('rqtype');
        return match ($rqtype) {
            'makeComment' => $this->makeComment($request),
            'deleteComment' => $this->deleteComment($request),
            default => response()->json(['errormsg' => 'Unknown request type.']),
        };
    }

    protected function makeComment(Request $request): JsonResponse
    {
        $user = auth()->user();
        if (! $user) {
            return response()->json(['errormsg' => 'You must be logged in to comment.']);
        }
        $assetId = $request->query('assetID');
        $asset = Asset::find($assetId);
        if (! $asset) {
            return response()->json(['errormsg' => 'Invalid asset.']);
        }
        $content = trim((string) $request->getContent());
        if ($content === '') {
            return response()->json(['errormsg' => 'Comment cannot be empty.']);
        }
        if (mb_strlen($content) > 200) {
            return response()->json(['errormsg' => 'Comment cannot exceed 200 characters.']);
        }
        $comment = Comment::create(['user_id' => $user->id, 'asset_id' => $asset->id, 'content' => $content, 'created_at' => now()]);
        return response()->json(['ID' => $comment->id, 'Date' => $comment->created_at->format('n/j/Y'), 'Content' => $comment->content, 'Author' => $user->username, 'AuthorID' => $user->id]);
    }

    protected function deleteComment(Request $request): JsonResponse
    {
        $user = auth()->user();
        if (! $user) {
            return response()->json(['errormsg' => 'You must be logged in.']);
        }
        $comment = Comment::find($request->query('commentID'));
        if (! $comment) {
            return response()->json(['errormsg' => 'Comment not found.']);
        }
        $isOwner = $comment->user_id === $user->id;
        $isModerator = $user->hasMinimumRole(2);
        if (!$isOwner && !$isModerator) {
            return response()->json(['errormsg' => 'Not authorized to delete this comment.']);
        }
        $comment->delete();
        return response()->json(['success' => true]);
    }

    public function getJson(Request $request): JsonResponse
    {
        $assetId = $request->query('assetId');
        $startIndex = (int) $request->query('startindex', 0);
        $pageSize = 10;
        $query = Comment::where('asset_id', $assetId)->with('user')->latest('created_at');
        $maxRows = $query->count();
        $comments = $query->skip($startIndex)->take($pageSize)->get();
        $user = auth()->user();
        $isModerator = $user && $user->hasMinimumRole(2);
        return response()->json([
            'Comments' => $comments->map(function (Comment $comment) {
                return ['Id' => $comment->id, 'AuthorName' => $comment->user->username ?? 'Unknown', 'AuthorId' => $comment->user_id, 'PostedDate' => $comment->created_at->format('n/j/Y'), 'Text' => $comment->content];
            }),
            'MaxRows' => $maxRows,
            'IsUserModerator' => $isModerator
        ]);
    }
}