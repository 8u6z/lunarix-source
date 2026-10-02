@extends('layout.root')
@push('css')
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___52c69b42777a376ab8c76204ed8e75e2_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___c7d63abcc3de510b8a7b8ab6d435f9b6_m.css">
    <link rel='stylesheet' href='/Forum/skins/default/style/default.css' />
@endpush
@section('content')
@include('layout.header')
<script type='text/javascript' src='https://cdnsrc.asp.net/ajax/4.5.1/1/WebForms.js'></script>
<script type='text/javascript'>
function WebForm_DoPostBackWithOptions(opts) {
    var keyword = document.getElementById('ctl00_cphLunarix_Search1_textToSearchFor').value.trim();
    var forum = document.getElementById('ctl00_cphLunarix_Search1_forumsToSearch').value;
    var perPage = document.querySelector('[name="ctl00$cphLunarix$Search1$ctl03"]').value;
    var find = document.querySelector('[name="ctl00$cphLunarix$Search1$ctl05"]').value;
    var match = document.querySelector('[name="ctl00$cphLunarix$Search1$ctl07"]').value;
    if (!keyword) return;
    var url = '/Forum/Search/default.aspx?q=' + encodeURIComponent(keyword);
    if (forum && forum !== '0') url += '&forumId=' + forum;
    if (perPage) url += '&perPage=' + perPage;
    url += '&find=' + find + '&match=' + match;
    window.location.href = url;
}
function __doPostBack(target, argument) {
    WebForm_DoPostBackWithOptions({ source: target });
}
</script>
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
                LunarixEventManager.triggerEvent('rbx_evt_odr', {});
                cookie.odr = 1;
            }
            if (daysSinceFirstVisit >= 1 && daysSinceFirstVisit <= 7 && typeof cookie.sdr === "undefined") {
                LunarixEventManager.triggerEvent('rbx_evt_sdr', {});
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
        LunarixEventManager.triggerEvent('rbx_evt_pageview');
        trackReturns();
        

    
        LunarixEventManager._idleInterval = 450000;
        LunarixEventManager.registerCookieStoreEvent('rbx_evt_initial_install_start');
        LunarixEventManager.registerCookieStoreEvent('rbx_evt_ftp');
        LunarixEventManager.registerCookieStoreEvent('rbx_evt_initial_install_success');
        LunarixEventManager.registerCookieStoreEvent('rbx_evt_fmp');
        LunarixEventManager.startMonitor();
        

    });

</script>



        <script type="text/javascript">Lunarix.FixedUI.gutterAdsEnabled=false;</script>

        

        <div id="Container">
            
            
        </div>

        
        @include('layout.body.alert')
        <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
        
		
<div id="AdvertisingLeaderboard" >
    

<iframe name="Lunarix_Forums_Middle_728x90" 
        allowtransparency="true"
        frameborder="0"
        height="110"
        scrolling="no"
        src="/userads/1"
        width="728"
        data-js-adtype="iframead"></iframe>

</div>     
        
        
        <div id="BodyWrapper">
            
            <div id="RepositionBody">
                <div id="Body" class='body-width'>
                    

	<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
		<tr valign="top">
			<!-- left column -->
			<td>&nbsp;&nbsp;&nbsp;</td>
			
            <!-- center column -->
			<td id="ctl00_cphLunarix_CenterColumn" width="95%" class="CenterColumn">
				<br>
				<span id="ctl00_cphLunarix_Navigationmenu1">

<div id="forum-nav" style="text-align: right">
	<a id="ctl00_cphLunarix_Navigationmenu1_ctl00_HomeMenu" class="menuTextLink first" href="/Forum/Default.aspx">Home</a>
	<a id="ctl00_cphLunarix_Navigationmenu1_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx">Search</a>
	
	
	
	@auth
	<a id="ctl00_cphLunarix_NavigationMenu2_ctl00_MyForumsMenu" class="menuTextLink" href="/Forum/User/MyForums.aspx">MyForums</a>
	@endauth
	
	
	
