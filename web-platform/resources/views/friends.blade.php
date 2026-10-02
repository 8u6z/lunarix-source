@extends('layout.root')

@push('css')
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=leanbase___f9e2a82b042c4b4f945b16e30fb19e87_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___0d3aed43bf249bbe40467c99baad2280_m.css">
@endpush

@push('js')
    <script src="http://js.lunarix.lol/702296b30d708d56d479a05168ca9f4e.js.gzip"></script>
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

                                    

<script type="text/javascript">
    Lunarix.uiBootstrap = {};
    Lunarix.uiBootstrap = {
        tooltipPopupTemplateLink: "/viewapp/common/template/tooltip/tooltip-popup.html",
        tooltipHtmlUnsafePopupTemplateLink: "/viewapp/common/template/tooltip/tooltip-html-unsafe-popup.html"
    };
</script>


<div id="state-properties"
     data-userid="{{ $vieweduser->id }}"
     data-loggedinuserid="{{ $currentUser->id ?? 0 }}"
     data-removefriendurl="/api/friends/removefriend"
     data-acceptfriendurl="/api/friends/acceptfriendrequest"
     data-declinefriendurl="/api/friends/declinefriendrequest"
     data-declineallfriendsurl="/api/friends/declineallfriendrequests"
     data-followurl="/user/follow"
     data-unfollowurl="/api/user/unfollow"
     data-username="{{ $vieweduser->username ?? 'Guest' }}"></div>


