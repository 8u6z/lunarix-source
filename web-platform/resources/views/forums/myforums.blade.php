@extends('layout.root')
@push('css')
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___52c69b42777a376ab8c76204ed8e75e2_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___c7d63abcc3de510b8a7b8ab6d435f9b6_m.css">
    <link rel='stylesheet' href='/Forum/skins/default/style/default.css' />
@endpush
@section('content')
@include('layout.header')
        <div id="navContent" class="nav-content {{ auth()->check() ? 'logged-in' : 'logged-out' }}"><div class="nav-content-inner">
    <div id="MasterContainer" >
        

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



        <script type="text/javascript">Lunarix.FixedUI.gutterAdsEnabled=false;</script>

        

        <div id="Container">
            
            
        </div>

		
        @include('layout.body.alert')
        <noscript><div class="alert-info"><h5>Please enable Javascript to use all the features on this site.</h5></div></noscript>
        
        
        
        
        
        
<div id="AdvertisingLeaderboard" >
    

<iframe name="Lunarix_Forums_Middle_728x90" 
        allowtransparency="true"
        frameborder="0"
        height="110"
        scrolling="no"
        src="/userads/1"
        width="728"
        data-js-adtype="iframead"
        data-ad-slot="Lunarix_Forums_Middle_728x90"></iframe>

</div>

        
        <div id="BodyWrapper">
            
            <div id="RepositionBody">
                <div id="Body" class="body-width">
                    

	<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
		<tr valign="top">
			<!-- left column -->
			<td class="LeftColumn">&nbsp;&nbsp;&nbsp;</td>

			<!-- center column -->
			<td id="ctl00_cphLunarix_CenterColumn" class="CenterColumn">
				<br>
				<span id="ctl00_cphLunarix_ThreadView1">

<table cellPadding="0" width="100%">
	<tr>
		<td align="left"><span id="ctl00_cphLunarix_ThreadView1_ctl00_Whereami1" NAME="Whereami1">
<div>
    <nobr>
        <a id="ctl00_cphLunarix_ThreadView1_ctl00_Whereami1_ctl00_LinkHome" class="linkMenuSink notranslate" href="/Forum/Default.aspx">Lunarix Forum</a>
    </nobr>
</div></span></td>
        <td align="right"><span id="ctl00_cphLunarix_ThreadView1_ctl00_Navigationmenu1">

<div id="forum-nav" style="text-align: right">
	<a id="ctl00_cphLunarix_ThreadView1_ctl00_Navigationmenu1_ctl00_HomeMenu" class="menuTextLink first" href="/Forum/Default.aspx">Home</a>
	<a id="ctl00_cphLunarix_ThreadView1_ctl00_Navigationmenu1_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx">Search</a>
	
	
	
	
	@auth
	<a id="ctl00_cphLunarix_NavigationMenu2_ctl00_MyForumsMenu" class="menuTextLink" href="/Forum/User/MyForums.aspx">MyForums</a>
	@endauth
	
	
</div>
</span></td>
	</tr>
	<tr>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td vAlign="top" colSpan="2">
                    <h2>Your Last 25 Active Threads</h2>
		    <div style="height:7px"></div>
                    &nbsp;
                    @auth
		    <table id="ctl00_cphLunarix_ThreadView1_ctl00_ThreadList" class="tableBorder" cellspacing="1" cellpadding="3" border="0" style="width:100%;">
    <tr class="forum-table-header">
        <th align="left" colspan="3" style="height:25px;">&nbsp;Subject&nbsp;</th>
        <th align="left" style="white-space:nowrap;">&nbsp;Author&nbsp;</th>
        <th align="center">&nbsp;Replies&nbsp;</th>
        <th align="center">&nbsp;Views&nbsp;</th>
        <th align="center" style="white-space:nowrap;">&nbsp;Last Post&nbsp;</th>
    </tr>
    @foreach ($threads as $thread)
    @php
        $replies = max(0, $thread->posts_count - 1);
        $lastPost = $latestPosts->get($thread->id);
        $icon = $thread->is_locked ? ['locked-unread.png', 'Post allows no replies (Not Read)'] : ($replies >= 20 ? ['popular-unread.png', 'Popular post (Not Read)'] : ['thread-unread.png', 'Post (Not Read)']);
    @endphp
    <tr class="forum-table-row">
        <td align="center" valign="middle" style="width:25px;">
            <img title="{{ $icon[1] }}" src="/images/Forums/{{ $icon[0] }}" style="border-width:0px;" />
        </td>
        <td class="notranslate" style="height:25px;">
            <a class="post-list-subject" href="/Forum/ShowPost.aspx?PostID={{ $thread->id }}">
                <div class="thread-link-outer-wrapper">
                    <div class="thread-link-container notranslate">{{ $thread->subject }}</div>
                </div>
            </a>
        </td>
        <td class="notranslate" style="width:80px;width:90px;padding-right:12px;"></td>
        <td align="left" style="width:100px;">
            <a class="post-list-author notranslate" href="/users/{{ $thread->author_id }}/profile">
                <div class="thread-link-outer-wrapper">
                    <div class="normalTextSmaller thread-link-container">{{ $thread->author->username ?? 'Unknown' }}</div>
                </div>
            </a>
        </td>
        <td align="center" style="width:50px;">
            <span class="normalTextSmaller">{{ $replies > 0 ? $replies : '-' }}</span>
        </td>
        <td align="center" style="width:50px;">
            <span class="normalTextSmaller">{{ number_format($viewCounts->get($thread->id, 0)) }}</span>
        </td>
        <td align="center" style="width:100px;white-space:nowrap;">
            @if ($lastPost)
            <a class="last-post" href="/Forum/ShowPost.aspx?PostID={{ $thread->id }}#{{ $lastPost->id }}">
                <div>
                    <span class="normalTextSmaller">
                        <b>{{ $thread->is_pinned ? 'Pinned Post' : $lastPost->created_at->format('h:i A') }}</b>
                    </span>
                </div>
                <div class="normalTextSmaller notranslate">{{ $lastPost->author->username ?? 'Unknown' }}</div>
            </a>
            @endif
        </td>
    </tr>
    @endforeach
    <tr class="forum-table-footer">
        <td colspan="7">&nbsp;</td>
    </tr>
</table>
@endauth
            
            
		</td>
	</tr>
	<tr>
		<td colspan="2">
			&nbsp;
		</td>
	</tr>
	<tr>
		<td align="right">
			<span class="normalTextSmallBold">
				
			</span>
		</td>
	</tr>
	<tr>
		<td colSpan="2">&nbsp;</td>
	</tr>
</table>
</span>
			</td>

			<td class="CenterColumn">&nbsp;&nbsp;&nbsp;</td>	
            
            <!-- right column -->
            <td Width="160px" style="padding-top:88px;">
                

<iframe name="Lunarix_Forums_Right_160x600" 
        allowtransparency="true"
        frameborder="0"
        height="612"
        scrolling="no"
        src="/userads/2"
        width="160"
        data-js-adtype="iframead"
        data-ad-slot="Lunarix_Forums_Right_160x600"></iframe>

            </td>
            <td class="RightColumn">&nbsp;&nbsp;&nbsp;</td>
		</tr>
	</table>
    
    
                    <div style="clear:both"></div>
                </div>
            </div>
        </div> 
@include('layout.footerlegacy')
@endsection