@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___7000c43d73500e63554d81258494fa21_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___52ecb4339a49a1b9212e1c6894fd0ca0_m.css">
@endpush
@section('content')
@include('layout.header')
    <div id="navContent" style="background-color:#fff;" class="nav-content  ">
        <div class="nav-content-inner">
            <div id="MasterContainer">
                    <script type='text/javascript' src='http://js.lunarix.lol/77026e0e8875389783edcd7224c6e72b.js.gzip'></script>
                    <script type="text/javascript">
                        if (top.location != self.location) {
                            top.location = self.location.href;
                        }
                    </script>
                

<script type="text/javascript">
    $(function(){
        function trackReturns() {
            function dayDiff(d1, d2) {
                return Math.floor((d1-d2)/86400000);
            }
            if (!localStorage) {
                return false;
            }

            var cookieName = 'LRXReturn';
            var cookieOptions = {expires:9001};
            var cookieStr = localStorage.getItem(cookieName) || "";
            var cookie = {};

            try {
                cookie = JSON.parse(cookieStr);
            } catch (ex) {
                // busted cookie string from old previous version of the code
            }

            try {
                if (typeof cookie.ts === "undefined" || isNaN(new Date(cookie.ts))) {
                    localStorage.setItem(cookieName, JSON.stringify({ ts: new Date().toDateString() }));
                    return false;
                }
            } catch (ex) {
                return false;
            }

            var daysSinceFirstVisit = dayDiff(new Date(), new Date(cookie.ts));
            if (daysSinceFirstVisit == 1 && typeof cookie.odr === "undefined") {
                LunarixEventManager.triggerEvent('lrx_evt_odr', {});
                cookie.odr = 1;
            }
            if (daysSinceFirstVisit >= 1 && daysSinceFirstVisit <= 7 && typeof cookie.sdr === "undefined") {
                LunarixEventManager.triggerEvent('lrx_evt_sdr', {});
                cookie.sdr = 1;
            }
            try {
                localStorage.setItem(cookieName, JSON.stringify(cookie));
            } catch (ex) {
                return false;
            }
        }

LunarixEventManager.initialize(true);
        LunarixEventManager.triggerEvent('lrx_evt_pageview');
        trackReturns();
        

    
        LunarixEventManager._idleInterval = 450000;
        LunarixEventManager.registerCookieStoreEvent('lrx_evt_initial_install_start');
        LunarixEventManager.registerCookieStoreEvent('lrx_evt_ftp');
        LunarixEventManager.registerCookieStoreEvent('lrx_evt_initial_install_success');
        LunarixEventManager.registerCookieStoreEvent('lrx_evt_fmp');
        LunarixEventManager.startMonitor();
        

    });

</script>


                <div>
@include('layout.body.alert')
                                            <div id="AdvertisingLeaderboard">


    <iframe allowtransparency="true"
            frameborder="0"
            height="110"
            scrolling="no"
            src="/userads/1"
            width="728"
            data-js-adtype="iframead"></iframe>
                        </div>
                                        <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>

                    <div id="BodyWrapper" class="">
                        <div id="RepositionBody">
                            <div id="Body" style="width:970px">
                                
    <script type="text/javascript">
        var Lunarix = Lunarix || {};
        Lunarix.messagesModel = {};
        Lunarix.messagesModel = {
            totalAnnouncements: {{ $notificationCount }},
            maxPrivateMessageLength : "9000",
            minimumAdRefreshInterval: "1000",
            lastAdRefresh: new Date()
        }
    </script>
    <div ng-modules="lunarixApp, messages">
        <div class="lunarix-messages-container" ng-controller="messagesController">
            <div lrx-tabs></div>
            <div class="tab-content-container tab-active" ui-view></div><!-- ng-controller="messagesContentController"-->
        </div>
    </div>
    <script type="text/javascript">
    var Lunarix = Lunarix || {};
    Lunarix.websiteTemplates = {
        avatarTemplate : "/viewapp/common/thumbnail.html",
        tabsTemplate : "/viewapp/common/tabs.html",
        messagesNavTemplate: "/viewapp/pages/messages/directives/messagesNav.html",
        messagesListTemplate: "/viewapp/pages/messages/directives/messagesList.html",
        messagesBodyTemplate: "/viewapp/pages/messages/directives/messagesDetail.html",
        messageTemplate: "/viewapp/pages/messages/controllers/message.html",
        notificationTemplate: "/viewapp/pages/messages/controllers/notification.html"
        };
        Lunarix.websiteLinks = {
        GetFormattedMessagesJsonLink: "/messages/api/get-messages",
        GetFormattedNotificationsJsonLink: "/notifications/api/get-notifications",
        ArchiveMessagesLink: "/messages/api/archive-messages",
        UnarchiveMessagesLink: "/messages/api/unarchive-messages",
        MarkMessagesReadLink: "/messages/api/mark-messages-read",
        MarkMessagesUnreadLink: "/messages/api/mark-messages-unread",
        SendMessageJsonResultLink: "/messages/api/send-message",
        GetMyUnreadMessagesCountLink: "/messages/api/get-my-unread-messages-count"
    };
    Lunarix.messageDefaults = {
        lunarixUserId: 1,
        lunarixUserName: "Lunarix",
        lunarixUserThumbnail: "/Thumbs/Avatar.ashx?userId=1",
        lunarixUserAbsoluteUrl: "/users/1/profile"
    };
    </script>
			<div style="clear:both"></div>
		</div>
	</div>
</div>
@include('layout.footerlegacy')
@endsection
