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
        <h2 id="ctl00_cphLunarix_PostView1_ctl00_PostTitle" CssClass="notranslate" style="margin-bottom:20px">Reply to Post</h2>
    </td>
  </tr>
	<tr>
		<td class="forumHeaderBackgroundAlternate" colspan="2" style="height:20px;"><table class="forum-table-header" cellspacing="0" cellpadding="0" border="0" style="width:100%;border-collapse:collapse;">
			<tr>
				<td class="tableHeaderText" align="right"><label id="ctl00_cphLunarix_PostView1_ctl00_PostList_ctl00_PreviousThread" class="center">Original Post</label>&nbsp;</td>
			</tr>
		</table></td>
	</tr>
  <tr>
    <td colSpan="2">
        <table id="ctl00_cphLunarix_PostView1_ctl00_OriginalPost" class="tableBorder" cellspacing="1" cellpadding="0" border="0" style="width:100%;">
        @php
            $opAuthor = $thread->firstPost->author ?? null;
        @endphp
        <tr class="forum-post">
            <td class="forum-content-background" valign="top"><table cellspacing="0" cellpadding="3" border="0" style="width:100%;border-collapse:collapse;table-layout:fixed;overflow:hidden;word-wrap:break-word;">
			<tr>
				<td colspan="2"><span class="normalTextSmaller"><a href="/Forum/ShowPost.aspx?PostID={{ $thread->id }}">{{ $thread->subject }}</a></span></td>
			</tr>
			<tr>
				<td colspan="2"><span class="normalTextSmaller">Posted by <a href="/users/{{ $opAuthor->id ?? '0' }}/profile">{{ $opAuthor->username ?? 'Guest' }}</a> on {{ $thread->firstPost->created_at->format('d M Y h:i A') }}<a name="{{ $thread->firstPost->id }}"></a></span></td>
			</tr><tr>
				<td valign="top" colspan="2" style="height:125px;"><span class="normalTextSmall notranslate linkify">{!! nl2br(e($thread->firstPost->content ?? '')) !!}</span></td>
			</tr><tr>
				<td colspan="2"><span class="normalTextSmaller notranslate"></span></td>
			</tr><tr>
				<td style="height:2px;"></td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td class="forumHeaderBackgroundAlternate" colspan="2" style="height:20px;"><table class="forum-table-header" cellspacing="0" cellpadding="0" border="0" style="width:100%;border-collapse:collapse;">
			<tr>
				<td class="tableHeaderText" align="right"><label id="ctl00_cphLunarix_PostView1_ctl00_PostList_ctl00_PreviousThread" class="center">New Post</label>&nbsp;</td>
			</tr>
		</table></td>
	</tr>
        </table>

        <div style="padding: 20px 0; max-width: 800px;">
            <form method="POST" action="{{ route('forums.newreply.submit', ['PostID' => $thread->id]) }}">
                @csrf
                <label style="display: inline-block; vertical-align: top;">
                    <span class="normalTextSmallBold">Subject:</span> Re: {{ $thread->subject }}
                </label><br>
                <label for="reply_text" style="display: inline-block; width: 80px; vertical-align: top;">
                    <span class="normalTextSmallBold">Message:</span>
                </label>
                <textarea name="reply_text" id="reply_text" rows="10" cols="80" maxlength="1000" required style="width: 700px; height: 200px; padding: 4px; border: 1px solid #888;">{{ old('reply_text') }}</textarea><br>
                <div style="margin-top: 10px;">
                    <button type="button" onclick="window.location.href='{{ route('forums.showpost', ['PostID' => $thread->id]) }}'" style="padding: 3px 10px; margin-right: 4px;">Cancel</button>
                    <button type="submit" style="padding: 3px 10px;">Post</button>
                </div>
            </form>
        </div>
    </td>
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