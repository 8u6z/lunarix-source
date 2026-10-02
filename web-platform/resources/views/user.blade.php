@extends('layout.root')

@push('css')
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=leanbase___f9e2a82b042c4b4f945b16e30fb19e87_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___54be0cf62b22db12095909775a100b7e_m.css">
@endpush

@push('js')
    <script src="https://js.lunarix.lol/aa490490f6ad512989da8d22ff4063bd.js"></script>
    <script src="https://js.lunarix.lol/57c46a468b9c056eee74d8f8a645d1d5.js"></script>
@endpush

@section('content')
@include('layout.header')
    <div class="container-main    ">
      
            <script type="text/javascript">
                if (top.location != self.location) {
                    top.location = self.location.href;
                }
            </script>
        <noscript><div class="SystemAlert"><div class="lrx-alert-info" role="alert">Please enable Javascript to use all the features on this site.</div></div></noscript>
        @include('layout.body.alert')
        <div class="content  ">
                                        <div id="Leaderboard-Abp" class="abp leaderboard-abp">
                    

    <iframe allowtransparency="true"
            frameborder="0"
            height="110"
            scrolling="no"
            src="/userads/1"
            width="728"
            data-js-adtype="iframead"></iframe>

                </div>
            


<script type="text/javascript">
    var Lunarix = Lunarix || {};
</script>

<div class="profile-container" ng-modules="lunarixApp, profile, lunarixApp.helpers">

<div class="section profile-header">
    <div class="profile-avatar-image" ng-non-bindable>
        <span class="avatar-image-link" data-3d-url="/avatar-thumbnail-3d/json?userId=1"  data-js-files='https://js.lunarix.lol/1b5ff54032ecaa6588a0c5f2ad7e1a4c.js' ><img alt='{{ $userprofile->username }}' class='' src='/Thumbs/Avatar.ashx?userId={{ $userprofile->id }}' /></span>
        <x-p-profile :user="$userprofile" />
    </div>
    <div class="profile-header-content" ng-controller="profileHeaderController">


