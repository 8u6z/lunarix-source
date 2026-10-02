<?php
namespace App\View\Components;
use App\Models\Presence;
use App\Models\User;
use Illuminate\View\Component;

abstract class PBadge extends Component
{
    public string $label;
    public string $colorClass;
    public function __construct(User $user)
    {
        $type = Presence::publicResolve($user, auth()->user());
        $this->label = Presence::$labels[$type];
        $this->colorClass = match ($type) {
            Presence::ONLINE => 'rbx-icon-online',
            Presence::IN_GAME => 'rbx-icon-ingame',
            Presence::IN_STUDIO => 'rbx-icon-instudio',
            default => '',
        };
    }
}