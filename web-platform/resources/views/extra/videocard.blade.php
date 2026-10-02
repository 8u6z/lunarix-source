@php
$thumbUrl = $video->thumbnail_path ? asset($video->thumbnail_path) : '/img/ph/placeholder.png';
$thumbFinal = $video->thumbnail_path ? 'true' : 'false';
@endphp
<li class="list-item card video">
    <a href="/videos/{{ $video->id }}/view?ctx=vp" class="card-item video-item">
        <span class="card-thumb-content video-thumb-content" style="height: 80px;">
            <span class="card-thumb-wrapper video-thumb-wrapper" style="height: 80px;">
                <img class="card-thumb video-thumb" src="{{ $video->display_thumbnail_url }}" alt="{{ $video->name }}"
                     style="width: 100%; height: 100%;" thumbnail='{"Final":{{ $video->display_thumbnail_url ? "true" : "false" }},"Url":"{{ $video->display_thumbnail_url }}","RetryUrl":"/img/ph/placeholder.png"}' image-retry />
            </span>
        </span>
        <span class="lrx-text-overflow lrx-video-title card-title" title="{{ $video->name }}" ng-non-bindable>
            {{ $video->name }}
        </span>
        <span class="lrx-video-text-notes lrx-font-xs card-text-notes">
            {{ number_format($video->views_count ?? 0) }} Views
        </span>
        <span class="lrx-votes">
            <div class="vote-bar">
                <div class="thumbs-up">
                    <span class="lrx-icon-thumbs-up"></span>
                </div>
                <div class="voting-container"
                     data-upvotes="{{ $video->upvotes ?? 0 }}"
                     data-downvotes="{{ $video->downvotes ?? 0 }}"
                     data-voting-processed="false">
                    <div class="background "></div>
                    <div class="votes"></div>
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
                <div class="down-votes-count lrx-font-xs">{{ $video->downvotes ?? 0 }}</div>
                <div class="up-votes-count lrx-font-xs">{{ $video->upvotes ?? 0 }}</div>
            </div>
        </span>
        <span class="lrx-developer lrx-font-xs">
            by <cite class="lrx-link-sm" data-href="/users/{{ $video->creator_id }}/profile">{{ $video->creator->username ?? 'Unknown' }}</cite>
        </span>
    </a>
</li>