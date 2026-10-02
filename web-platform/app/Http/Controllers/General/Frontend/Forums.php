<?php
namespace App\Http\Controllers\General\Frontend;
use App\Helpers\Filter;
use App\Models\Forums\Forum;
use App\Models\Forums\ForumGroup;
use App\Models\Forums\ForumThread;
use App\Models\Forums\ForumThreadPost;
use App\Models\Presence;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class Forums
{
    public function index(): View
    {
        $groups = ForumGroup::with(['forums' => function ($query) {
            $query->withCount('threads')->withCount('posts');
        }])->orderBy('id')->get();
        $latestPostIds = DB::table('forum_thread_posts')->select('forum_thread_posts.id')->distinct('forum_threads.forum_id')->join('forum_threads', 'forum_threads.id', '=', 'forum_thread_posts.thread_id')->orderBy('forum_threads.forum_id')->orderByDesc('forum_thread_posts.created_at')->pluck('id');
        $latestPosts = ForumThreadPost::query()->whereIn('id', $latestPostIds)->with(['author:id,username', 'thread:id,forum_id'])->get()->keyBy(fn ($post) => $post->thread->forum_id);
        return view('forums.index', ['groups' => $groups, 'latestPosts' => $latestPosts]);
    }

    public function showForum(Request $request): View
    {
        $forum = Forum::with('group')->findOrFail($request->query('ForumID'));
        $threads = $forum->threads()->withCount('posts')->with('author:id,username')->orderByDesc('is_pinned')->orderByDesc('updated_at')->paginate(20)->withQueryString();
        $threadIds = $threads->pluck('id');
        $latestPostIds = DB::table('forum_thread_posts')->select('id')->distinct('thread_id')->whereIn('thread_id', $threadIds)->orderBy('thread_id')->orderByDesc('created_at')->pluck('id');
        $latestPosts = ForumThreadPost::query()->whereIn('id', $latestPostIds)->with('author:id,username')->get()->keyBy('thread_id');
        $viewCounts = DB::table('forum_thread_views')->select('thread_id')->selectRaw('count(*) as total')->whereIn('thread_id', $threadIds)->groupBy('thread_id')->pluck('total', 'thread_id');
        return view('forums.showforum', ['forum' => $forum, 'threads' => $threads, 'latestPosts' => $latestPosts, 'viewCounts' => $viewCounts]);
    }

    public function showPost(Request $request): View
    {
        $thread = ForumThread::with('forum.group')->findOrFail($request->query('PostID'));
        $posts = $thread->posts()->with('author:id,username,created_at')->oldest()->paginate(20)->withQueryString();
        $authorIds = $posts->pluck('author_id')->unique();
        $postCounts = ForumThreadPost::query()->whereIn('author_id', $authorIds)->selectRaw('author_id, count(*) as total')->groupBy('author_id')->pluck('total', 'author_id');
        $presenceByAuthor = $posts->getCollection()->pluck('author')->unique('id')->mapWithKeys(fn ($author) => [$author->id => Presence::resolve($author)]);
        if ($request->user()) {
            $this->recordThreadView($thread, $request->user()->id);
        }
        return view('forums.showpost', ['thread' => $thread, 'posts' => $posts, 'postCounts' => $postCounts, 'presenceByAuthor' => $presenceByAuthor]);
    }

    private function recordThreadView(ForumThread $thread, int $userId): void
    {
        $recentView = DB::table('forum_thread_views')->where('thread_id', $thread->id)->where('user_id', $userId)->where('created_at', '>=', now()->subHours(3))->exists();
        if ($recentView) {
            return;
        }
        DB::table('forum_thread_views')->insert(['thread_id' => $thread->id, 'user_id' => $userId, 'created_at' => now()]);
    }

    public function addPostForm(Request $request): View
    {
        $forum = Forum::with('group')->findOrFail($request->query('ForumID'));
        return view('forums.addpost', ['forum' => $forum]);
    }

    public function addPost(Request $request): \Illuminate\Http\RedirectResponse
    {
        $forum = Forum::findOrFail($request->query('ForumID'));
        $validated = $request->validate(['title' => 'required|string|max:60', 'content' => 'required|string|max:1000', 'no_replies' => 'sometimes|boolean']);
        $validated['title'] = Filter::isTagged($validated['title']);
        $validated['content'] = Filter::isTagged($validated['content']);
        $thread = ForumThread::create(['author_id' => $request->user()->id, 'subject' => $validated['title'], 'views' => 0, 'forum_id' => $forum->id, 'is_pinned' => false, 'is_locked' => $request->boolean('no_replies')]);
        $thread->posts()->create(['content' => $validated['content'], 'author_id' => $request->user()->id]);
        return redirect()->route('forums.showpost', ['PostID' => $thread->id]);
    }

    public function newReplyForm(Request $request): View
    {
        $thread = ForumThread::with(['forum.group', 'firstPost.author:id,username'])->findOrFail($request->query('PostID'));
        return view('forums.newreply', ['thread' => $thread]);
    }

    public function newReply(Request $request): \Illuminate\Http\RedirectResponse
    {
        $thread = ForumThread::findOrFail($request->query('PostID'));
        if ($thread->is_locked) {
            abort(403, 'This thread does not allow replies.');
        }
        $validated = $request->validate(['reply_text' => 'required|string|max:1000']);
        $validated['reply_text'] = Filter::isTagged($validated['reply_text']);
        $thread->posts()->create(['content' => $validated['reply_text'], 'author_id' => $request->user()->id]);
        ForumThread::withoutTimestamps(fn () => $thread->touch());
        return redirect()->route('forums.showpost', ['PostID' => $thread->id]);
    }

    public function search(Request $request): View
    {
        if (!$request->has('q')) {
            return view('forums.search.index', ['results' => null, 'query' => '', 'forumId' => 0, 'perPage' => 25, 'find' => 0, 'match' => 0]);
        }
        $query = trim($request->query('q', ''));
        $forumId = (int)$request->query('forumId', 0);
        $perPage = in_array((int)$request->query('perPage'), [10, 25, 50]) ? (int)$request->query('perPage') : 25;
        $find = (int)$request->query('find', 0);
        $match = (int)$request->query('match', 0);

        if ($find === 1) {
            $results = ForumThreadPost::query()->with(['thread:id,subject,forum_id', 'thread.forum:id,name', 'author:id,username'])->whereHas('author', fn($q) => $q->where('username', 'LIKE', '%' . $query . '%'))->when($forumId, fn($q) => $q->whereHas('thread', fn($q2) => $q2->where('forum_id', $forumId)))->orderByDesc('created_at')->paginate($perPage)->withQueryString();
        } else {
            $builder = ForumThreadPost::query()->with(['thread:id,subject,forum_id', 'thread.forum:id,name', 'author:id,username'])->when($forumId, fn($q) => $q->whereHas('thread', fn($q2) => $q2->where('forum_id', $forumId)));
            switch ($match) {
                case 2:
                    $builder->where('content', 'LIKE', '%' . $query . '%');
                    break;
                case 1:
                    $words = array_filter(explode(' ', $query));
                    $builder->where(function($q) use ($words) {
                        foreach ($words as $word) {
                            $q->orWhere('content', 'LIKE', '%' . $word . '%');
                        }
                    });
                    break;
                default:
                    $words = array_filter(explode(' ', $query));
                    $builder->where(function($q) use ($words) {
                        foreach ($words as $word) {
                            $q->where('content', 'LIKE', '%' . $word . '%');
                        }
                    });
                    break;
            }
            $results = $builder->orderByDesc('created_at')->paginate($perPage)->withQueryString();
        }
        return view('forums.search.index', compact('results', 'query', 'forumId', 'perPage', 'find', 'match'));
    }

    public function myforums(Request $request): View
    {
        $userId = $request->user()->id;
        $threadIds = DB::table('forum_thread_posts')->select('thread_id')->where('author_id', $userId)->distinct('thread_id')->orderBy('thread_id')->orderByDesc('created_at')->pluck('thread_id')->take(25);
        $threads = ForumThread::query()->with(['forum:id,name', 'author:id,username'])->withCount('posts')->whereIn('id', $threadIds)->orderByDesc('updated_at')->get();
        $latestPostIds = DB::table('forum_thread_posts')->select('id')->distinct('thread_id')->whereIn('thread_id', $threadIds)->orderBy('thread_id')->orderByDesc('created_at')->pluck('id');
        $latestPosts = ForumThreadPost::query()->whereIn('id', $latestPostIds)->with('author:id,username')->get()->keyBy('thread_id');
        $viewCounts = DB::table('forum_thread_views')->select('thread_id')->selectRaw('count(*) as total')->whereIn('thread_id', $threadIds)->groupBy('thread_id')->pluck('total', 'thread_id');
        return view('forums.myforums', compact('threads', 'latestPosts', 'viewCounts'));
    }

    public function showforumgroup(Request $request): View
    {
        $group = ForumGroup::with(['forums' => function ($query) {
            $query->withCount('threads')->withCount('posts');
        }])->findOrFail($request->query('ForumGroupID'));
        $forumIds = $group->forums->pluck('id');
        $latestPostIds = DB::table('forum_thread_posts')->select('forum_thread_posts.id')->distinct('forum_threads.forum_id')->join('forum_threads', 'forum_threads.id', '=', 'forum_thread_posts.thread_id')->whereIn('forum_threads.forum_id', $forumIds)->orderBy('forum_threads.forum_id')->orderByDesc('forum_thread_posts.created_at')->pluck('id');
        $latestPosts = ForumThreadPost::query()->whereIn('id', $latestPostIds)->with(['author:id,username', 'thread:id,forum_id'])->get()->keyBy(fn ($post) => $post->thread->forum_id);
        return view('forums.showforumgroup', ['group' => $group, 'latestPosts' => $latestPosts]);
    }
}