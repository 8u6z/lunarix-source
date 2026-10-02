<?php
namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait Ticket
{
    private function generateAuthTicket(int $userId): string
    {
        $existing = DB::table('place_tickets')->where('user_id', $userId)->where('expires_at', '>', now())->first();
        if ($existing) {
            return $existing->ticket;
        }
        $ticket = hash_hmac('sha256', $userId . '|' . time(), config('app.key'));
        DB::table('place_tickets')->insert(['user_id' => $userId, 'ticket' => $ticket, 'created_at' => now(), 'expires_at' => now()->addMinutes(90)]);
        return $ticket;
    }
}