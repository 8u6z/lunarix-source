<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class OfficialNotification
{
    public function send(User|int $recipient, string $subject, string $body): int
    {
        $recipientId = $recipient instanceof User ? $recipient->id : $recipient;

        return DB::table('user_messages')->insertGetId([
            'user_id' => $recipientId,
            'sender_id' => (int) config('notifications.official_sender_id', 1),
            'subject' => $subject,
            'body' => $body,
            'is_read' => false,
            'is_archived' => false,
            'is_system_message' => true,
            'created_at' => now(),
        ]);
    }

    public function sendWelcome(User $recipient): ?int
    {
        if (! config('notifications.welcome.enabled', true)) {
            return null;
        }

        return $this->send(
            $recipient,
            (string) config('notifications.welcome.subject'),
            (string) config('notifications.welcome.body'),
        );
    }
}
