@php
  $generalOpen = request()->is('administration/alert', 'administration/keys*', 'administration/logs*', 'administration/shoutbox*');
  $communityOpen = request()->is('administration/find*', 'administration/users/*', 'administration/games/*', 'administration/feeds*', 'administration/reports*');
  $assetsOpen = request()->is('administration/asset/*');
  $devOpen = request()->is('administration/dev/*');
@endphp
<aside class="admin-sidebar">
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="/administration/dashboard" class="nav-link {{ request()->is('administration/dashboard') ? 'active' : '' }}" aria-current="page">
        <i class="bi bi-house-door pe-none me-2"></i>Dashboard
      </a>
    </li>

    @role(1)
      <li class="nav-item">
        <a href="#general-collapse" class="nav-link d-flex align-items-center" data-bs-toggle="collapse" aria-expanded="{{ $generalOpen ? 'true' : 'false' }}">
          <i class="bi bi-speedometer2 pe-none me-2"></i>
          <span class="flex-grow-1">General</span>
          <i class="bi bi-chevron-down"></i>
        </a>
        <div class="collapse {{ $generalOpen ? 'show' : '' }}" id="general-collapse">
          <ul class="nav flex-column ms-4">
            <li><a href="/administration/shoutbox" class="nav-link {{ request()->is('administration/shoutbox') ? 'active' : '' }}">Shoutbox</a></li>
            @role(6)
              <li><a href="/administration/alert" class="nav-link {{ request()->is('administration/alert') ? 'active' : '' }}">Site-wide Alert</a></li>
            @endrole
            @role(4)
              <li><a href="/administration/logs" class="nav-link {{ request()->is('administration/logs') ? 'active' : '' }}">Mod Logs</a></li>
              <li><a href="/administration/keys" class="nav-link {{ request()->is('administration/keys*') ? 'active' : '' }}">Access Keys</a></li>
            @endrole
          </ul>
        </div>
      </li>
    @endrole

    @role(2)
      <li class="nav-item">
        <a href="#community-collapse" class="nav-link d-flex align-items-center" data-bs-toggle="collapse" aria-expanded="{{ $communityOpen ? 'true' : 'false' }}">
          <i class="bi bi-people pe-none me-2"></i>
          <span class="flex-grow-1">Community</span>
          <i class="bi bi-chevron-down"></i>
        </a>
        <div class="collapse {{ $communityOpen ? 'show' : '' }}" id="community-collapse">
          <ul class="nav flex-column ms-4">
            <li><a href="/administration/find" class="nav-link {{ request()->is('administration/find', 'administration/users/*') ? 'active' : '' }}">User Lookup</a></li>
            <li><a href="/administration/find/game" class="nav-link {{ request()->is('administration/find/game', 'administration/games/*') ? 'active' : '' }}">Game Lookup</a></li>
            <li><a href="/administration/find" class="nav-link {{ request()->is('administration/find/group') ? 'active' : '' }}">Group Lookup</a></li>
            <li><a href="/administration/feeds" class="nav-link {{ request()->is('administration/feeds*') ? 'active' : '' }}">Feed Monitor</a></li>
            <li><a href="/administration/reports" class="nav-link {{ request()->is('administration/reports*') ? 'active' : '' }}">Abuse Reports</a></li>
          </ul>
        </div>
      </li>
    @endrole

    @role(1)
      <li class="nav-item">
        <a href="#assets-collapse" class="nav-link d-flex align-items-center" data-bs-toggle="collapse" aria-expanded="{{ $assetsOpen ? 'true' : 'false' }}">
          <i class="bi bi-grid pe-none me-2"></i>
          <span class="flex-grow-1">Assets</span>
          <i class="bi bi-chevron-down"></i>
        </a>
        <div class="collapse {{ $assetsOpen ? 'show' : '' }}" id="assets-collapse">
          <ul class="nav flex-column ms-4">
            <li><a href="/administration/asset/find" class="nav-link {{ request()->is('administration/asset/find', 'administration/asset/*/edit') ? 'active' : '' }}">Find Asset</a></li>
            <li><a href="/administration/asset/queue" class="nav-link {{ request()->is('administration/asset/queue') ? 'active' : '' }}">Review Queue</a></li>
            @role(4)
              <li><a href="/administration/asset/create" class="nav-link {{ request()->is('administration/asset/create') ? 'active' : '' }}">Create Asset</a></li>
              <li><a href="/administration/asset/migrate" class="nav-link {{ request()->is('administration/asset/migrate') ? 'active' : '' }}">Migrate Asset [BETA]</a></li>
              <li><a href="/administration/asset/rerender" class="nav-link {{ request()->is('administration/asset/rerender') ? 'active' : '' }}">Re-render</a></li>
            @endrole
          </ul>
        </div>
      </li>
    @endrole

    @role(6)
      <li class="nav-item">
        <a href="#dev-collapse" class="nav-link d-flex align-items-center" data-bs-toggle="collapse" aria-expanded="{{ $devOpen ? 'true' : 'false' }}">
          <i class="bi bi-braces-asterisk pe-none me-2"></i>
          <span class="flex-grow-1">Dev</span>
          <i class="bi bi-chevron-down"></i>
        </a>
        <div class="collapse {{ $devOpen ? 'show' : '' }}" id="dev-collapse">
          <ul class="nav flex-column ms-4">
            <li><a href="/administration/dev/ping" class="nav-link {{ request()->is('administration/dev/ping*') ? 'active' : '' }}">Ping</a></li>
            <li><a href="/administration/dev/gs" class="nav-link {{ request()->is('administration/dev/gs') ? 'active' : '' }}">Manage GS</a></li>
            <li><a href="/administration/dev/createuser" class="nav-link {{ request()->is('administration/dev/createuser') ? 'active' : '' }}">Create User</a></li>
            <li><a href="/administration/dev/createplace" class="nav-link {{ request()->is('administration/dev/createplace') ? 'active' : '' }}">Create Place</a></li>
            <li><a href="/administration/dev/gameex" class="nav-link {{ request()->is('administration/dev/gameex') ? 'active' : '' }}">GameEx</a></li>
            <li><a href="/administration/dev/vps" class="nav-link {{ request()->is('administration/dev/vps*') ? 'active' : '' }}">VPS Monitor</a></li>
          </ul>
        </div>
      </li>
    @endrole
  </ul>
</aside>
