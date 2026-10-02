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
    <iframe allowtransparency="true"
            frameborder="0"
            height="110"
            scrolling="no"
            src="/userads/1"
            width="728"
            data-js-adtype="iframead"></iframe>
</div>

        
        <div id="BodyWrapper">
            
            <div id="RepositionBody">
                <div id="Body" class="body-width">
                    

	<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
		<tr valign="top">
			
            <!-- left column -->
			<td class="LeftColumn">&nbsp;&nbsp;&nbsp;</td>
			
            <!-- center column -->
			<td id="ctl00_cphLunarix_CenterColumn" width="95%" class="CenterColumn">
				<br>
            	<span id="ctl00_cphLunarix_NavigationMenu2">

<div id="forum-nav" style="text-align: right">
	<a id="ctl00_cphLunarix_NavigationMenu2_ctl00_HomeMenu" class="menuTextLink first" href="/Forum/Default.aspx">Home</a>
	<a id="ctl00_cphLunarix_NavigationMenu2_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx">Search</a>
	
	
	
	@auth
	<a id="ctl00_cphLunarix_NavigationMenu2_ctl00_MyForumsMenu" class="menuTextLink" href="/Forum/User/MyForums.aspx">MyForums</a>
	@endauth
	
	
</div>
</span>
				<br>
				<table Cellpadding="0" Cellspacing="2" width="100%">
					<Tr>
						<td align="left">
							<span class="normalTextSmallBold">Current time: </span><span class="normalTextSmall">Aug 28, 7:11 AM</span>
						</td>
						<td align="right">
						    <span id="ctl00_cphLunarix_SearchRedirect">

<span>
    <span class="normalTextSmallBold">Search Lunarix Forums:</span>
    <input name="ctl00$cphLunarix$SearchRedirect$ctl00$SearchText" type="text" maxlength="50" id="ctl00_cphLunarix_SearchRedirect_ctl00_SearchText" class="notranslate" size="20" />
    <input type="submit" name="ctl00$cphLunarix$SearchRedirect$ctl00$SearchButton" value="Go" id="ctl00_cphLunarix_SearchRedirect_ctl00_SearchButton" class="translate btn-control btn-control-medium forum-btn-control-medium" />
</span></span>
							
						</td>
					</Tr>
				</table>
                <div style="height:7px;"></div>
@foreach ($groups as $group)
				<table cellpadding="2" cellspacing="1" border="0" width="100%" class="table"><tr class="table-header forum-table-header">
	<th class="first" colspan="2"><a id="ctl00_cphLunarix_ForumGroupRepeater1_ctl01_GroupTitle" class="forumTitle" href="/Forum/ShowForumGroup.aspx?ForumGroupID={{ $group->id }}">{{ $group->name }}</a></th><th style="width:50px;white-space:nowrap;">&nbsp;&nbsp;Threads&nbsp;&nbsp;</th><th style="width:50px;white-space:nowrap;">&nbsp;&nbsp;Posts&nbsp;&nbsp;</th><th style="width:135px;white-space:nowrap;">&nbsp;Last Post&nbsp;</th>
</tr>
@foreach ($group->forums as $forum)
@php($lastPost = $latestPosts->get($forum->id))
<tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID={{ $forum->id }}"><div class="forumTitle">
		{{ $forum->name }}
	</div><div>
		{{ $forum->description }}
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">{{ number_format($forum->threads_count) }}</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">{{ number_format($forum->posts_count) }}</span></td><td align="center">
        @if ($lastPost)
        <a class="last-post" href="/Forum/ShowPost.aspx?PostID={{ $lastPost->thread_id }}#{{ $lastPost->id }}"><span class="normalTextSmaller"><div>
		<b>{{ $lastPost->created_at->format('h:i A') }}</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">{{ $lastPost->author->username ?? 'Guest' }}</div></span></a>
        @else
        <span class="normalTextSmaller" style="display:flex;justify-content:center;">No posts yet</span>
        @endif
       </td>
</tr>
@endforeach
</table>
<div style="height:7px;"></div>
@endforeach
				<P></P>
			</td>

			<td class="CenterColumn">&nbsp;&nbsp;&nbsp;</td>
			
            <!-- right column -->
			<td id="ctl00_cphLunarix_RightColumn" nowrap="nowrap" width="160" class="RightColumn" style="padding-top:88px;">
			    

    <iframe allowtransparency="true"
            frameborder="0"
            height="612"
            scrolling="no"
            src="/userads/2"
            width="160"
            data-js-adtype="iframead"></iframe>


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