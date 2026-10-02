<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RuntimeException;

class DiscordBot
{
    private function request(string $method, string $path, array $data = [])
    {
        $token = env('DISCORD_BOT_TOKEN');
        if (! $token) {
            throw new RuntimeException('DISCORD_BOT_TOKEN is not configured.');
        }
        return Http::withToken($token, 'Bot')->acceptJson()->{$method}('https://discord.com/api/v10'.$path, $data)->throw();
    }

    public function user(string $discordId): array
    {
        return $this->request('get', '/users/'.$discordId)->json();
    }

    public function member(string $discordId): ?array
    {
        $guild = env('DISCORD_GUILD_ID');
        if (! $guild) {
            throw new RuntimeException('DISCORD_GUILD_ID is not configured.');
        }
        $response = Http::withToken((string) env('DISCORD_BOT_TOKEN'), 'Bot')->acceptJson()->get("https://discord.com/api/v10/guilds/{$guild}/members/{$discordId}");
        return $response->status() === 404 ? null : $response->throw()->json();
    }

    public function sendDm(string $discordId, string $content): void
    {
        $channel = $this->request('post', '/users/@me/channels', ['recipient_id' => $discordId])->json();
        $this->request('post', '/channels/'.$channel['id'].'/messages', ['content' => $content]);
    }

    public function sendApproval(User $user, string $discordId, string $action, string $message): void
    {
        $plain = Str::random(64);
        DB::table('discord_action_tokens')->where('user_id', $user->id)->where('action', $action)->whereNull('used_at')->update(['used_at' => now()]);
        DB::table('discord_action_tokens')->insert([
            'user_id' => $user->id, 'discord_id' => $discordId, 'action' => $action,
            'token_hash' => hash('sha256', $plain), 'expires_at' => now()->addMinutes(30),
            'created_at' => now(), 'updated_at' => now(),
        ]);
        $url = url('/discord/approve/'.$plain);
        $this->sendDm($discordId, $message."\n\n{$url}\n\nThis link expires in 30 minutes. | If you did not request this you can ignore this message.");
    }

    public function boostLevel(array $member): int
    {
        if (empty($member['premium_since'])) {
            return 0;
        }

        $roles = array_map('strval', $member['roles'] ?? []);
        foreach ([3 => 'DISCORD_OBC_ROLE_ID', 2 => 'DISCORD_TBC_ROLE_ID', 1 => 'DISCORD_BC_ROLE_ID'] as $level => $key) {
            $role = env($key);
            if ($role && in_array((string) $role, $roles, true)) return $level;
        }
        return 1;
    }

    public function syncMembershipRole(User $user, int $level): void
    {
        if (! $user->discord_id) {
            return;
        }

        $member = $this->member((string) $user->discord_id);
        if (! $member) {
            throw new RuntimeException('The linked Discord user is not in the configured guild.');
        }

        $membershipRoles = array_values(array_filter([
            1 => env('DISCORD_BC_ROLE_ID'),
            2 => env('DISCORD_TBC_ROLE_ID'),
            3 => env('DISCORD_OBC_ROLE_ID'),
        ]));
        $roles = array_values(array_diff(array_map('strval', $member['roles'] ?? []), array_map('strval', $membershipRoles)));
        $targetRole = match ($level) {
            1 => env('DISCORD_BC_ROLE_ID'),
            2 => env('DISCORD_TBC_ROLE_ID'),
            3 => env('DISCORD_OBC_ROLE_ID'),
            default => null,
        };
        if ($level > 0 && ! $targetRole) {
            throw new RuntimeException('The Discord role for this membership level is not configured.');
        }
        if ($targetRole) {
            $roles[] = (string) $targetRole;
        }

        $guild = env('DISCORD_GUILD_ID');
        if (! $guild) {
            throw new RuntimeException('DISCORD_GUILD_ID is not configured.');
        }
        $this->request('patch', "/guilds/{$guild}/members/{$user->discord_id}", ['roles' => array_values(array_unique($roles))]);
    }
}
