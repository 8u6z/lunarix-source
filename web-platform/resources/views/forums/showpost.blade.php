@extends('layout.root')
@push('css')
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___52c69b42777a376ab8c76204ed8e75e2_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___c7d63abcc3de510b8a7b8ab6d435f9b6_m.css">
    <link rel='stylesheet' href='/Forum/skins/default/style/default.css' />
@endpush
@section('content')
@include('layout.header')
        <div id="navContent" class="nav-content logged-out"><div class="nav-content-inner">
    <div id="MasterContainer" >
        <div id="Container">
        </div>
        @include('layout.body.alert')
        <noscript><div class="alert-info"><h5>Please enable Javascript to use all the features on this site.</h5></div></noscript>
        <div class="alert-container">
        </div>
    <div id="AdvertisingLeaderboard">
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
            <td>&nbsp;&nbsp;&nbsp;</td>

            <!-- center column -->
            <td id="ctl00_cphLunarix_CenterColumn" width="95%" class="CenterColumn">
                <br>
                <span id="ctl00_cphLunarix_PostView1">

<table cellPadding="0" width="100%">
  <tr>
    <td align="left">
        <span id="ctl00_cphLunarix_PostView1_ctl00_Whereami1" NAME="Whereami1">
<div>
    <nobr>
        <a id="ctl00_cphLunarix_PostView1_ctl00_Whereami1_ctl00_LinkHome" class="linkMenuSink notranslate" href="/Forum/Default.aspx">Lunarix Forum</a>
    </nobr>
    <nobr>
        <span id="ctl00_cphLunarix_PostView1_ctl00_Whereami1_ctl00_ForumGroupSeparator" class="normalTextSmallBold"> » </span>
        <a id="ctl00_cphLunarix_PostView1_ctl00_Whereami1_ctl00_LinkForumGroup" class="linkMenuSink notranslate" href="/Forum/ShowForumGroup.aspx?ForumGroupID={{ $thread->forum->group->id }}">{{ $thread->forum->group->name }}</a>
    </nobr>
    <nobr>
        <span id="ctl00_cphLunarix_PostView1_ctl00_Whereami1_ctl00_ForumSeparator" class="normalTextSmallBold"> » </span>
        <a id="ctl00_cphLunarix_PostView1_ctl00_Whereami1_ctl00_LinkForum" class="linkMenuSink notranslate" href="/Forum/ShowForum.aspx?ForumID={{ $thread->forum_id }}">{{ $thread->forum->name ?? '' }}</a>
    </nobr>
</div></span>
    </td>
    <td align="right">
        <span id="ctl00_cphLunarix_PostView1_ctl00_Navigationmenu1">

<div id="forum-nav" style="text-align: right">
	<a id="ctl00_cphLunarix_PostView1_ctl00_Navigationmenu1_ctl00_HomeMenu" class="menuTextLink first" href="/Forum/Default.aspx">Home</a>
	<a id="ctl00_cphLunarix_PostView1_ctl00_Navigationmenu1_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx">Search</a>
	@auth
	<a id="ctl00_cphLunarix_NavigationMenu2_ctl00_MyForumsMenu" class="menuTextLink" href="/Forum/User/MyForums.aspx">MyForums</a>
	@endauth