<div data-userid="{{ $currentUser->id ?? 0 }}"
     data-profileuserid="{{ $userprofile->id }}"
     data-profileusername="{{ $userprofile->username }}"
     data-friendscount="{{ $friendCount }}"
     data-followerscount="{{ $followersCount }}"
     data-followingscount="{{ $followingsCount }}"
     data-acceptfriendrequesturl="/api/friends/acceptfriendrequest"
     data-incomingfriendrequestid="{{ $incomingFriendRequestId ?? 0 }}"
     data-arefriends="{{ $isFriend ? 'true' : 'false' }}"
     data-friendurl="/friends.aspx"
     data-incomingfriendrequestpending="{{ $receivedRequest ? 'true' : 'false' }}"
     data-maysendfriendinvitation="{{ $maySendFriendInvitation ? 'true' : 'false' }}"
     data-friendrequestpending="{{ $requestPending ? 'true' : 'false' }}"
     data-sendfriendrequesturl="/api/friends/sendfriendrequest"
     data-removefriendrequesturl="/api/friends/removefriend"
     data-mayfollow="{{ $currentUser && $currentUser->id !== $userprofile->id ? 'true' : 'false' }}"
     data-isfollowing="{{ $isFollowing ? 'true' : 'false' }}"
     data-followurl="/user/follow"
     data-unfollowurl="/api/user/unfollow"
     data-canmessage="{{ $currentUser && $currentUser->id !== $userprofile->id ? 'true' : 'false' }}"
     data-messageurl="/messages/compose?recipientId={{ $userprofile->id }}"
     data-canbefollowed="{{ ($currentUser && $currentUser->id !== $userprofile->id) || \App\Models\Games\GamePlayer::where('user_id', $userprofile->id)->exists() ? 'true' : 'false' }}"
     data-canpartywithuser="{{ $currentUser && $currentUser->id !== $userprofile->id ? 'true' : 'false' }}"
     data-canchatwithuser="{{ $currentUser && $currentUser->id !== $userprofile->id ? 'true' : 'false' }}"
     data-cantrade="{{ $currentUser && $currentUser->id !== $userprofile->id ? 'true' : 'false' }}"
     data-isblockbuttonvisible="{{ $currentUser && $currentUser->id !== $userprofile->id ? 'true' : 'false' }}"
     data-getfollowscript=""
     data-ismorebtnvisible="{{ $currentUser && $currentUser->id !== $userprofile->id ? 'true' : 'false' }}"
     data-isvieweeblocked="{{ $currentUser && $currentUser->id !== $userprofile->id ? 'true' : 'false' }}"
     data-mayimpersonate=false
     data-impersonateurl=""
     profile-header-data
     profile-header-layout="profileHeaderLayout"
     class="hidden"></div>
        <div class="header-title">
            <h1>{{ $userprofile->username }}</h1>
                <span class="{{ $userprofile->membership_icon }}"></span>
        </div>
        <div class="header-userstatus">
            <span ng-non-bindable>
            @if($userprofile->blurb)
            "{{ $userprofile->blurb }}"
            @endif
            </span>
        </div>
        <div class="header-details">
            <ul class="details-info">
                <li>
                    <div>Friends</div>
                    <div class="lrx-lead">
                        <a class="lrx-link" href="/users/{{ $userprofile->id }}/friends" ng-cloak>@{{profileHeaderLayout.friendsCount | number }}</a>
                    </div>
                </li>
                <li>
                    <div>Followers</div>
                    <div class="lrx-lead">
                        <a class="lrx-link" href="/users/{{ $userprofile->id }}/friends" ng-cloak>@{{profileHeaderLayout.followersCount | number }}</a>
                    </div>
                </li>
                <li>
                    <div>Following</div>
                    <div class="lrx-lead">
                        <a class="lrx-link" href="/users/{{ $userprofile->id }}/friends" ng-cloak>@{{profileHeaderLayout.followingsCount | number }}</a>
                    </div>
                </li>
            </ul>
            <ul class="details-actions">
            @if(!$currentUser || $currentUser->id !== $userprofile->id)
                     <li class="btn-friends" ng-if="!profileHeaderLayout.areFriends" ng-cloak>
                         <button ng-if="profileHeaderLayout.incomingFriendRequestPending"
                                 ng-cloak
                                 class="lrx-btn-control-sm"
                                 data-target-url="/api/friends/acceptfriendrequest"
                                 data-friend-request-id="0"
                                 data-target-user-id="{{ $userprofile->id }}"
                                 data-friends-url="/friends.aspx"
                                 ng-click="acceptFriendRequest()">
                             Accept Friend Request
                         </button>
                         <button ng-if="!profileHeaderLayout.incomingFriendRequestPending
                                        && profileHeaderLayout.maySendFriendInvitation"
                                 ng-cloak
                                 class="lrx-btn-control-sm"
                                 ng-click="sendFriendRequest()">
                             Send Friend Request
                         </button>
                         <button ng-if="!profileHeaderLayout.incomingFriendRequestPending
                                    && !profileHeaderLayout.maySendFriendInvitation
                                    && profileHeaderLayout.friendRequestPending"
                                 ng-cloak
                                 class="lrx-btn-control-sm disabled">
                             Friend Request Pending
                         </button>
                         <button ng-if="!profileHeaderLayout.incomingFriendRequestPending
                                    && !profileHeaderLayout.maySendFriendInvitation
                                    && !profileHeaderLayout.friendRequestPending"
                                 ng-cloak
                                 class="lrx-btn-control-sm disabled">
                             Send Friend Request
                         </button>

                     </li>
                    <li class="btn-friends" ng-if="profileHeaderLayout.areFriends" ng-cloak>
                        <button class="lrx-btn-control-sm"
                                data-target-url="/api/friends/removefriend"
                                data-target-user-id="{{ $userprofile->id }}"
                                ng-mouseenter="hover = true"
                                ng-mouseleave="hover =false"
                                ng-class="{'btn-unfollow': hover}"
                                ng-click="removeFriend()">
                            Unfriend
                        </button>
                    </li>
                <li class="btn-messages">
                    <button class="lrx-btn-control-sm"
                            ng-disabled="!profileHeaderLayout.canMessage || profileHeaderLayout.userId == 0"
                            ng-click="sendMessage()"
                            ng-cloak>
                        Message
                    </button>
                </li>
                <li class="btn-follow" ng-if="profileHeaderLayout.mayFollow" ng-cloak>
                    <button class="lrx-btn-control-sm"
                            ng-click="unFollow()"
                            ng-cloak
                            ng-if="profileHeaderLayout.isFollowing"
                            ng-mouseenter="hover = true"
                            ng-mouseleave="hover =false"
                            ng-class="{'btn-unfollow': hover}">
                        <span ng-show="!hover">Following</span>
                        <span ng-show="hover">Unfollow</span>
                    </button>

                    <button class="lrx-btn-control-sm"
                            ng-click="follow()"
                            ng-cloak
                            ng-if="!profileHeaderLayout.isFollowing">
                        Follow
                    </button>
                </li>
            </ul>
            @endif
        </div><!--header-details-->
        <p ng-show="profileHeaderLayout.hasError" ng-cloak class="lrx-font-sm lrx-text-danger header-details-error">@{{profileHeaderLayout.errorMsg}}</p>
        <div id="profile-header-more" class="profile-header-more" ng-show="profileHeaderLayout.isMoreBtnVisible"
             ng-cloak>
            <a id="popover-link" class="lrx-menu-item" data-toggle="popover" data-bind="profile-header-popover-content">
                <span class="lrx-icon-more"></span>
            </a>
            <div id="popover-content" class="lrx-popover-content" data-toggle="profile-header-popover-content">
                <ul class="lrx-dropdown-menu" role="menu">
                    <li ng-show="profileHeaderLayout.canBeFollowed" ng-cloak><a id="profile-join-game">Join Game</a></li>
                    <li ng-show="profileHeaderLayout.canPartyWithUser" ng-cloak><a ng-click="inviteToParty()" id="profile-invite-to-party">Invite To Party</a></li>
                    <li ng-show="profileHeaderLayout.canChatWithUser" ng-cloak><a ng-click="startChatting()" id="profile-start-chatting">Start Chatting</a></li>
                    <li ng-show="profileHeaderLayout.canTrade" ng-cloak><a ng-click="tradeItems()" id="profile-trade-items">Trade Items</a></li>
                    <li ng-show="profileHeaderLayout.isBlockButtonVisible" ng-cloak>
                        <a ng-bind="!profileHeaderLayout.isVieweeBlocked ? 'Block User' : 'Unblock User'"
                           ng-click="blockUser()"
                           id="profile-block-user"
                           ng-cloak></a>
                    </li>
                </ul>
            </div>
            <script type="text/javascript">
                $(function() {
                    $("#profile-header-more").on("click touchstart", "#profile-join-game", function() {
                        // NOTE: global var set due to legacy game launch code.
                        play_placeId = 255985604;
                        
                    });
                });
            </script>