</div>
</span>
				<P>
					<span id="ctl00_cphLunarix_Search1"><table cellspacing="1" cellpadding="3" border="0" style="width:100%;">
	<tr>
		<th class="tableHeaderText" align="left" colspan="4">Search</th>
	</tr><tr id="ctl00_cphLunarix_Search1_ForumFilter">
		<td style="width:162px;"></td><td align="left" style="width:150px;white-space:nowrap;"><span class="form-label">Forums</span></td><td align="left" colspan="2" style="white-space:nowrap;"><select name="ctl00$cphLunarix$Search1$forumsToSearch" id="ctl00_cphLunarix_Search1_forumsToSearch" style="width:306px;">
			<option value="0">All Forums</option>
                        @foreach(\App\Models\Forums\Forum::orderBy('id')->get() as $forum)
                               <option value="{{ $forum->id }}" {{ (string)($forumId ?? 0) === (string)$forum->id ? 'selected' : '' }}>{{ $forum->name }}</option>
                        @endforeach
		</select></td>
	</tr><tr id="ctl00_cphLunarix_Search1_ResultsPerPage">
		<td></td><td align="left" style="white-space:nowrap;"><span class="form-label">Results Per Page</span></td><td align="left" colspan="2" style="white-space:nowrap;"><select name="ctl00$cphLunarix$Search1$ctl03" style="width:306px;">
                @foreach([10, 25, 50] as $n)
                      <option value="{{ $n }}" {{ ($perPage ?? 25) == $n ? 'selected' : '' }}>{{ $n }} Results</option>
                @endforeach
		</select></td>
	</tr><tr id="ctl00_cphLunarix_Search1_PostsOrAuthors">
		<td></td><td align="left" style="white-space:nowrap;"><span class="form-label">Find</span></td><td align="left" colspan="2" style="white-space:nowrap;"><select name="ctl00$cphLunarix$Search1$ctl05" style="width:306px;">
			<option {{ ($find ?? 0) == 0 ? 'selected' : '' }} value="0">Posts</option>
			<option {{ ($find ?? 0) == 1 ? 'selected' : '' }} value="1">Posted By</option>

		</select></td>
	</tr><tr id="ctl00_cphLunarix_Search1_MatchType">
		<td></td><td align="left" style="white-space:nowrap;"><span class="form-label">Match</span></td><td align="left" colspan="2" style="white-space:nowrap;"><select name="ctl00$cphLunarix$Search1$ctl07" style="width:306px;">
			<option {{ ($match ?? 0) == 0 ? 'selected' : '' }} value="0">All Words</option>
			<option {{ ($match ?? 0) == 1 ? 'selected' : '' }} value="1">Any Words</option>
			<option {{ ($match ?? 0) == 2 ? 'selected' : '' }} value="2">Exact Phrase</option>

		</select></td>
	</tr><tr>
		<td></td><td align="left" style="white-space:nowrap;"><span class="form-label">Search</span></td><td align="left" colspan="2" style="white-space:nowrap;"><input name="ctl00$cphLunarix$Search1$textToSearchFor" type="text" value="{{ $query ?? '' }}" maxlength="250" size="50" id="ctl00_cphLunarix_Search1_textToSearchFor" autofocus="autofocus" style="width:300px;" /></td>
	</tr><tr>
		<td></td><td align="left" style="white-space:nowrap;"></td><td align="left" style="width:245px;white-space:nowrap;"><span class="normalTextSmall"><input id="ctl00_cphLunarix_Search1_ctl10" type="checkbox" name="ctl00$cphLunarix$Search1$ctl10" /><label for="ctl00_cphLunarix_Search1_ctl10">Hide Advanced Options</label></span></td><td align="left" style="white-space:nowrap;"><input type="submit" name="ctl00$cphLunarix$Search1$Search" value="Search" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphLunarix$Search1$Search&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, false))" id="ctl00_cphLunarix_Search1_Search" class="btn-control btn-control-medium" /></td>
	</tr>
</table><div id="ctl00_cphLunarix_Search1_panelSearchResults">
                                @if($results !== null)
                                <p></p>
                                <table cellspacing="1" cellpadding="3" border="0" style="width:100%;">
                                    <tr>
                                        <td>
                                            <table cellspacing="0" cellpadding="5" rules="all" border="0" id="ctl00_cphLunarix_Search1_searchResultsDataGrid" style="border-color:#CCCCCC;border-width:0px;width:100%;border-collapse:collapse;">
                                                <tr class="searchPager" align="right">
                                                    <td>
                                                        @if($results->onFirstPage()) <span>Prev</span> @else <a href="{{ $results->previousPageUrl() }}">Prev</a> @endif
                                                        &nbsp;
                                                        @if($results->hasMorePages()) <a href="{{ $results->nextPageUrl() }}">Next</a> @else <span>Next</span> @endif
                                                    </td>
                                                </tr>
                                                @forelse($results as $post)
                                                <tr class="forum-table-row">
                                                    <td>
                                                        <a href="/Forum/ShowPost.aspx?PostID={{ $post->thread_id }}">
                                                            <a class="normalTextSmallBold" href="/Forum/ShowPost.aspx?PostID={{ $post->thread_id }}">
                                                                <h3 class="search-post-title">{{ $post->thread->subject }}</h3>
                                                            </a>
                                                            <span class="normalTextSmaller"> ({{ $post->thread->posts_count ?? 0 }} Replies)</span><br>
                                                            <a class="forumTitle" href="/Forum/ShowForum.aspx?ForumID={{ $post->thread->forum_id }}">{{ $post->thread->forum->name ?? '' }}</a>
                                                            <span class="normalTextSmall"> - Posted by </span>
                                                            <a class="normalTextSmall" href="/users/{{ $post->author_id }}/profile">{{ $post->author->username ?? 'Unknown' }}</a>
                                                            <span class="normalTextSmall"> on {{ $post->created_at->format('n/j/Y g:i A') }}</span><br>
                                                            <span class="normalTextSmaller search-post-body">{{ Str::limit(strip_tags($post->content), 200) }}</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr class="forum-table-row">
                                                    <td><span class="normalTextSmall">No results found for <strong>{{ $query }}</strong>.</span></td>
                                                </tr>
                                                @endforelse
                                                <tr class="searchPager" align="right">
                                                    <td>
                                                        @if($results->onFirstPage()) <span>Prev</span> @else <a href="{{ $results->previousPageUrl() }}">Prev</a> @endif
                                                        &nbsp;
                                                        @if($results->hasMorePages()) <a href="{{ $results->nextPageUrl() }}">Next</a> @else <span>Next</span> @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                @endif
                            </div>
                        </span>
                        </P>
                    </td>

			<td>&nbsp;&nbsp;&nbsp;</td>

			<!-- right margin -->
			<td id="ctl00_cphLunarix_RightColumn" nowrap="nowrap" width="160" class="RightColumn">
			    <div id="SkyScraper1" style="height:620px;margin-top:52px;">

<iframe name="Lunarix_Forums_Right_160x600" 
        allowtransparency="true"
        frameborder="0"
        height="612"
        scrolling="no"
        src="/userads/2"
        width="160"
        data-js-adtype="iframead"></iframe>
</div>
			</td>

            <td>&nbsp;&nbsp;&nbsp;</td>
		</tr>
	</table>


                    <div style="clear:both"></div>
                </div>
            </div>
        </div> 
@include('layout.footerlegacy')
@endsection