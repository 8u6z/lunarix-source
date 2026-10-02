@extends('layout.root')

@push('css')
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=leanbase___f9e2a82b042c4b4f945b16e30fb19e87_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___0513ca5a00c9bdedff82380744b7def6_m.css">
@endpush

@section('content')
@include('layout.header')
<div id="navContent" class="nav-content  nav-no-left" style="margin-left: 0px; width: 100%;">
        <div class="nav-content-inner">
            <div class="container-main    ">
            <script type="text/javascript">
                if (top.location != self.location) {
                    top.location = self.location.href;
                }
            </script>
        <noscript><div class="SystemAlert"><div class="lrx-alert-info" role="alert">Please enable Javascript to use all the features on this site.</div></div></noscript>
        @include('layout.body.alert')
        <div class="content  ">
                                 <div id="Skyscraper-Adp-Left" class="abp abp-container left-abp">
    <iframe allowtransparency="true"
            frameborder="0"
            height="612"
            scrolling="no"
            src="/userads/2"
            width="160"
            data-js-adtype="iframead"></iframe>


                </div>
                        
                        




<div id="HomeContainer" class="row home-container"
     data-facebook-share="/facebook/share-character"
     data-update-status-url="/home/updatestatus"
     data-should-show-enable-two-step-verification-call-to-action=False>


    <div class="col-xs-12 home-header">  
        <a href="/User.aspx" class="home-thumbnail-bust" >
            <img alt="avatar" src="/Thumbs/Avatar.ashx?userId={{ $currentUser->id }}" />
        </a>
        <div class="home-header-content ">
            <h1><a href="/User.aspx">Hello, {{ $currentUser->username }}!</a>
            </h1>



<span class="{{ $currentUser->membership_icon }}"></span>
        </div>
    </div>
@if ($friends->count() > 0)
<div class="col-xs-12 section home-friends">
    <div class="container-header">
        <h3>Friends ({{ $friends->count() }})</h3>
        <a href="/friends.aspx#FriendsTab" class="lrx-btn-secondary-xs btn-more">See All</a>
    </div>




<ul class="hlist friend-list">
        @foreach ($friends as $friend)
        <li class="list-item friend">
            <a href="/User.aspx?ID={{ $friend->id }}" class="friend-link" title="{{ $friend->username }}">
                <span class="friend-avatar"><img alt='{{ $friend->username }}' src='/Thumbs/Avatar.ashx?userId={{ $friend->id }}' /></span>
                <span class="friend-name lrx-text-overflow">{{ $friend->username }}</span>
                <x-p-friend :user="\App\Models\User::find($friend->id)" />
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endif



            
            


{{-- <div id="recently-visited-places" class="col-xs-12 container-list home-games">
    <div class="container-header">
        <h3>Recommended Games</h3>
        <a href="/games/" class="lrx-btn-secondary-xs btn-more">See All</a>
    </div>

    <ul class="hlist game-list">
    <li class="list-item game">
                    <a href="/games/1/hi" class="game-item">
                        <span class="game-thumb"><img class="" src="/Thumbs/Asset.ashx?assetId=hi"/></span>
                        <span class="lrx-title lrx-text-overflow">hi</span>
                        <span class="lrx-text-notes lrx-font-sm">67 Online - <b style="color: green;">2015</b></span>
                    </a>
                  </li>
    </ul>
</div> --}}




    <div class="col-xs-12 col-sm-6 home-right-col">


<div class="section">
    <div class="section-header">
        <h3>Blog News</h3>
        <a href="https://blog.lunarix.lol/" class="lrx-btn-control-xs btn-more">See More</a>
    </div>
    <ul class="blog-news">
        @forelse ($blogNews as $post)
            <li class="news">
                <span class="lrx-icon-page"></span>
                <span class="news-link">
                    <a href="{{ $post['link'] }}"
                       class="lunarix-interstitial lrx-link lrx-article-title"
                       target="_blank" rel="noopener">
                       {{ html_entity_decode($post['title']['rendered']) }}
                    </a>
                </span>
            </li>
        @empty
            <li class="news">
                <span class="news-link">No recent posts.</span>
            </li>
        @endforelse
    </ul>
</div>
@if(!$currentUser->discord_id)
                            <div id="FacebookConnectCard" class="section">
              <center>
<div style="width:75%;">
<p>Link your Lunarix account with your Discord account to let your Discord friends see what you're doing on Lunarix!</p>
</div>
<center>
<div id="connect-facebook">
    
    


<div id="SocialIdentitiesInformation" data-user-is-authenticated></div>
    <a href="/discord/redirect" class="lrx-btn-secondary-xs btn-more">Link Now!</a>
</div>
            </div>
@endif
    </div><!-- .home-right-col -->


    <div class="col-xs-12 col-sm-6 home-left-col">
        <div class="section">
            <div class="section-header">
                <h3>My Feed</h3>
            </div>
            <div class="lrx-form-horizontal" id="statusForm" role="form">
              <div class="lrx-form-group">
                <input class="form-control lrx-input-field" id="txtStatusMessage" maxlength="254" placeholder="What are you up to?" value="" />
                <p class="lrx-control-label" id="statusMessage" style="display:none;"></p>
              </div>
                 <a type="button" class="lrx-btn-primary-sm" id="shareButton">Share</a>
                 <img id="loadingImage" class="share-login" style="display: none;" alt="Sharing..." src="https://cdn.lunarix.lol/ec4e85b0c4396cf753a06fade0a8d8af.gif" height="17" width="48" />
            </div>