<div class="row page-content" ng-modules="lunarixApp, ui.bootstrap, friends, lunarixApp.helpers" ng-cloak ng-controller="friendsController">
    <h1 ng-show="currentData.isMyProfile" class="friends-title">My Friends</h1>
    <h1 ng-hide="currentData.isMyProfile" class="friends-title">@{{ currentData.userName }}'s Friends</h1>
    <div class="lrx-tabs-horizontal">
        <ul id="horizontal-tabs" class="nav nav-tabs" role="tablist">
            <li id="friends" class="lrx-tab" ng-class="{'active': currentData.activeTab == 'friends', 'subtract-item': !currentData.isMyProfile}" ui-sref="friends">
                <a class="lrx-tab-heading">
                    <span class="lrx-lead">Friends</span>
                </a>
            </li>
            <li id="following" class="lrx-tab" ng-class="{'active': currentData.activeTab == 'following', 'subtract-item': !currentData.isMyProfile}" ui-sref="following">
                <a class="lrx-tab-heading">
                    <span class="lrx-lead">Following</span>
                </a>
            </li>
            <li id="followers" class="lrx-tab" ng-class="{'active': currentData.activeTab == 'followers', 'subtract-item': !currentData.isMyProfile}" ui-sref="followers">
                <a class="lrx-tab-heading">
                    <span class="lrx-lead">Followers</span>
                </a>
            </li>
            <li id="requests" class="lrx-tab" ng-show="currentData.isMyProfile" ng-class="{'active': currentData.activeTab == 'friend-requests', 'subtract-item': !currentData.isMyProfile}" ui-sref="friend-requests">
                <a class="lrx-tab-heading">
                    <span class="lrx-lead">Requests</span>
                </a>
            </li>
        </ul>
        <div class="friends-content" ng-class="{'hide-template': !currentData.templateVisible}">
    <div class="friends-subtitle">@{{ currentData.stateLabel }} (@{{ friendsContent.friends.data.TotalFriends | number }})</div>
    <button ng-show="currentData.activeTab == 'friend-requests' && friendsContent.friends.data.TotalFriends > 0" type="button" class="lrx-btn-control-xs ignore-button" ng-click="declineAllFriendRequests()" ng-disabled="disabled">Ignore All</button>
    <span class="lrx-tooltip" tooltip-placement="bottom" tooltip="@{{ currentData.tooltipLabel }}">
        <span class="lrx-icon-moreinfo"></span>
    </span>
    <div class="tab-content lrx-tab-content" ui-view>
        <div ng-repeat="friend in friendsContent.friends.data.Friends" class="friends-container" ng-show="friend.UserId && !currentData.ignoreAll">
            <div class="friends-card">
                <div class="friends-image">
                    <div class="icon-container" ng-hide="currentData.activeTab == 'followers' || currentData.activeTab == 'friend-requests'">
                        <a ng-href="@{{ friend.AbsoluteURL}}"> <span ng-show="friend.IsOnline && !friend.InGame && !friend.InStudio" class="lrx-icon-online" title="@{{friend.LastLocation}}"></span></a>
                        <a ng-href="@{{ friend.AbsolutePlaceURL }}"><span ng-show="friend.InGame && friend.IsOnline" class="lrx-icon-game" title="@{{friend.LastLocation}}"></span></a>
                        <span ng-show="friend.InStudio && friend.IsOnline" class="lrx-icon-studio" title="@{{friend.LastLocation}}"></span>
                    </div>
                    <a ng-href="@{{friend.AbsoluteURL}}">
                        <img ng-class="{'online': friend.IsOnline && !friend.InGame && !friend.InStudio, 'game': friend.InGame && friend.IsOnline, 'studio': friend.InStudio && friend.IsOnline}" ng-src="@{{ friend.AvatarUri }}" thumbnail='friend.Thumbnail' image-retry/>
                    </a>
                </div>
                <div id="@{{ friend.UserId }}" ng-class="{'no-buttons': !currentData.isMyProfile || currentData.activeTab == 'followers' || currentData.activeTab == 'friends'}" class="friends-name">
                    <a ng-href="@{{friend.AbsoluteURL}}" title="@{{friend.Username}}">@{{ friend.Username }}</a>
                </div>
                <div class="button-container" ng-class="{ 'friend-requests': currentData.activeTab == 'friend-requests' }" ng-show="currentData.isMyProfile && currentData.activeTab != 'friends'">
                    <button ng-show="currentData.activeTab == 'following' && friend.ItemVisible" type="button" class="lrx-btn-control-xs unfollow" ng-click="unFollow(friend.UserId, friend)">Unfollow</button>
                    <button ng-show="currentData.activeTab == 'following' && !friend.ItemVisible" type="button" class="lrx-btn-secondary-xs follow" ng-click="follow(friend.UserId, friend)">Follow</button>
                    <button ng-show="currentData.activeTab == 'friend-requests' && friend.ItemVisible" type="button" class="lrx-btn-secondary-xs accept-friend" ng-click="acceptFriendRequest(friend.UserId, friend,currentData.currentPage)">Accept</button>
                    <button ng-show="currentData.activeTab == 'friend-requests' && friend.ItemVisible" type="button" class="lrx-btn-control-xs ignore-friend" ng-click="declineFriendRequest(friend.UserId, friend,currentData.currentPage)">Ignore</button>
                </div>
                <div ng-show="currentData.activeTab == 'friend-requests' && !friend.ItemVisible" class="friends-status success">You are now friends!</div>
                <div ng-show="currentData.activeTab == 'following' && !friend.ItemVisible" class="friends-status fail">Unfollowed</div>
                <div ng-hide="currentData.activeTab == 'followers' || currentData.activeTab == 'friend-requests' || !friend.ItemVisible">
                    <div ng-class="{'no-buttons': !currentData.isMyProfile || currentData.activeTab == 'friends'}" ng-show="friend.IsOnline && !friend.InGame && !friend.InStudio" class="friends-status">Online</div>
                    <a ng-href="@{{ friend.AbsolutePlaceURL }}">
                        <div ng-class="{'no-buttons': !currentData.isMyProfile || currentData.activeTab == 'friends'}" ng-show="friend.InGame && friend.IsOnline" class="friends-status online">Game @{{ friend.LastLocation }}</div>
                    </a>
                    <div ng-class="{'no-buttons': !currentData.isMyProfile || currentData.activeTab == 'friends'}" ng-show="friend.InStudio && friend.IsOnline" class="friends-status">@{{ friend.LastLocation.substr(2) }}</div>
                    <div ng-class="{'no-buttons': !currentData.isMyProfile || currentData.activeTab == 'friends'}" ng-hide="friend.IsOnline" class="friends-status">Offline</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pager-holder">
    <ul class="pager lrx-pager" ng-show="currentData.totalPages > 1">
        <li class="lrx-pager-prev">
            <a ng-click="newPage(((currentData.currentPage /18) - 1))"><i class="lrx-icon-left"></i></a>
        </li>
        <li>
            <span>Page</span>
        </li>
        <li class="lrx-pager-cur">
            <input type="text" value="@{{(currentData.currentPage /18) +1}}" ng-model="page" ng-keyup="$event.keyCode == 13 && newPage(page-1)">
        </li>
        <li class="lrx-pager-total">
            <span class="fixed-spacing">of</span>
            <span>@{{currentData.totalPages | number }}</span>
        </li>
        <li class="lrx-pager-next">
            <a ng-click="newPage(((currentData.currentPage /18) + 1))"><i class="lrx-icon-right"></i></a>
        </li>
    </ul>
