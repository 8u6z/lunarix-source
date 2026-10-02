<?php
namespace App\Http\Controllers\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserLookup
{
    public function index(Request $request): View
    {
        $query = trim((string) $request->query('q', ''));
        $usersQuery = User::query()->select(['id', 'username', 'status', 'membership', 'discord_membership', 'roleset', 'moons', 'created_at', 'last_activity', 'discord_id', 'discord_username']);
        if ($query !== '') {
            $usersQuery->where(function ($builder) use ($query) {
                    if (ctype_digit($query)) {
                        $builder->orWhere('id', (int) $query);
                        $builder->orWhere('discord_id', $query);
                    }
                    $builder->orWhereRaw('LOWER(username) LIKE ?', ['%'.strtolower($query).'%']);
                })->orderByRaw('CASE WHEN LOWER(username) = ? THEN 0 ELSE 1 END', [strtolower($query)])->orderBy('id');
        } else {
            $usersQuery->orderBy('id');
        }
        return view('admin.users.find', ['query' => $query, 'users' => $usersQuery->paginate(50)->withQueryString()]);
    }
}