<div>
    <script type="text/javascript">
        Lunarix.uiBootstrap = {};
        Lunarix.uiBootstrap = {
            modalBackdropTemplateLink: "/viewapp/common/template/modal/backdrop.html",
            modalWindowTemplateLink: "/viewapp/common/template/modal/window.html"
        };
    </script>
    <script type="text/ng-template" id="ProfileBlockUserModel.html">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" ng-click="close()">
                    <span aria-hidden="true"><span class="lrx-icon-close"></span></span><span class="sr-only">Close</span>
                </button>
                <h4>Warning</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to unblock this user?
            </div>
            <div class="modal-footer">
                    <button type="submit" id="purchaseConfirm" class="lrx-btn-control-xs" ng-click="submit()">
                        Unblock
                    </button>

                    <button type="button" class="lrx-btn-secondary-xs" ng-click="close()">
                        Cancel
                    </button>
            </div>
            </div><!-- /.modal-content -->
    </script>
</div>
<div>
    <script type="text/javascript">
        Lunarix.uiBootstrap = {};
        Lunarix.uiBootstrap = {
            modalBackdropTemplateLink: "/viewapp/common/template/modal/backdrop.html",
            modalWindowTemplateLink: "/viewapp/common/template/modal/window.html"
        };
    </script>
    <script type="text/ng-template" id="ProfileUnblockUserModel.html">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" ng-click="close()">
                    <span aria-hidden="true"><span class="lrx-icon-close"></span></span><span class="sr-only">Close</span>
                </button>
                <h4>Warning</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to block this user?
            </div>
            <div class="modal-footer">
                    <button type="submit" id="purchaseConfirm" class="lrx-btn-control-xs" ng-click="submit()">
                        Block
                    </button>

                    <button type="button" class="lrx-btn-secondary-xs" ng-click="close()">
                        Cancel
                    </button>
            </div>
                <p class="lrx-font-sm modal-footer-note">When you&#39;ve blocked a user, neither of you can directly contact the other.</p>
            </div><!-- /.modal-content -->
    </script>
</div>
        </div>
    </div><!--profile-header-content-->
