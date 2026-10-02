<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ModLogs
{
    public function index(Request $request): View
    {
        $query = trim((string) $request->query('q', ''));
        $action = trim((string) $request->query('action', ''));
        $logs = DB::table('admin_user_actions')->leftJoin('users as actors', 'actors.id', '=', 'admin_user_actions.actor_id')->leftJoin('users as targets', 'targets.id', '=', 'admin_user_actions.target_id')->select(['admin_user_actions.*', 'actors.username as actor_name', 'targets.username as target_name'])->when($query !== '', function ($builder) use ($query) {
                $builder->where(function ($nested) use ($query) {
                    $nested->whereRaw('LOWER(actors.username) LIKE ?', ['%'.strtolower($query).'%'])->orWhereRaw('LOWER(targets.username) LIKE ?', ['%'.strtolower($query).'%']);
                    if (ctype_digit($query)) {
                        $nested->orWhere('admin_user_actions.actor_id', (int) $query)->orWhere('admin_user_actions.target_id', (int) $query)->orWhere('admin_user_actions.id', (int) $query);
                    }
                });
            })->when($action !== '', fn ($builder) => $builder->where('admin_user_actions.action', $action))->latest('admin_user_actions.id')->paginate(50)->withQueryString();
        $actions = DB::table('admin_user_actions')->distinct()->orderBy('action')->pluck('action');
        return view('admin.logs', compact('logs', 'actions', 'query', 'action'));
    }
}