</div>
</span>
    </td>
  </tr>
  <tr>
    <td align="left" colSpan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" colSpan="2">
        <h2 id="ctl00_cphLunarix_PostView1_ctl00_PostTitle" CssClass="notranslate" style="margin-bottom:20px">{{ $thread->subject }}</h2>
    </td>
  </tr>
  <tr>
    <td vAlign="middle" align="left">
	    <span class="normalTextSmallBold"></span>
    </td>
  </tr>
  <tr>
    <td colSpan="2">
        <table id="ctl00_cphLunarix_PostView1_ctl00_PostList" class="tableBorder" cellspacing="1" cellpadding="0" border="0" style="width:100%;">
	<tr>
		<td class="forumHeaderBackgroundAlternate" colspan="2" style="height:20px;"><table class="forum-table-header" cellspacing="0" cellpadding="0" border="0" style="width:100%;border-collapse:collapse;">
			<tr>
				<td align="left" style="width:50%;"></td><td class="tableHeaderText table-header-right-align" align="right"><a id="ctl00_cphLunarix_PostView1_ctl00_PostList_ctl00_PreviousThread" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphLunarix$PostView1$ctl00$PostList$ctl00$PreviousThread','')">Previous Thread</a>&nbsp;<span class="normalTextSmallBold">::</span>&nbsp;<a id="ctl00_cphLunarix_PostView1_ctl00_PostList_ctl00_NextThread" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphLunarix$PostView1$ctl00$PostList$ctl00$NextThread','')">Next Thread</a>&nbsp;</td>
			</tr>
		</table></td>
	</tr>
    @foreach ($posts as $post)
    @php
        $author = $post->author;
        $online = $author ? ($presenceByAuthor->get($author->id) !== \App\Models\Presence::OFFLINE) : false;
        $totalPosts = $author ? ($postCounts->get($author->id) ?? 0) : 0;
    @endphp
	<tr class="forum-post">
		<td class="forum-content-background" valign="top" style="width:150px;white-space:nowrap;"><table border="0">
			<tr>
				<td><img src="/Forum/skins/default/images/user_Is{{ $online ? 'Online' : 'Offline' }}.gif" alt="{{ $author->username ?? 'Guest' }} is {{ $online ? '' : 'not ' }}online." style="border-width:0px;" />&nbsp;<a class="normalTextSmallBold notranslate" href="/users/{{ $author->id ?? '0' }}/profile">{{ $author->username ?? 'Guest' }}</a><br></td>
			</tr><tr>
				<td><a href="/users/{{ $author->id ?? '0' }}/profile" style="width:100px;height:100px;position:relative;"><img src="/Thumbs/Avatar.ashx?x=100&amp;y=100&amp;Format=Png&amp;userId={{ $author->id ?? '0' }}" style="border-width:0px;width:100px;height:100px;" />{{-- <img src="/Thumbs/BCOverlay.ashx?userId={{ $author->id ?? '0' }}" style="border-width:0px;position:absolute;left:0px;bottom:0px;" /> --}}</a></td>
			</tr><tr>
				<td><span class="normalTextSmaller"><b>Joined:</b> {{ $author?->created_at?->format('d M Y') ?? 'N/A' }}</span></td>
			</tr><tr>
				<td><span class="normalTextSmaller"><b>Total Posts: </b>{{ number_format($totalPosts) }}</span></td>
			</tr><tr>
				<td style="height:20px;"><span class="normalTextSmaller primaryGroupInfo notranslate" username="{{ $author->username ?? '' }}" style="display:none;"></span></td>
			</tr>
		</table></td><td class="forum-content-background" valign="top"><table cellspacing="0" cellpadding="3" border="0" style="width:100%;border-collapse:collapse;table-layout:fixed;overflow:hidden;word-wrap:break-word;">
			<tr>
				<td colspan="2"><span class="normalTextSmaller">{{ $post->created_at->format('d M Y h:i A') }}<a name="{{ $post->id }}"></a></span></td>
			</tr><tr>
				<td valign="top" colspan="2" style="height:125px;"><span class="normalTextSmall notranslate linkify">{!! nl2br(e($post->content)) !!}</span></td>
			</tr><tr>
				<td colspan="2"><span class="normalTextSmaller notranslate"></span></td>
			</tr><tr>
				<td style="height:2px;"></td>
			</tr><tr>
				<td align="left" style="height:29px;"></td><td align="right"><span class="post-response-options"><span class="ReportAbuse"><span class="AbuseButton"><a href="/AbuseReport/ForumPost.aspx?PostID={{ $post->id }}&amp;RedirectUrl={{ urlencode(request()->fullUrl()) }}">Report Abuse</a></span></span></span></td>
			</tr>
		</table></td>
	</tr><tr>
		<td class="flatViewSpacing" colspan="2" style="height:1px;"></td>
	</tr>
	@endforeach
	<tr>
		<td colspan="2" style="height:20px;"><table class="forum-table-header" cellspacing="0" cellpadding="0" border="0" style="width:100%;border-collapse:collapse;">
			<tr>
				<td align="left" style="width:50%;"></td><td class="tableHeaderText table-header-right-align" align="right"><a id="ctl00_cphLunarix_PostView1_ctl00_PostList_ctl49_PreviousThread" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphLunarix$PostView1$ctl00$PostList$ctl49$PreviousThread','')">Previous Thread</a>&nbsp;<span class="normalTextSmallBold">::</span>&nbsp;<a id="ctl00_cphLunarix_PostView1_ctl00_PostList_ctl49_NextThread" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphLunarix$PostView1$ctl00$PostList$ctl49$NextThread','')">Next Thread</a>&nbsp;</td>
			</tr>
		</table></td>
	</tr>
</table>
        <span id="ctl00_cphLunarix_PostView1_ctl00_Pager"><table cellspacing="0" cellpadding="0" border="0" style="width:100%;border-collapse:collapse;">
    <tr>
        <td><span class="normalTextSmallBold">Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</span></td>
        <td align="right">{{ $posts->onEachSide(2)->links() }}</td>
    </tr>
</table></span>
    </td>
  </tr>
  @auth
  @if (!$thread->is_locked)
  <tr>
    <td colSpan="2"><div style="text-align: center; margin: 5px 0;">
