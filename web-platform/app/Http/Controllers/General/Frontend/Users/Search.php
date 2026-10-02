<?php
namespace App\Http\Controllers\General\Frontend\Users;
use App\Models\User;
use App\Models\Presence;
use Illuminate\Http\Request;

class Search
{
    private const RESULTS_PER_USER_PAGE = 10;
    public function searchUsers(Request $request)
    {
        $keyword = trim((string) $request->input('keyword', ''));
        $startRow = max((int) $request->input('startrow', 0), 0);
        $query = User::query()->where('status', '!=', 5);
        if ($keyword !== '') {
            $query->where('username', 'like', '%' . $keyword . '%');
        }
        $total = (clone $query)->count();
        $totalPages = max(1, (int) ceil($total / self::RESULTS_PER_USER_PAGE));
        $currentPage = (int) floor($startRow / self::RESULTS_PER_USER_PAGE) + 1;
        $currentPage = min(max($currentPage, 1), $totalPages);
        $startRow = ($currentPage - 1) * self::RESULTS_PER_USER_PAGE;
        $users = $query->orderByRaw('last_activity IS NULL, last_activity DESC')->skip($startRow)->take(self::RESULTS_PER_USER_PAGE)->get();
        $users->each(function (User $user) {
            $user->presenceState = Presence::resolve($user);
            $user->presenceLabel = Presence::label($user);
            if ($user->description && str_contains($user->description, '${bytes}')) {
                $user->description = str_replace('${bytes}', 'Bytes ['.number_format($user->moons ?? 0).']', $user->description);
            }
        });
        $users = $users->sortBy(function (User $user) {
            return $user->presenceState === Presence::OFFLINE ? 1 : 0;
        })->values();
        return view('search.users', ['keyword' => $keyword, 'users' => $users, 'total' => $total, 'currentPage' => $currentPage, 'totalPages' => $totalPages, 'startRow' => $startRow, 'resultsPerPage' => self::RESULTS_PER_USER_PAGE]);
    }
}