</div><!-- profile-header -->
    <div class="lrx-tabs-horizontal">
        <ul id="horizontal-tabs" class="nav nav-tabs" role="tablist">
            <li class="lrx-tab active">
                <a class="lrx-tab-heading" href="#about" id="tab-about">
                    <span class="lrx-lead">About</span>
                    <span class="lrx-tab-subtitle"></span>
                </a>
            </li>
            <li class="lrx-tab">
                <a class="lrx-tab-heading" href="#creations" id="tab-creations">
                    <span class="lrx-lead">Creations</span>
                    <span class="lrx-tab-subtitle"></span>
                </a>
            </li>
        </ul>
        <div class="tab-content lrx-tab-content">
            <div class="tab-pane active" id="about">
                
<div class="section profile-about" ng-controller="profileUtilitiesController">
    <div class="container-header">
        <h3>ABOUT</h3>
    </div>
    <div class="profile-about-content">
        <p class="lrx-para-overflow"
           ng-class="{'profile-blurb-more': !layoutContent.showMore}"
           truncate
           layout-content="layoutContent">
            <span class="profile-about-content-text" ng-non-bindable>{{ $userprofile->description ?? "Looks like " . $userprofile->username . "'s about is empty" }}</span>
        </p>
        <span class="lrx-font-bold show-more-link"
              ng-show="layoutContent.hasMoreContent"
              ng-click="toggleContent(layoutContent.showMore)"
              ng-cloak>Read @{{layoutContent.linkName}}</span>
    </div>
    <div class="lrx-font-sm profile-about-footer">
            <a href="/abusereport/UserProfile?id={{ $userprofile->id }}&amp;redirectUrl={{ urlencode('/users/'.$userprofile->id.'/profile') }}" class="abuse-report-link">
                <span class="lrx-text-danger">Report Abuse</span>
            </a>


    </div>
</div>
<div class="container-list profile-avatar">
    <h3>CURRENTLY WEARING</h3>
    <div class="col-sm-6 profile-avatar-left">


<div id="UserAvatar" class="thumbnail-holder" data-reset-enabled-every-page {{--data-3d-thumbs-enabled --}}
     data-url="/thumbnail/user-avatar?userId={{ $userprofile->id }}&amp;thumbnailFormatId=124&amp;width=300&amp;height=300" style="width:300px; height:300px;">
    <span class="thumbnail-span" data-3d-url="/avatar-thumbnail-3d/json?userId={{ $userprofile->id }}"  data-js-files='https://js.lunarix.lol/1b5ff54032ecaa6588a0c5f2ad7e1a4c.js'><img alt='{{ $userprofile->username }}' class='' src='/Thumbs/Avatar.ashx?userId={{ $userprofile->id }}' /></span>
        <img class="user-avatar-overlay-image thumbnail-overlay" src="https://cdn.lunarix.lol/57ede1145c87db28cf51e2355909ee49.png" alt="" />
    {{--<span disabled class="enable-three-dee btn-control btn-control-small"></span>--}}
</div>


    </div>
    <div class="col-sm-6 profile-avatar-right">
        <div class="profile-avatar-mask">

<div class="profile-accoutrements-container" ng-controller="profileAccoutrementsController">
<div data-numberofaccoutrements="{{ $wornAssets->count() }}"
     data-accoutrementsperpage="8"
     profile-accoutrements-data
     profile-accoutrements-layout="profileAccoutrementsLayout"
     class="hidden"></div>
    <div id="accoutrements-slider" class="profile-accoutrements-slider"
        profile-accoutrements-slider
        profile-accoutrements-layout="profileAccoutrementsLayout">
                    <ul class="accoutrement-items-container">
                @foreach ($wornAssets as $asset)
                <li class="accoutrement-item" ng-non-bindable>
                    <a href="/{{ $asset->getSlug() }}-item?id={{ $asset->id }}">
                        <img title="{{ $asset->name }}" alt="{{ $asset->name }}" class="accoutrement-image" src="/Thumbs/Asset.ashx?assetId={{ $asset->id }}" />
                    </a>
                </li>
                @endforeach
