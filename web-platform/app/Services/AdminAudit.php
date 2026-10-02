<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class AdminAudit
{
    public static function record(string $action, array $details = [], ?int $targetId = null, ?int $actorId = null): void
    {
        DB::table('admin_user_actions')->insert([
            'actor_id' => $actorId ?? auth()->id(),
            'target_id' => $targetId,
            'action' => $action,
            'details' => json_encode($details),
            'created_at' => now(),
        ]);
    }
}
