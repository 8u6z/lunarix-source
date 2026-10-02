@php
    $badgeMap = [
        1  => ['name' => 'Staff', 'icon' => 'administrator'],
        2  => ['name' => 'Friendship', 'icon' => 'friendship'],
        3  => ['name' => 'Combat Initiation', 'icon' => 'combat-initiation'],
        4  => ['name' => 'Warrior', 'icon' => 'warrior'],
        5  => ['name' => 'Bloxxer', 'icon' => 'bloxxer'],
        6  => ['name' => 'Homestead', 'icon' => 'homestead'],
        7  => ['name' => 'Bricksmith', 'icon' => 'bricksmith'],
        8  => ['name' => 'Inviter', 'icon' => 'inviter'],
        12 => ['name' => 'Veteran', 'icon' => 'veteran'],
        14 => ['name' => 'Bloxxers Club', 'icon' => 'builders-club'],
        15 => ['name' => 'Turbo Bloxxers Club', 'icon' => 'turbo-builders-club'],
        16 => ['name' => 'Outrageous Bloxxers Club', 'icon' => 'outrageous-builders-club'],
        18 => ['name' => 'Welcome to the Club', 'icon' => 'welcome-to-the-club']
    ];
@endphp

@if($badges->isNotEmpty())
    <ul class="hlist badge-list">
        @foreach($badges as $badgeId)
            @isset($badgeMap[$badgeId])
                <li class="list-item badge-item asset-item" ng-non-bindable>
                    <a href="/Badges.aspx#Badge{{ $badgeId }}" class="badge-link" title="{{ $badgeMap[$badgeId]['name'] }}">
                        <span class="lrx-icon-{{ $badgeMap[$badgeId]['icon'] }}" title="{{ $badgeMap[$badgeId]['name'] }}"></span>
                        <span class="item-name lrx-text-overflow">{{ $badgeMap[$badgeId]['name'] }}</span>
                    </a>
                </li>
            @endisset
        @endforeach
    </ul>
@endif