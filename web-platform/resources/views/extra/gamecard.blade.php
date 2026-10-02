@foreach($games as $game)
@php
    $upVotes = (int) ($game->likes_count ?? 0);
    $downVotes = (int) ($game->dislikes_count ?? 0);
    $totalVotes = $upVotes + $downVotes;
    $upVotePercent = $totalVotes > 0 ? round(($upVotes / $totalVotes) * 100, 2) : 0;
@endphp
<li class="list-item card game">
    <a href="/games/{{ $game->id }}/{{ $game->getSlug() }}" class="card-item game-item">
        <span class="card-thumb-content game-thumb-content">
            <span class="card-thumb-wrapper game-thumb-wrapper"
                  >
                <img class="card-thumb game-thumb" src="/Thumbs/Asset.ashx?assetId={{ $game->id }}&square=true" alt="{{ $game->name }}"
                     width="140px" height="140px" thumbnail='{"Final":false,"Url":"/Thumbs/Asset.ashx?assetId={{ $game->id }}&square=true","RetryUrl":"/Thumbs/Asset.ashx?assetId={{ $game->id }}&square=true"}' image-retry />
            </span>
        </span>
        <span class="lrx-text-overflow lrx-game-title card-title" title="{{ $game->name }}" ng-non-bindable>
            {{ $game->name }}
        </span>
        <span class="lrx-game-text-notes lrx-font-xs card-text-notes">
            {{ number_format($game->game_players_count) }} Players Online
        </span>
        <span class="lrx-votes">
            <div class="vote-bar">
                <div class="thumbs-up">
                    <span class="lrx-icon-thumbs-up"></span>
                </div>
                <div class="voting-container"
                     data-upvotes="{{ $upVotes }}"
                     data-downvotes="{{ $downVotes }}"
                     data-voting-processed="false">
                    <div class="background {{ $totalVotes === 0 ? 'no-votes' : '' }}"></div>
                    <div class="votes" style="width: {{ $upVotePercent }}%;"></div>
                    <div class="mask">
                        <div class="segment seg-one"></div>
                        <div class="segment seg-two"></div>
                        <div class="segment seg-three"></div>
                        <div class="segment seg-four"></div>
                    </div>
                </div>
                <div class="thumbs-down">
                    <span class="lrx-icon-thumbs-down"></span>
                </div>
            </div>
            <div class="vote-counts">
                <div class="down-votes-count lrx-font-xs">{{ $downVotes }}</div>
                <div class="up-votes-count lrx-font-xs">{{ $upVotes }}</div>
            </div>
        </span>
        <span class="lrx-developer lrx-font-xs">
            by <cite class="lrx-link-sm" data-href="/users/{{ $game->creator_id }}/profile">{{ $game->creator?->username ?? 'Guest' }}</cite>
        </span>
    </a>
</li>
@endforeach