</div><!--profile-accoutrement-slider-->
    <div id="accoutrments-page" class="profile-accoutrements-page-container"
         profile-accoutrements-page
         profile-accoutrements-layout="profileAccoutrementsLayout">
        @for ($i = 0; $i < ceil($wornAssets->count() / 8); $i++)
        <span class="profile-accoutrements-page hidden" 
              ng-class="{'page-active': profileAccoutrementsLayout.currentPageNumber == {{ $i }}}" 
              ng-click="getAccoutrementsPage({{ $i }})"></span>
        <span class="profile-accoutrements-page hidden"
              ng-class="{'page-active': profileAccoutrementsLayout.currentPageNumber == {{ $i }}}"
              ng-click="getAccoutrementsPage({{ $i }})"></span>
        @endfor
    </div>
</div>
    </div>
</div>
</div>
    @if($friendCount > 0)
    <div class="section home-friends">
        <div class="container-header">
            <h3>Friends ({{ $friendCount }})</h3>
            <a  href="/users/{{ $userprofile->id }}/friends" class="lrx-btn-secondary-xs btn-more">See All</a>
            
        </div>
        

<ul class="hlist friend-list">
                @foreach($profilefriends as $profilefriend)
                <li class="list-item friend">
                    <a href="/users/{{ $profilefriend->id }}/profile" class="friend-link" title="{{ $profilefriend->username }}">
                        <span class="friend-avatar" data-3d-url="/avatar-thumbnail-3d/json?userId={{ $profilefriend->username }}"  data-js-files='http://js.lunarix.lol/1b5ff54032ecaa6588a0c5f2ad7e1a4c.js' ><img alt='{{ $profilefriend->username }}' class='' src='/Thumbs/Avatar.ashx?userId={{ $profilefriend->id }}' /></span>
                        <span class="friend-name lrx-text-overflow">{{ $profilefriend->username }}</span>
                                {{-- <span class="friend-status lrx-icon-ingame" title="Duel Arena"></span> --}}
                    </a>
                </li>
                @endforeach

</ul>

    </div>
@endif


