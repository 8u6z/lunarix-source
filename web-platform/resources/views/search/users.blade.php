@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___23e1cfc4f7f34bdc2ff4f3c2d637a122_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___f386236eb92fc39e7cfca335daa6762d_m.css">
@endpush
@push('js')
<script type='text/javascript' src='https://js.lunarix.lol/5b6134e2b8991b4d1c09d0ebd98cbe0b.js'></script>
@endpush
@section('content')
@include('layout.header')
    <div id="navContent" class="nav-content  ">
        <div class="nav-content-inner">
            <div id="MasterContainer">
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

            var cookieName = 'RBXReturn';
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

        GoogleListener.init();


    
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

                        </div>
                        @include('layout.body.alert')
                                        <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
                                                         <div id="AdvertisingLeaderboard">

    <iframe allowtransparency="true"
            frameborder="0"
            height="110"
            scrolling="no"
            src="/userads/1"
            width="728"
            data-js-adtype="iframead"></iframe>

</div>
       
                        <div id="BodyWrapper" class="">
                        <div id="RepositionBody">
                            <div id="Body" style="width:970px">
<div id="PeopleSearchContainer" class="people-search-container" data-searchpageurl="/search/users" data-dosearchurl="/search/do-search">
    <div>
        <span class="form-label">Search:</span>
        <input id="people-search-keyword" autofocus autocomplete="off" name="name" type="text" class="text-box text-box-large people-search-textbox" placeholder="Search for users..." value="{{ $keyword }}" />
        <span class="search-button-image-container">
            <a class="btn-small btn-primary" id="peoplesearch-search-button">Search Users</a>
            <img id="peoplesearch-search-loading" style="display: none" src="https://cdn.lunarix.lol/ec4e85b0c4396cf753a06fade0a8d8af.gif" />
        </span>
    </div>
    <div>
        <div id="Results" class="result-container">
            <div id="peoplesearch-results" class="peoplesearch-result-container" data-startrow="{{ $startRow }}" data-maxrows="{{ $resultsPerPage }}">
                @forelse ($users as $user)
                <div class="divider-top result-item-container" data-userpageurl="/User.aspx?ID={{ $user->id }}">
                    <div class="avatar-image-container notranslate">
                        <span class="avatar-image-link" data-3d-url="/Thumbs/Avatar.ashx?userId={{ $user->id }}">
                            <img alt="{{ $user->username }}" class="avatar-image" src="/Thumbs/Avatar.ashx?userId={{ $user->id }}" />
                        </span>
                    </div>
                    <div class="text-container text">
                        <div class="notranslate">
                            @if ($user->presenceState === \App\Models\Presence::OFFLINE)
                                <img alt="offline" src="https://cdn.lunarix.lol/3a3aa21b169be06d20de7586e56e3739.png" title="Offline" />
                            @elseif ($user->presenceState === \App\Models\Presence::IN_GAME)
                                <img alt="ingame" src="/images/online.png" title="In Game" />
                            @else
                                <img alt="online" src="/images/online.png" title="Online" />
                            @endif
                            <a href="/User.aspx?ID={{ $user->id }}">{{ $user->username }}</a>
                        </div>
                        <div class="notranslate linkify">{{ $user->description }}</div>
                    </div>
                    <div class="view-button">
                        <span>{{ $user->last_activity?->format('n/j/Y g:i A') }}</span>
                    </div>
                    <div class="clear"></div>
                </div>
                @empty
                <div>No results were found.</div>
                @endforelse
                @if ($users->isNotEmpty())
                <div class="pager-container">
                    @if ($currentPage > 1)
                    <a class="pager first" href="?keyword={{ urlencode($keyword) }}&startrow=0"></a>
                    <a class="pager previous" href="?keyword={{ urlencode($keyword) }}&startrow={{ $startRow - $resultsPerPage }}"></a>
                    @endif
                    <span class="page text">{{ $currentPage }}/{{ $totalPages }}</span>
                    @if ($currentPage < $totalPages)
                    <a class="pager next" href="?keyword={{ urlencode($keyword) }}&startrow={{ $startRow + $resultsPerPage }}"></a>
                    <a class="pager last" href="?keyword={{ urlencode($keyword) }}&startrow={{ ($totalPages - 1) * $resultsPerPage }}"></a>
                    @endif
                </div>
                @endif
            </div>
    </div>
    <div class="clear"></div>

        </div>
    </div>
    <div class="clear"></div>
</div>

<div id="ProcessingView" style="display:none">
    <div class="ProcessingModalBody">
        <p class="processing-indicator"><img src='https://cdn.lunarix.lol/ec4e85b0c4396cf753a06fade0a8d8af.gif' alt="Searching..." /></p>
    </div>
</div>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                    </div>
@include('layout.footerlegacy')
@endsection