<ul class="vlist feeds">
{{-- <li class="list-item">
        <a href="/users/1/profile" class="list-header"><img class="header-thumb" src="https://{{ config('app.base_url_nohttp') }}/Thumbs/Avatar.ashx?userId=1" /></a>
        <div class="list-body">
            <p class="list-content">
                <a href="/users/1/profile">Lunarix</a>
        <br>
        <b>The feeds are currently in the works!</b>
                <div class="feedtext linkify">still working on em</div>
            </p>
        </div>
    </li> --}}
    @forelse ($feeds as $feed)
    <li class="list-item">
        <a href="/users/{{ $feed->uid }}/profile" class="list-header"><img class="header-thumb" src="/Thumbs/Avatar.ashx?userId={{ $feed->uid }}" /></a>
        <div class="list-body">
            <p class="list-content">
                <a href="/users/{{ $feed->uid }}/profile">{{ $feed->username }}</a>
                <div class="feedtext linkify">"{{ $feed->content }}"</div>
            </p>
            <span class="lrx-text-notes lrx-font-sm">{{ $feed->created_at->format('n/j/Y g:i A') }}</span>
            <a href="/abusereport/Feed?id={{ $feed->id }}&redirectUrl=%2Fhome">
                <span class="lrx-icon-report"></span>
            </a>
        </div>
    </li>
    @empty
    <li class="list-item feed-game">
        <a class="list-header" href="/games" aria-label="Games Page">
            <span class="icon-games"></span>
        </a>
        <div class="list-body">
            <h2>Play Games</h2>
            <p class="list-content">Nearly all Lunarix games are built by players like you.</p>
        </div>
    </li>
    <li class="list-item feed-creation">
        <a class="list-header" href="/my/character.aspx" aria-label="Avatar Page">
            <span class="icon-charactercustomizer"></span>
        </a>
        <div class="list-body">
            <h2>Customize Your Character</h2>
            <p class="list-content">Visit the <a href="/my/character.aspx"> Character page </a> to customize your character. Get new clothing in the <a href="/catalog/browse.aspx?CatalogContext=1&amp;Subcategory=1&amp;CreatorID=1&amp;CurrencyType=0&amp;pxMin=0&amp;pxMax=0&amp;SortType=4&amp;SortAggregation=3&amp;SortCurrency=0&amp;IncludeNotForSale=false&amp;LegendExpanded=true&amp;Category=1">catalog</a></p>
            <ul class="list-gallery">
                <li><img src="/images/005a0f4d764d9c609ff4c37a2bb99006.png" alt="Lunarix Avatar" style="height:65px;"></li>
                <li><img src="/images/e861c0c517df63e9f17e96685cc4bb14.png" alt="Lunarix Avatar" style="height:65px;"></li>
                <li><img src="/images/7fd0bef40b29834e8add92234b352c3e.png" alt="Lunarix Avatar" style="height:65px;"></li>
                <li><img src="/images/294ebb9ceaac3c5352de0ebecab909ec.png" alt="Lunarix Avatar" style="height:65px;"></li>
            </ul>
        </div>
    </li>
    <li class="list-item feed-creation">
        <a class="list-header" href="/develop" aria-label="Develop Page">
            <span class="icon-develop"></span>
        </a>
        <div class="list-body">
            <h2>Build Something</h2>
            <p class="list-content">Builders will enjoy playing our multiplayer building game. Professional builders will want to check out Lunarix Studio, our game development environment on your <a href="/develop">Develop page</a>.</p>
        </div>
    </li>
    <li class="list-item feed-social">
        <a class="list-header" href="/search/users" aria-label="User Search Page">
            <span class="icon-friends"></span>
        </a>
        <div class="list-body">
            <h2>Make Friends</h2>
            <p class="list-content">Meet other players in-game and send them a friend request. If you miss your opportunity you can always send a request later by <a href="/search/users">searching</a> for their user profile.</p>
        </div>
    </li>
    @endforelse
</ul>
        </div>
    </div>
</div>
{{-- rewritten completely --}}
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('shareButton').addEventListener('click', function () {
        const message = document.getElementById('txtStatusMessage').value.trim();
        const statusEl = document.getElementById('statusMessage');
        const loadingEl = document.getElementById('loadingImage');
        if (!message || message.length > 50) {
            statusEl.style.display = 'block';
            return;
        }
        loadingEl.style.display = 'inline';
        statusEl.style.display = 'none';
        document.getElementById('shareButton').style.display = 'none';
        fetch('/feedifications/post', {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
            body: JSON.stringify({ content: message }),
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                loadingEl.style.display = 'none';
                document.getElementById('shareButton').style.display = 'inline';
                statusEl.style.display = 'block';
            }
        })
        .catch(() => {
            loadingEl.style.display = 'none';
            document.getElementById('shareButton').style.display = 'inline';
            statusEl.style.display = 'block';
        });
    });
});
</script>
  <div id="Skyscraper-Adp-Right" class="abp abp-container right-abp">
                    
                    


    <iframe allowtransparency="true"
            frameborder="0"
            height="612"
            scrolling="no"
            src="/userads/2"
            width="160"
            data-js-adtype="iframead"></iframe>


                </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@include('layout.footer')
@endsection