@if ($recentCollectibles->isNotEmpty())
<div class="section profile-collections" ng-controller="profileCollectionsController">
    <div class="container-header">
        <h3>Collections</h3>
    </div>
    <ul class="hlist collections-list item-list">
        @foreach ($recentCollectibles as $collectible)
            <li class="list-item asset-item collections-item">
                <a href="/{{ $collectible->asset->getSlug() }}-item?id={{ $collectible->asset_id }}" class="collections-link" title="{{ $collectible->asset->name }}">
                    <img src="/Thumbs/Asset.ashx?assetId={{ $collectible->asset_id }}&x=110&y=110" alt="{{ $collectible->asset->name }}" thumbnail='{"Final":true,"Url":"/Thumbs/Asset.ashx?assetId={{ $collectible->asset_id }}&x=110&y=110","RetryUrl":null}' image-retry />
                    <span class="item-name lrx-text-overflow">{{ $collectible->asset->name }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endif





    
<div class="container-list">
    <h3>GROUPS</h3>
<div class="profile-slide-container">
    <div id="groups-switcher" class="lrx-switcher slide-switcher groups" switcher itemscount="switcher.groups.itemsCount" currpage="switcher.groups.currPage">
                    <ul class="slide-items-container lrx-switcher-items hlist">
                <li class="lrx-switcher-item profile-slide-item active" ng-class="{'active': switcher.groups.currPage == 0}" data-index="0">
                    <div class="col-sm-6 profile-slide-item-left">
                        <div class="slide-item-emblem-container">
                            <a href="/groups/group.aspx?gid=7">
                    <img class="group-item-image" src="/img/ph/neuro.jpg" data-src="http://t0.lrxcdn.com/62f65426264fef3291fc1674ee43f468" data-emblem-id="13757480" />


                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 profile-slide-item-right groups">
                        <div class="slide-item-info">
                            <h2 class="slide-item-name groups" ng-non-bindable>Lunarix</h2>
                            <p class="slide-item-description groups" ng-non-bindable>Official fan club!</p>
                        </div>
                        <div class="slide-item-stats">
                            <ul class="hlist">
                                <li class="list-item">
                                    <p class="slide-item-stat-title lrx-font-bold">Members</p>
                                    <p class="slide-item-members-count lrx-font-bold">?</p>
                                </li>
                                <li class="list-item">
                                    <p class="slide-item-stat-title lrx-font-bold">Rank</p>
                                    <p class="slide-item-my-rank lrx-font-bold groups" ng-non-bindable>Owner</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                    </ul>

                <a class="lrx-switcher-control left" data-switch="prev"><span class="glyphicon glyphicon-chevron-left lrx-icon-carousel-left"></span></a>
                <a class="lrx-switcher-control right" data-switch="next"><span class="glyphicon glyphicon-chevron-left lrx-icon-carousel-right"></span></a>

    </div>


    
</div>

</div>



@if($badgeCount > 0)
    <div class="section" ng-controller="profileUtilitiesController">
            <div class="container-header">
                <h3>Lunarix Badges ({{ $badgeCount }})</h3>

                <a ng-click="toggleContent(layoutContent.showMore)"
                   class="lrx-btn-secondary-xs btn-more"
                   ng-show="layoutContent.hasMoreContent"
                   ng-cloak>See @{{layoutContent.linkName}}</a>
            </div>

            <ul class="hlist badge-list" truncate layout-content="layoutContent" ng-class="{'badge-list-more': !layoutContent.showMore}">
            @include('layout.body.partials.badges')
        </ul>

</div>
@endif

    <div class="section" ng-controller="profileUtilitiesController">
            <div class="container-header">
                <h3>Player Badges (30)</h3>

                <a ng-click="toggleContent(layoutContent.showMore)"
                   class="lrx-btn-secondary-xs btn-more"
                   ng-show="layoutContent.hasMoreContent"
                   ng-cloak>See @{{layoutContent.linkName}}</a>
            </div>

            <ul class="hlist badge-list" truncate layout-content="layoutContent" ng-class="{'badge-list-more': !layoutContent.showMore}">
                <li class="list-item badge-item asset-item">
                    <a href="/Breakout-item?id=89175794" class="badge-link" title="Breakout">
                        <img src="/img/ph/neuro.jpg" alt="Breakout" thumbnail='{"Final":true,"Url":"http://t3.lrxcdn.com/e43facd5198ae1b387ff4816d3abe5a6","RetryUrl":null}' image-retry>
                        <span class="item-name lrx-text-overflow" ng-non-bindable>Badge</span>
                    </a>
                </li>
        </ul>

</div>


<div class="section profile-statistics">
    <h3>STATISTICS</h3>

    <table class="profile-table">
        <tr>
            <th>Join Date</th>
            <th>Place Visits</th>
            <th>Forum Posts</th>
            <th>KOs</th>
        </tr>
        <tr>
            <td class="lrx-lead profile-statistics-join-date">{{ \Carbon\Carbon::parse($userprofile->created_at)->format('n/j/Y') }}</td>
            <td class="lrx-lead profile-statistics-place-visits">{{ number_format($totalPlaceVisits) }}</td>
            <td class="lrx-lead profile-statistics-forum-posts">{{ number_format($forumPostCount) }}</td>
            <td class="lrx-lead profile-statistics-knockouts">{{ number_format($userprofile->knockout) }}</td>
        </tr>
    </table>
</div>

            </div>
            <div class="tab-pane" id="creations">
    @if($games->count() > 0)
    <div class="profile-game" ng-controller="profileGamesController">
        <div class="container-header">
            <h3 ng-non-bindable>Games</h3>
            <div class="container-buttons">
                <button class="profile-games-selector" title="Slideshow View" type="button" ng-click="updateDisplay(false)" ng-class="{'lrx-btn-secondary-xs': !isGrid, 'lrx-btn-control-xs': isGrid}">
                    <span class="lrx-icon-slideshow" ng-class="{'selected': !isGrid}"></span>
                </button>
                <button class="profile-games-selector" title="Grid View" type="button" ng-click="updateDisplay(true)" ng-class="{'lrx-btn-secondary-xs': isGrid, 'lrx-btn-control-xs': !isGrid}">
                    <span class="lrx-icon-grid" ng-class="{'selected': isGrid}"></span>
                </button>
            </div>
        </div>
        <div ng-show="isGrid" class="game-grid">
            <ul class="hlist game-list" style="max-height: @{{(Display *232)+(8* (Display -1))}}px">

@foreach($games as $game)
@php
    $upVotes = (int) ($game->likes_count ?? 0);
    $downVotes = (int) ($game->dislikes_count ?? 0);
    $totalVotes = $upVotes + $downVotes;
    $upVotePercent = $totalVotes > 0 ? round(($upVotes / $totalVotes) * 100, 2) : 0;
@endphp
<div class="game-container" ng-class="{'shown': 0 < visibleItems}">
<li class="list-item game">
    <a href="/games/{{ $game->id }}/{{ $game->getSlug() }}" class="game-item">
        <span class="game-thumb-content">
            <span class="game-thumb-wrapper"
                >
                <img class="game-thumb" width="140px" height="140px" src="/Thumbs/Asset.ashx?assetId={{ $game->id }}&square=true" alt="{{ $game->name }}"
                     thumbnail='{"Final":true,"Url":"/Thumbs/Asset.ashx?assetId={{ $game->id }}&square=true","RetryUrl":null}' image-retry />
            </span>
        </span>
        <span class="lrx-game-title lrx-text-overflow" title="Welcome to Lunarix Building" ng-non-bindable>
            {{ $game->name }}
        </span>
        <span class="lrx-game-text-notes lrx-font-xs">
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
                <div class="down-votes-count lrx-font-xs">{{ $upVotes }}</div>
                <div class="up-votes-count lrx-font-xs">{{ $downVotes }}</div>

            </div>
        </span>
        <span class="lrx-developer lrx-font-xs">
            by <cite class="lrx-link-sm" data-href="/User.aspx?ID={{ $game->creator_id }}">{{ $game->creator->username }}</cite>
        </span>
    </a>
</li>
</div>
@endforeach

            </ul>

            <a ng-click="loadMore()" class="btn lrx-btn-control-xs load-more-button" ng-show="12 > 6 * Display">Load More</a>
        </div>
        <div id="games-switcher" class="lrx-switcher slide-switcher games" ng-hide="isGrid" switcher itemscount="switcher.games.itemsCount" currpage="switcher.games.currPage">
                        <ul class="slide-items-container lrx-switcher-items hlist">
                    @foreach($games as $index => $game)
                    <li class="lrx-switcher-item profile-slide-item {{ $index === 0 ? 'active' : '' }}" ng-class="{'active': switcher.games.currPage == {{ $index }}}" data-index="{{ $index }}">
                        <div class="col-sm-6 profile-slide-item-left">
                            <div class="slide-item-emblem-container">
                                <a href="/games/{{ $game->id }}/{{ $game->getSlug() }}">
                            <img class="game-item-image"
                                 src="/Thumbs/Asset.ashx?assetId={{ $game->id }}"
                                 data-src="/Thumbs/Asset.ashx?assetId={{ $game->id }}"
                                 data-emblem-id="{{ $game->id }}" thumbnail='{"Final":true,"Url":"/Thumbs/Asset.ashx?assetId={{ $game->id }}&square=true","RetryUrl":null}' image-retry />

                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6 profile-slide-item-right games">
                            <div class="slide-item-info">
                                <h2 class="slide-item-name games" ng-non-bindable>{{ $game->name }}</h2>
                                <p class="slide-item-description games" ng-non-bindable>{{ $game->description }}</p>
                            </div>
                            <div class="slide-item-stats">
                                <ul class="hlist">
                                    <li class="list-item">
                                        <p class="slide-item-stat-title lrx-font-bold">Online</p>
                                        <p class="slide-item-members-count lrx-font-bold">{{ number_format($game->game_players_count) }}</p>
                                    </li>
                                    <li class="list-item">
                                        <p class="slide-item-stat-title lrx-font-bold">Visits</p>
                                        <p class="slide-item-my-rank lrx-font-bold games">{{ formatnum($game->visits) }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    @endforeach
                        </ul>

                    @if($games->count() > 1)
                    <a class="lrx-switcher-control left" data-switch="prev"><span class="glyphicon glyphicon-chevron-left lrx-icon-carousel-left"></span></a>
                    <a class="lrx-switcher-control right" data-switch="next"><span class="glyphicon glyphicon-chevron-left lrx-icon-carousel-right"></span></a>
                    @endif
        </div>
    </div>
@endif





</div>
            </div>
        </div>
    </div>
</div>
<div>
    <div class="profile-ads-container">
        <div id="ProfilePageAdDiv1" class="profile-ad">


    <iframe allowtransparency="true"
            frameborder="0"
            height="270"
            scrolling="no"
            src="/userads/3"
            width="300"
            data-js-adtype="iframead"></iframe>

        </div>
        <div id="ProfilePageAdDiv2" class="profile-ad">


    <iframe allowtransparency="true"
            frameborder="0"
            height="270"
            scrolling="no"
            src="/userads/3"
            width="300"
            data-js-adtype="iframead"></iframe>

        </div>
    </div>
</div>
@include('layout.footer')
@endsection