<a href="/Forum/NewReply.aspx?PostID={{ $thread->id }}" class="btn-control btn-control-medium verified-email-act" id="ctl00_cphRoblox_PostReply1_ctl00_NewPostReply">Add a Reply</a>
</div></td>
  </tr>
  @endif
  @endauth
  <tr>
    <td colSpan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="middle" colSpan="2">
    </td>
  </tr>
  <tr>
    <td colSpan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" colSpan="2">
      <span id="ctl00_cphLunarix_PostView1_ctl00_Whereami2" NAME="Whereami2">
<div>
    <nobr>
        <a id="ctl00_cphLunarix_PostView1_ctl00_Whereami2_ctl00_LinkHome" class="linkMenuSink notranslate" href="/Forum/Default.aspx">Lunarix Forum</a>
    </nobr>
    <nobr>
        <span id="ctl00_cphLunarix_PostView1_ctl00_Whereami2_ctl00_ForumGroupSeparator" class="normalTextSmallBold"> » </span>
        <a id="ctl00_cphLunarix_PostView1_ctl00_Whereami2_ctl00_LinkForumGroup" class="linkMenuSink notranslate" href="/Forum/ShowForumGroup.aspx?ForumGroupID={{ $thread->forum->group->id }}">{{ $thread->forum->group->name }}</a>
    </nobr>
    <nobr>
        <span id="ctl00_cphLunarix_PostView1_ctl00_Whereami2_ctl00_ForumSeparator" class="normalTextSmallBold"> » </span>
        <a id="ctl00_cphLunarix_PostView1_ctl00_Whereami2_ctl00_LinkForum" class="linkMenuSink notranslate" href="/Forum/ShowForum.aspx?ForumID={{ $thread->forum_id }}">{{ $thread->forum->name ?? '' }}</a>
    </nobr>
</div></span>
    </td>
  </tr>
</table>
</span>
            </td>

            <td>&nbsp;&nbsp;&nbsp;</td>

            <!-- right column -->
            <td id="ctl00_cphLunarix_RightColumn" nowrap="nowrap" width="160" class="RightColumn">
                <div style="height: 138px;">&nbsp;</div>
                <div class="lunarix-skyscraper" style="height: 620px; margin-top: 10px;">
<iframe name="Lunarix_Forums_Right_160x600"
        allowtransparency="true"
        frameborder="0"
        height="612"
        scrolling="no"
        src="/userads/2"
        width="160"
        data-js-adtype="iframead"
        data-ad-slot="Lunarix_Forums_Right_160x600"></iframe>
                </div>
            </td>

            <td>&nbsp;&nbsp;&nbsp;</td>
        </tr>
    </table>

    <script type="text/javascript">
        var users = [];
        var groupPagePath = 'https://www.lunarix.lol/Groups/Group.aspx';

        $(".primaryGroupInfo").each(function (index, element) {
            var name = $(element).attr("username");
            if ($.inArray(name, users) == -1)
                users.push(name);
        });

        $.ajax({
            url: "/Groups/GetPrimaryGroupInfo.ashx",
            data: { "users": users.toString() },
            method: "GET",
            crossDomain: true,
            xhrFields: {
                withCredentials: true
            }
        }).done(function (data) {
            if (data != null) {
                for (var i = 0; i < users.length; i++) {
                    var username = users[i];
                    var groupInfo = data[username];
                    if (groupInfo != null) {
                        $("span[username='" + username + "']").each(function (i, e) {
                            var groupLink = $("<a href='" + groupPagePath + "?gid=" + groupInfo.GroupId + "' title='" + groupInfo.GroupName + "'>" + fitStringToWidthSafe(groupInfo.GroupName, 120) + "</a>");
                            $(e).append(groupLink);
                            $(e).show();
                        });
                    }
                }
            }
        });
    </script>

    <script type="text/javascript">
        $(window).load(function () {
            var skyscraper = $(".lunarix-skyscraper").first();
            var numAds = Math.min($("#Body").height() / skyscraper.height(), 10);
            var adSlot = "/1015347/Lunarix_Forums_Right_160x600";
            var adFormat = "skyscraper";
            for (var i = 2; i < numAds; i++) {
                $.ajax({
                    url: "/advertising/javascript-ad",
                    type: "GET",
                    crossDomain: true,
                    xhrFields: {
                        withCredentials: true
                    },
                    data: {
                        AdSlot: adSlot,
                        AdFormat: adFormat
                    },
                    datatype: "html",
                    success: function (html) {
                        $("#ctl00_cphLunarix_RightColumn").append($(html));
                        Lunarix.AdsHelper.DynamicAdCreator.populateNewAds();
                    }
                });
            }
	    });
    </script>

                    <div style="clear:both"></div>
                </div>
            </div>
        </div>
@include('layout.footerlegacy')
@endsection