</div>
    </div>
<div>
    <script type="text/javascript">
        Lunarix.uiBootstrap = Lunarix.uiBootstrap || {};
        Lunarix.uiBootstrap.modalBackdropTemplateLink = "/viewapp/common/template/modal/backdrop.html";
        Lunarix.uiBootstrap.modalWindowTemplateLink = "/viewapp/common/template/modal/window.html";
    </script>
    <script type="text/ng-template" id="current-user-reached-friends-max.html">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" ng-click="close()">
                    <span aria-hidden="true"><span class="lrx-icon-close"></span></span><span class="sr-only">Close</span>
                </button>
                <h4>Error</h4>
            </div>
            <div class="modal-body">
                Unable to process Request.You currently have the max number of Friends allowed. 
            </div>
            <div class="modal-footer">
                    <button type="submit" id="purchaseConfirm" class="lrx-btn-control-xs" ng-click="submit()">
                        Ok
                    </button>

            </div>
                <p class="lrx-font-sm modal-footer-note">Unfriend someone before accepting any more Friend Requests.</p>
            </div><!-- /.modal-content -->
    </script>
</div><div>
    <script type="text/javascript">
        Lunarix.uiBootstrap = Lunarix.uiBootstrap || {};
        Lunarix.uiBootstrap.modalBackdropTemplateLink = "/viewapp/common/template/modal/backdrop.html";
        Lunarix.uiBootstrap.modalWindowTemplateLink = "/viewapp/common/template/modal/window.html";
    </script>
    <script type="text/ng-template" id="requester-reached-friends-max.html">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" ng-click="close()">
                    <span aria-hidden="true"><span class="lrx-icon-close"></span></span><span class="sr-only">Close</span>
                </button>
                <h4>Error</h4>
            </div>
            <div class="modal-body">
                Unable to process Request. That user currently has the max number of Friends allowed.
            </div>
            <div class="modal-footer">
                    <button type="submit" id="purchaseConfirm" class="lrx-btn-control-xs" ng-click="submit()">
                        Ok
                    </button>

            </div>
                <p class="lrx-font-sm modal-footer-note">You can not accept their Friend Request until they remove a Friend.</p>
            </div><!-- /.modal-content -->
    </script>
</div><div>
    <script type="text/javascript">
        Lunarix.uiBootstrap = Lunarix.uiBootstrap || {};
        Lunarix.uiBootstrap.modalBackdropTemplateLink = "/viewapp/common/template/modal/backdrop.html";
        Lunarix.uiBootstrap.modalWindowTemplateLink = "/viewapp/common/template/modal/window.html";
    </script>
    <script type="text/ng-template" id="something-went-wrong.html">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" ng-click="close()">
                    <span aria-hidden="true"><span class="lrx-icon-close"></span></span><span class="sr-only">Close</span>
                </button>
                <h4>Error</h4>
            </div>
            <div class="modal-body">
                Something went wrong.
            </div>
            <div class="modal-footer">
                    <button type="submit" id="purchaseConfirm" class="lrx-btn-control-xs" ng-click="submit()">
                        Ok
                    </button>

            </div>
                <p class="lrx-font-sm modal-footer-note">Please check back in few minutes.</p>
            </div><!-- /.modal-content -->
    </script>
</div>
</div>
@include('layout.footer')
@endsection
