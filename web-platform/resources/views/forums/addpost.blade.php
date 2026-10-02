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
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td id="ctl00_cphLunarix_CenterColumn" width="95%" class="CenterColumn">
                <br>
                <span id="ctl00_cphLunarix_PostView1">
<table cellPadding="0" width="100%">
  <tr>
    <td align="left">
        <div>
            <nobr>
                <a class="linkMenuSink notranslate" href="/Forum/Default.aspx">Lunarix Forum</a>
            </nobr>
            <nobr>
                <span class="normalTextSmallBold"> » </span>
                <a class="linkMenuSink notranslate" href="/Forum/ShowForumGroup.aspx?ForumGroupID={{ $forum->group->id }}">{{ $forum->group->name }}</a>
            </nobr>
            <nobr>
                <span class="normalTextSmallBold"> » </span>
                <a class="linkMenuSink notranslate" href="/Forum/ShowForum.aspx?ForumID={{ $forum->id }}">{{ $forum->name }}</a>
            </nobr>
        </div>
    </td>
    <td align="right">
        <div id="forum-nav" style="text-align: right">
            <a class="menuTextLink first" href="/Forum/Default.aspx">Home</a>
            <a class="menuTextLink" href="/Forum/Search/default.aspx">Search</a>
            <a class="menuTextLink" href="/Forum/User/MyForums.aspx">MyForums</a>
        </div>
    </td>
  </tr>
  <tr>
    <td align="left" colSpan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" colSpan="2">
        <h2 style="margin-bottom:20px">New Post</h2>
    </td>
  </tr>
  <tr>
    <td align="left" colspan="2">
    <form method="POST" action="{{ route('forums.addpost.submit', ['ForumID' => $forum->id]) }}">
        @csrf
        <label for="title" style="display: inline-block; width: 90px; vertical-align: top;">
            <span class="normalTextSmallBold">Subject (60):</span>
        </label>
        <input type="text" name="title" id="title" maxlength="60" required value="{{ old('title') }}" style="width: 700px; padding: 4px; border: 1px solid #888;"><br><br>
        <label for="content" style="display: inline-block; width: 80px; vertical-align: top;">
            <span class="normalTextSmallBold">Message (1000):</span>
        </label>
        <textarea name="content" id="content" maxlength="1000" required style="width: 700px; height: 200px; padding: 4px; border: 1px solid #888;">{{ old('content') }}</textarea><br><br>
        <div style="margin-left: 80px;">
            <label>
                <input type="checkbox" name="no_replies" value="1" {{ old('no_replies') ? 'checked' : '' }}>
                Do not allow replies to this post.
            </label>
        </div>
        <div style="margin-left: 80px; margin-top: 10px;">
            <button type="button" onclick="window.location.href='/Forum/ShowForum.aspx?ForumID={{ $forum->id }}'" style="padding: 3px 10px; margin-right: 4px;">Cancel</button>
            <button type="submit" style="padding: 3px 10px;">Post</button>
        </div>
    </form>
    </td>
  </tr>
</table>
</span>
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