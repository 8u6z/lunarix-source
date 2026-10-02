@extends('admin.layout.root')

@section('content')
@include('admin.layout.header')
<div class="admin-shell">
    @include('admin.layout.sidebar')
    <main class="admin-content">
        @php
            $statuses = [1 => 'Active', 2 => 'Inactive', 3 => 'Warning', 4 => 'Temporarily banned', 5 => 'Permanently banned', 6 => 'Disabled'];
            $canModify = (int) auth()->user()->roleset === 7 || (auth()->id() !== $targetUser->id && (int) auth()->user()->roleset > (int) $targetUser->roleset);
        @endphp
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 admin-page-header">
            <div>
                <a href="/administration/find?q={{ $targetUser->id }}" class="admin-muted text-decoration-none">&larr; Back to User Lookup</a>
                <h1 class="mt-2 mb-1">{{ $targetUser->username }}</h1>
                <p>UserID {{ $targetUser->id }}</p>
            </div>
            <a href="/users/{{ $targetUser->id }}/profile" class="btn btn-outline-light">User Profile</a>
        </div>
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>The change could not be saved.</strong>
                <ul class="mb-0 mt-2">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif
        @unless($canModify)
            <div class="alert alert-warning">You can review this account, but you cannot modify yourself or an account with an equal or higher staff role.</div>
        @endunless
        <div class="row g-4 align-items-start">
            <div class="col-xl-9">
                <section class="admin-card p-4 mb-4">
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div class="bg-dark border border-secondary rounded-3 p-3 text-center">
                                <img src="/Thumbs/Avatar.ashx?userId={{ $targetUser->id }}&x=420&y=420" alt="{{ $targetUser->username }} avatar render" class="img-fluid" style="width:100%;max-width:340px;aspect-ratio:1;object-fit:contain;">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                                <h2 class="h3 mb-0">{{ $targetUser->username }}</h2>
                                @if($targetUser->isStaff())
                                    <span class="badge text-bg-primary">{{ $targetUser->roleset_name }}</span>
                                @endif
                                <span class="badge {{ (int) $targetUser->status === 1 ? 'text-bg-success' : 'text-bg-warning' }}">
                                    {{ $statuses[(int) $targetUser->status] ?? 'Status '.$targetUser->status }}
                                </span>
                            </div>
                            <div class="mb-4">
                                <div class="admin-stat-label mb-2">Description</div>
                                <p class="mb-0 text-break" style="white-space: pre-line;">{{ filled($targetUser->description) ? $targetUser->description : 'This user has not written a blurb.' }}</p>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6"><div class="admin-stat-label">User ID</div><div class="fw-semibold">{{ $targetUser->id }}</div></div>
                                <div class="col-sm-6"><div class="admin-stat-label">Account status</div><div class="fw-semibold">{{ $statuses[(int) $targetUser->status] ?? 'Status '.$targetUser->status }}</div></div>
                                <div class="col-sm-6"><div class="admin-stat-label">Joined</div><div class="fw-semibold">{{ $targetUser->created_at?->format('M j, Y g:i A') ?? 'Unknown' }}</div></div>
                                <div class="col-sm-6"><div class="admin-stat-label">Last active</div><div class="fw-semibold">{{ $targetUser->last_activity ? \Carbon\Carbon::parse($targetUser->last_activity)->diffForHumans() : 'Never' }}</div></div>
                                <div class="col-sm-6"><div class="admin-stat-label">Membership</div><div class="fw-semibold">{{ $targetUser->membership_name }}</div></div>
                                <div class="col-sm-6"><div class="admin-stat-label">Balance</div><div class="fw-semibold">{{ number_format($targetUser->moons) }} Bytes</div></div>
                                @if($targetUser->isStaff())
                                    <div class="col-sm-6"><div class="admin-stat-label">Staff role</div><div class="fw-semibold">{{ $targetUser->roleset_name }}</div></div>
                                @endif
                                <div class="col-sm-6"><div class="admin-stat-label">Discord</div><div class="fw-semibold">{{ $targetUser->discord_id ?: 'Not linked' }}</div></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="admin-card overflow-hidden mb-4">
                    <div class="p-4 border-bottom border-secondary d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="h4 mb-1">Created games</h2>
                            <p class="admin-muted mb-0">All places created by this user.</p>
                        </div>
                        <span class="badge text-bg-secondary">{{ $games->count() }}</span>
                    </div>
                    <div class="list-group list-group-flush">
                        @forelse($games as $game)
                            <a href="{{ route('games.view', ['id' => $game->id, 'slug' => $game->getSlug()]) }}"
                               class="list-group-item list-group-item-action bg-dark text-light border-secondary p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="/Thumbs/Asset.ashx?assetId={{ $game->id }}&width=100&height=100" alt="" width="72" height="72" class="rounded border border-secondary object-fit-cover">
                                    <div class="flex-grow-1 min-w-0">
                                        <div class="fw-semibold">{{ $game->name }}</div>
                                        <div class="admin-muted small">Place ID {{ $game->id }} · {{ number_format($game->visits ?? 0) }} visits · Updated {{ $game->updated_at?->diffForHumans() ?? 'unknown' }}</div>
                                        <div class="admin-muted small text-truncate">{{ $game->description ?: 'No description.' }}</div>
                                    </div>
                                    <span aria-hidden="true">&rarr;</span>
                                </div>
                            </a>
                        @empty
                            <div class="text-center admin-muted py-5">This user has not created any games.</div>
                        @endforelse
                    </div>
                </section>
                <section class="admin-card overflow-hidden mb-4">
                    <div class="p-4 border-bottom border-secondary d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="h4 mb-1">Created groups</h2>
                            <p class="admin-muted mb-0">Groups owned by this user.</p>
                        </div>
                        <span class="badge text-bg-secondary">{{ $createdGroups->count() }}</span>
                    </div>
                    <div class="list-group list-group-flush">
                        @forelse($createdGroups as $group)
                            <a href="/groups/{{ $group->id }}" target="_blank" rel="noopener" class="list-group-item list-group-item-action bg-dark text-light border-secondary p-3">
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div class="min-w-0">
                                        <div class="fw-semibold">{{ $group->name }}</div>
                                        <div class="admin-muted small">Group ID {{ $group->id }} · Created {{ $group->created_at ? \Carbon\Carbon::parse($group->created_at)->format('M j, Y') : 'unknown' }}</div>
                                        <div class="admin-muted small text-truncate">{{ $group->description ?: 'No description.' }}</div>
                                    </div>
                                    <span class="btn btn-sm btn-outline-light flex-shrink-0">Open <span aria-hidden="true">↗</span></span>
                                </div>
                            </a>
                        @empty
                            <div class="text-center admin-muted py-5">This user has not created any groups.</div>
                        @endforelse
                    </div>
                </section>
                <section class="admin-card overflow-hidden">
                    <div class="p-4 border-bottom border-secondary">
                        <h2 class="h4 mb-1">Recent moderation actions</h2>
                        <p class="admin-muted mb-0">The latest recorded account actions.</p>
                    </div>
                    <div class="table-responsive">
                        <table class="table admin-table align-middle mb-0">
                            <thead><tr><th class="ps-4">Action</th><th>Moderator</th><th>Details</th><th class="pe-4">Date</th></tr></thead>
                            <tbody>
                                @forelse($accountActions as $accountAction)
                                    @php $actionDetails = json_decode($accountAction->details ?? '{}', true) ?: []; @endphp
                                    <tr>
                                        <td class="ps-4">
                                            @if($accountAction->action === 'punishment.reactivated')
                                                Action Reversed
                                            @elseif($accountAction->action === 'user.reactivated')
                                                User Reactivated
                                            @else
                                                {{ Str::headline(str_replace('.', ' ', $accountAction->action)) }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $accountAction->actor_name ?? 'Unknown' }} ({{ $accountAction->actor_id }})
                                        </td>
                                        <td>
                                            @forelse($actionDetails as $key => $value)
                                                <div><span class="admin-muted">{{ Str::headline($key) }}:</span> {{ is_array($value) ? json_encode($value) : Str::limit((string) $value, 80) }}</div>
                                            @empty
                                                <span class="admin-muted">None</span>
                                            @endforelse
                                        </td>
                                        <td class="pe-4">{{ \Carbon\Carbon::parse($accountAction->created_at)->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center admin-muted py-4">No moderation actions recorded.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($accountActions->hasPages())
                        <div class="p-3 border-top border-secondary">
                            {{ $accountActions->links() }}
                        </div>
                    @endif
                </section>
            </div>
            <div class="col-xl-3">
                <aside class="admin-card p-3 position-sticky" style="top:1rem;">
                    <div class="admin-stat-label mb-3">Account actions</div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-danger text-start" data-bs-toggle="modal" data-bs-target="#punishmentModal" @disabled(!$canModify)>Punish user</button>
                        <button class="btn btn-outline-danger text-start" data-bs-toggle="modal" data-bs-target="#contentDeletionModal" @disabled(!$canModify)>Content Deletion</button>
                        @if((int) $targetUser->status !== 1)
                            <form method="POST" action="{{ route('admin.users.reactivate', $targetUser) }}">
                                @csrf
                                <button class="btn btn-success text-start w-100" type="submit" @disabled(!$canModify)>Reactivate account</button>
                            </form>
                        @endif
                        <button class="btn btn-outline-light text-start" data-bs-toggle="modal" data-bs-target="#messageModal" @disabled(!$canModify)>Send message</button>
                        <button class="btn btn-outline-light text-start d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#joinedGroupsModal">
                            <span>View joined groups</span>
                            <span class="badge text-bg-secondary">{{ $joinedGroups->count() }}</span>
                        </button>
                        <button class="btn btn-outline-light text-start d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#friendsModal">
                            <span>View friends</span>
                            <span class="badge text-bg-secondary">{{ $targetFriends->count() }}</span>
                        </button>
                        @role(4)
                            <button class="btn btn-outline-light text-start" data-bs-toggle="modal" data-bs-target="#currencyModal" @disabled(!$canModify)>Modify currency</button>
                            <button class="btn btn-outline-light text-start" data-bs-toggle="modal" data-bs-target="#membershipModal" @disabled(!$canModify)>Modify membership</button>
                            <button class="btn btn-outline-light text-start d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#inventoryModal" @disabled(!$canModify)>
                                <span>Manage catalog items</span>
                                <span class="badge text-bg-secondary">{{ $inventory->count() }}</span>
                            </button>
                        @endrole
                        @role(5)
                            <button class="btn btn-outline-warning text-start" data-bs-toggle="modal" data-bs-target="#staffRoleModal" @disabled(!$canModify)>Assign staff rank</button>
                        @endrole
                        @role(4)
                            <div class="admin-stat-label border-top border-secondary pt-3 mt-2">Discord</div>
                            @if($targetUser->discord_id)
                                <button class="btn btn-outline-info text-start" data-bs-toggle="modal" data-bs-target="#discordPasswordResetModal" @disabled(!$canModify)>Send password reset link</button>
                            @endif
                            @role(6)
                                @if($targetUser->discord_id)
                                    <form method="POST" action="{{ route('admin.users.discord.unlink', $targetUser) }}">@csrf<button class="btn btn-outline-danger text-start w-100" type="submit" @disabled(!$canModify)>Request Discord unlink</button></form>
                                @else
                                    <button class="btn btn-outline-info text-start" data-bs-toggle="modal" data-bs-target="#discordLinkModal" @disabled(!$canModify)>Link Discord account</button>
                                @endif
                            @endrole
                        @endrole
                    </div>
                </aside>
            </div>
        </div>
    </main>
</div>
@role(6)
<div class="modal fade" id="discordLinkModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content bg-dark text-light border-secondary">
        <form method="POST" action="{{ route('admin.users.discord.link', $targetUser) }}">@csrf
            <div class="modal-header border-secondary"><h2 class="modal-title h5">Link Discord account</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body"><p class="admin-muted">The bot will DM this Discord user. Nothing is linked until they approve.</p><label class="form-label" for="adminDiscordId">Discord user ID</label><input id="adminDiscordId" name="discord_id" class="form-control bg-dark border-secondary text-light" pattern="[0-9]{17,20}" required></div>
            <div class="modal-footer border-secondary"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary" type="submit">Send approval</button></div>
        </form>
    </div></div>
</div>
@endrole
@role(4)
@if($targetUser->discord_id)
<div class="modal fade" id="discordPasswordResetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content bg-dark text-light border-secondary">
        <form method="POST" action="{{ route('admin.users.discord.password-reset', $targetUser) }}">
            @csrf
            <div class="modal-header border-secondary">
                <h2 class="modal-title h5">Send password reset link?</h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Send a one-time password reset link to <strong>{{ $targetUser->discord_username ?: 'Discord User' }} ({{ $targetUser->discord_id }})</strong>?</p>
                <p class="admin-muted mb-0">The link will be delivered by Discord DM and expires after 30 minutes. Only send this when the user has requested account-recovery assistance.</p>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Send reset link</button>
            </div>
        </form>
    </div></div>
</div>
@endif
@endrole
<div class="modal fade" id="contentDeletionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content bg-dark text-light border-danger">
        <form method="POST" action="{{ route('admin.users.content-deletion', $targetUser) }}">
            @csrf
            <div class="modal-header border-secondary"><h2 class="modal-title h5">Content Deletion</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <p>Select the content that should be replaced:</p>
                <label class="d-flex gap-3 align-items-start border border-secondary rounded p-3 mb-2">
                    <input class="form-check-input mt-1" type="checkbox" name="delete_username" value="1">
                    <span><strong>Username</strong><span class="d-block admin-muted">Replace with [ LunarixUser ({{ $targetUser->id }}) ]</span></span>
                </label>
                <label class="d-flex gap-3 align-items-start border border-secondary rounded p-3">
                    <input class="form-check-input mt-1" type="checkbox" name="delete_blurb" value="1">
                    <span><strong>Blurb</strong><span class="d-block admin-muted">Replace with [ Content Deleted ]</span></span>
                </label>
                <div class="alert alert-danger mb-0 mt-3">This action cannot be undone.</div>
            </div>
            <div class="modal-footer border-secondary"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button><button class="btn btn-danger" type="submit">Delete content</button></div>
        </form>
    </div></div>
</div>
<div class="modal fade" id="friendsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable"><div class="modal-content bg-dark text-light border-secondary">
        <div class="modal-header border-secondary">
            <div><h2 class="modal-title h5">{{ $targetUser->username }}’s friends</h2><div class="admin-muted small">{{ $targetFriends->count() }} {{ Str::plural('friend', $targetFriends->count()) }}</div></div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-0">
            <div class="list-group list-group-flush">
                @forelse($targetFriends as $friend)
                    <a href="{{ route('admin.users.show', $friend) }}" target="_blank" rel="noopener" class="list-group-item list-group-item-action bg-dark text-light border-secondary p-3">
                        <div class="d-flex align-items-center gap-3">
                            <img src="/Thumbs/Avatar.ashx?userId={{ $friend->id }}" alt="" width="52" height="52" class="rounded bg-dark border border-secondary">
                            <div class="flex-grow-1">
                                <div class="fw-semibold">{{ $friend->username }}</div>
                                <div class="admin-muted small">ID {{ $friend->id }} · Last active {{ $friend->last_activity ? \Carbon\Carbon::parse($friend->last_activity)->diffForHumans() : 'never' }}</div>
                            </div>
                            <span class="btn btn-sm btn-outline-light flex-shrink-0">Open <span aria-hidden="true">↗</span></span>
                        </div>
                    </a>
                @empty
                    <div class="text-center admin-muted py-5">This user has no friends.</div>
                @endforelse
            </div>
        </div>
        <div class="modal-footer border-secondary"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button></div>
    </div></div>
</div>
<div class="modal fade" id="joinedGroupsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable"><div class="modal-content bg-dark text-light border-secondary">
        <div class="modal-header border-secondary">
            <div><h2 class="modal-title h5">Groups {{ $targetUser->username }} is in</h2><div class="admin-muted small">{{ $joinedGroups->count() }} {{ Str::plural('group', $joinedGroups->count()) }}</div></div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-0">
            <div class="list-group list-group-flush">
                @forelse($joinedGroups as $group)
                    <a href="/groups/{{ $group->id }}" target="_blank" rel="noopener" class="list-group-item list-group-item-action bg-dark text-light border-secondary p-3">
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <div>
                                <div class="fw-semibold">{{ $group->name }}</div>
                                <div class="admin-muted small">Group ID {{ $group->id }} · {{ $group->member_role ?: 'Member' }}@if($group->owner_id === $targetUser->id) · Owner @endif</div>
                            </div>
                            <span class="btn btn-sm btn-outline-light flex-shrink-0">Go to <span aria-hidden="true">↗</span></span>
                        </div>
                    </a>
                @empty
                    <div class="text-center admin-muted py-5">This user is not a member of any groups.</div>
                @endforelse
            </div>
        </div>
        <div class="modal-footer border-secondary"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button></div>
    </div></div>
</div>
<div class="modal fade" id="punishmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable"><div class="modal-content bg-dark text-light border-secondary">
        <form method="POST" action="{{ route('admin.users.punishment', $targetUser) }}">
            @csrf
            <div class="modal-header border-secondary"><h2 class="modal-title h5">Punish {{ $targetUser->username }}</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="punishmentAction" class="form-label">Action</label>
                    <select id="punishmentAction" name="action" class="form-select bg-dark border-secondary text-light" required>
                        <option value="warning">Warning</option><option value="ban_1_day">Suspend for 1 day</option><option value="ban_3_days">Suspend for 3 days</option><option value="ban_7_days">Suspend for 7 days</option><option value="permanent">Permanent ban</option>
                    </select>
                </div>
                @if($reasons->isNotEmpty())
                    <div class="mb-3"><label class="form-label">Reasons</label><div class="row g-2">
                        @foreach($reasons as $reason)<div class="col-md-6"><label class="d-flex gap-2 border border-secondary rounded p-2 h-100"><input class="form-check-input" type="checkbox" name="reason_ids[]" value="{{ $reason->id }}"><span>{{ $reason->reason }}</span></label></div>@endforeach
                    </div></div>
                @endif
                <label for="modNote" class="form-label">Moderator note</label>
                <textarea id="modNote" name="mod_note" rows="4" maxlength="2000" class="form-control bg-dark border-secondary text-light" required>{{ old('mod_note') }}</textarea>
            </div>
            <div class="modal-footer border-secondary"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button><button class="btn btn-danger" type="submit">Apply punishment</button></div>
        </form>
    </div></div>
</div>
<div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content bg-dark text-light border-secondary">
        <form method="POST" action="{{ route('admin.users.message', $targetUser) }}">
            @csrf
            <div class="modal-header border-secondary"><h2 class="modal-title h5">Message {{ $targetUser->username }}</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <p class="admin-muted">This will appear under Notifications as an official message from the Lunarix Team.</p>
                <label for="messageSubject" class="form-label">Subject</label><input id="messageSubject" name="subject" value="{{ old('subject') }}" maxlength="255" class="form-control bg-dark border-secondary text-light mb-3" required>
                <label for="messageBody" class="form-label">Message</label><textarea id="messageBody" name="body" rows="7" maxlength="5000" class="form-control bg-dark border-secondary text-light" required>{{ old('body') }}</textarea>
            </div>
            <div class="modal-footer border-secondary"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary" type="submit">Send notification</button></div>
        </form>
    </div></div>
</div>
@role(4)
<div class="modal fade" id="inventoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable"><div class="modal-content bg-dark text-light border-secondary">
        <div class="modal-header border-secondary"><div><h2 class="modal-title h5">Manage catalog items</h2><div class="admin-muted small">Grant items or revoke a specific owned copy.</div></div><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.users.inventory.grant', $targetUser) }}" class="border border-secondary rounded p-3 mb-4">
                @csrf
                <label for="grantAssetId" class="form-label fw-semibold">Grant catalog item</label>
                <div class="input-group">
                    <input id="grantAssetId" name="asset_id" type="number" min="1" class="form-control bg-dark border-secondary text-light" placeholder="Asset ID" required>
                    <button class="btn btn-primary" type="submit">Grant item</button>
                </div>
            </form>

            <h3 class="h6 mb-3">Owned catalog items ({{ $inventory->count() }})</h3>
            <div class="list-group">
                @forelse($inventory as $copy)
                    <div class="list-group-item bg-dark text-light border-secondary p-3">
                        <div class="d-flex align-items-center gap-3">
                            <img src="/Thumbs/Asset.ashx?assetId={{ $copy->asset_id }}" alt="" width="52" height="52" class="rounded border border-secondary object-fit-contain">
                            <div class="flex-grow-1 min-w-0">
                                <div class="fw-semibold">{{ $copy->asset?->name ?? 'Missing asset' }}</div>
                                <div class="admin-muted small">Asset {{ $copy->asset_id }}@if($copy->serial_number !== null) · Serial #{{ $copy->serial_number }}@endif · Copy {{ $copy->id }}</div>
                                <div class="admin-muted small">Obtained {{ $copy->obtained_at?->format('M j, Y g:i A') ?? 'Unknown' }}</div>
                            </div>
                            <form method="POST" action="{{ route('admin.users.inventory.revoke', [$targetUser, $copy]) }}" onsubmit="return confirm('Revoke this specific copy from {{ addslashes($targetUser->username) }}?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Revoke</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center admin-muted border border-secondary rounded py-5">This user does not own any catalog items.</div>
                @endforelse
            </div>
        </div>
        <div class="modal-footer border-secondary"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button></div>
    </div></div>
</div>
<div class="modal fade" id="currencyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content bg-dark text-light border-secondary">
        <form method="POST" action="{{ route('admin.users.currency', $targetUser) }}">
            @csrf
            <div class="modal-header border-secondary"><h2 class="modal-title h5">Modify currency</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <p class="admin-muted">Current balance: {{ number_format($targetUser->moons) }} Bytes.</p>
                <label for="currencyOperation" class="form-label">Operation</label><select id="currencyOperation" name="operation" class="form-select bg-dark border-secondary text-light mb-3"><option value="add">Add</option><option value="subtract">Subtract</option><option value="set">Set balance</option></select>
                <label for="currencyAmount" class="form-label">Amount</label><input id="currencyAmount" type="number" min="0" max="2147483647" name="amount" class="form-control bg-dark border-secondary text-light" required>
            </div>
            <div class="modal-footer border-secondary"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary" type="submit">Update balance</button></div>
        </form>
    </div></div>
</div>

<div class="modal fade" id="membershipModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content bg-dark text-light border-secondary">
        <form method="POST" action="{{ route('admin.users.membership', $targetUser) }}">
            @csrf
            <div class="modal-header border-secondary"><h2 class="modal-title h5">Modify membership</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <label for="membership" class="form-label">Membership tier</label>
                <select id="membership" name="membership" class="form-select bg-dark border-secondary text-light">@foreach(\App\Models\User::MEMBERSHIP_NAMES as $value => $name)<option value="{{ $value }}" @selected((int) $targetUser->membership === $value)>{{ $name }}</option>@endforeach</select>
            </div>
            <div class="modal-footer border-secondary"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary" type="submit">Update membership</button></div>
        </form>
    </div></div>
</div>
@endrole
@role(5)
<div class="modal fade" id="staffRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content bg-dark text-light border-secondary">
        <form method="POST" action="{{ route('admin.users.staff-role', $targetUser) }}">
            @csrf
            <div class="modal-header border-secondary"><h2 class="modal-title h5">Assign staff rank</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <p class="admin-muted">Assign a staff rank to this user.</p>
                <label for="staffRoleset" class="form-label">Rank</label>
                <select id="staffRoleset" name="roleset" class="form-select bg-dark border-secondary text-light">
                    @foreach(\App\Models\User::ROLESET_NAMES as $value => $name)
                        @if($value < (int) auth()->user()->roleset)
                            <option value="{{ $value }}" @selected((int) $targetUser->roleset === $value)>{{ $name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="modal-footer border-secondary"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button><button class="btn btn-warning" type="submit">Update rank</button></div>
        </form>
    </div></div>
</div>
@endrole
@endsection
