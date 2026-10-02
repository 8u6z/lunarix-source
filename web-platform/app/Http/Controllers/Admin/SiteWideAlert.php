<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Alert;
use App\Services\AdminAudit;
use Illuminate\Support\Facades\DB;

class SiteWideAlert
{
    public function update(Request $request)
    {
        $request->validate(['alerttext' => 'required|string|max:255', 'confirm' => 'accepted']);
        DB::transaction(function () use ($request) {
            $alert = Alert::create(['alerttext' => $request->alerttext, 'isvisible' => true, 'author_id' => auth()->id()]);
            AdminAudit::record('site_alert.created', ['alert_id' => $alert->id, 'text' => $request->alerttext]);
        });
        return redirect('/administration/alert');
    }
}
