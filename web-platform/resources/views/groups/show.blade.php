@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___23e1cfc4f7f34bdc2ff4f3c2d637a122_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___9a4182a4485f796c2e3a9036b8bbaca8_m.css">
@endpush
@push('js')
<script type='text/javascript' src='https://js.rbxcdn.com/d889f94994884abbbc63bd33700ab0f7.js.gzip'></script>
@endpush
@section('content')
@include('layout.header')
        <div id="navContent" class="nav-content"><div class="nav-content-inner">
    <div id="MasterContainer" >
        <div id="Container">
        </div>
            <div id="AdvertisingLeaderboard">
    <iframe allowtransparency="true" frameborder="0" height="110" scrolling="no" src="/userads/1" width="728" data-js-adtype="iframead"></iframe>
            </div>
        <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
        <div id="BodyWrapper">
            <div id="RepositionBody">
                <div id="Body" style=''>
    <style type="text/css">
        #Body {
            padding: 10px;
            width: 970px;
        }
    </style>
    <div class="MyLunarixContainer">
        <div id="mid-column" class="GroupsPage">
<div id="SearchControls">
    <div class="content">
        <input name="ctl00$cphLunarix$GroupSearchBar$SearchKeyword" type="text" id="ctl00_cphLunarix_GroupSearchBar_SearchKeyword" onclick="if(this.value == 'Search all groups'){ this.value = ''};$(this).removeClass('default');" class="SearchKeyword default translate" maxlength="100" value="Search all groups" />
        <input type="submit" name="ctl00$cphLunarix$GroupSearchBar$SearchButton" value="Search" onclick="javascript:if ($get(SearchKeywordText).value == '' || $get(SearchKeywordText).value == 'Search all groups') return false;" id="ctl00_cphLunarix_GroupSearchBar_SearchButton" class="group-search-button translate" />
        <input type="text" style="visibility: hidden; position: absolute">
    </div>
</div>
<script type="text/javascript">
    var SearchKeywordText = 'ctl00_cphLunarix_GroupSearchBar_SearchKeyword';
</script>

            <div id="description">
                <div class="GroupPanelContainer">
                    <div class="left-col">
                        <div class="GroupThumbnail">
                            <a title="{{ $group->name }}" style="display:inline-block;cursor:pointer;">
                                <img src="{{ $group->icon_url ?? '/images/default-group-icon.png' }}" height="150" width="150" border="0" alt="{{ $group->name }}" />
                            </a>
                        </div>
                        <div class="GroupOwner">
                            <div>
	Owned By:<br />
                                <a style="font-style: italic;" href="/users/{{ $group->owner_id }}/profile">{{ $group->owner->username }}</a>
</div>
                            <div id="MemberCount">Members: {{ number_format($group->members()->count()) }}</div>
                        </div>
                        @auth
                        <form method="POST" action="/Groups/Group.aspx?gid={{ $group->id }}" style="margin-top: 10px;" id="joinGroupForm">
                            @csrf
                            <input type="hidden" name="action" value="join">
                            <div id="ctl00_cphLunarix_JoinGroup" class="btn-neutral btn-large" @if($group->locked) style="cursor:not-allowed;opacity:0.5;" @else onclick="document.getElementById('joinGroupForm').submit();" style="cursor:pointer;" @endif>
	Join Group
</div>
                        </form>
                        @else
                        <a href="/login" class="btn-neutral btn-large" style="margin-top: 10px;">Join Group</a>
                        @endauth
                    </div>
                    <div class="right-col">
                        <h2 class="notranslate">{{ $group->name }}</h2>
                        <div id="GroupDescP" class="linkify">
                            <pre class="notranslate">{{ $group->description }}</pre>
                        </div>
                        <br />
                        @if($group->latestStatus)
                        <div id="ctl00_cphLunarix_GroupStatusPane_status">
    <div class="StatusView">
        <div class="top">
            <span class="StatusTextField linkify">{{ $group->latestStatus->status }}</span>
        </div>
        <div class="bottom">
            <div class="content">
                <a href="/users/{{ $group->latestStatus->user_id }}/profile" style="font-style: italic;">{{ $group->latestStatus->author->username }}</a>
                <span style="color: #808080; font-size: 8px">{{ $group->latestStatus->created_at->format('n/j/Y g:i:s A') }}</span>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
</div>
                        @endif
                    </div>
                    <div style="clear: both;"></div>
                </div>

                <div id="GroupsPeopleContainer">
                    <div>
                        <div id="GroupsPeople_Games" class="tab active" data-tab-target="GroupsPeoplePane_Games">Games</div>
                        <div id="GroupsPeople_Members" class="tab" data-tab-target="GroupsPeoplePane_Members">Members</div>
                        <div id="GroupsPeople_Allies" class="tab" data-tab-target="GroupsPeoplePane_Allies">Allies</div>
                        <div id="GroupsPeople_Enemies" class="tab" data-tab-target="GroupsPeoplePane_Enemies">Enemies</div>
                        <div id="GroupsPeople_Items" class="tab" data-tab-target="GroupsPeoplePane_Items">Store</div>
                        <div style="clear: both;"></div>
                    </div>
                    <div id="GroupsPeople_Pane">
                            <div id="GroupsPeoplePane_Games" class="tab-content" style="display:block;">
                                <div class="results-container" data-page="1" data-group-id="{{ $group->id }}">
                                    <div class="clear"></div>
                                </div>
                            </div>
                        <div id="GroupsPeoplePane_Members" class="tab-content" style="display: none">
<div id="GroupRoleSetsMembersPane">
    <div>
                <div class="Members_DropDown">
                    <form method="GET" action="/Groups/Group.aspx" id="roleSetForm">
                        <input type="hidden" name="gid" value="{{ $group->id }}">
                        <select name="role" class="MembersDropDownList" style="max-width: 100%" onchange="document.getElementById('roleSetForm').submit();">
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" @selected($activeRole && $activeRole->id === $role->id)>{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div>
                    <div class="spacer" style="visibility:hidden;display:block;height:69px;width:1px;float:left;"></div>
                    @if($members)
                        @foreach($members as $member)
                            <div class="GroupMember">
				                <div class="Avatar">
					                <a class="notranslate" title="{{ $member->user->username }}" href="/users/{{ $member->user_id }}/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;">
                                        <img src="/Thumbs/Avatar.ashx?userId={{ $member->user_id }}" height="100" width="100" border="0" alt="{{ $member->user->username }}" class="notranslate" />
                                    </a>
                                </div>
				                <div class="Summary">
					                <span class="Name"><a title="{{ $member->user->username }}" class="NameText notranslate" href="/users/{{ $member->user_id }}/profile">{{ $member->user->username }}</a></span>
				                </div>
                            </div>
                        @endforeach
                    @endif
                    <div style="clear:both;"></div>
                    <div class="FooterPager">
                        {{ $members?->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
</div>
                        </div>
                        <div id="GroupsPeoplePane_Allies" class="tab-content">
                            <div class="grouprelationshipscontainer">
                                <div>
                                    @foreach($allies as $ally)
                                    <div style="width:42px;height:42px;padding:8px;float:left">
                                        <a alt="{{ $ally->name }}" title="{{ $ally->name }}" href="/Groups/Group.aspx?gid={{ $ally->id }}" style="display:inline-block;height:42px;width:42px;cursor:pointer;">
                                            <img src="{{ $ally->icon_url ?? '/images/default-group-icon.png' }}" height="42" width="42" border="0" alt="{{ $ally->name }}" />
                                        </a>
                                    </div>
                                    @endforeach
                                    <div style="clear:both;margin-bottom:10px;"></div>
                                    @if($allies->isEmpty())
                                    <p style="text-align:center;color:#808080;">This group has no allies yet.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div id="GroupsPeoplePane_Enemies" class="tab-content">
                            @if($enemies->isEmpty())
                            <p style="text-align:center;color:#808080;padding:20px 0;">This group has no enemies.</p>
                            @endif
                        </div>
                        <div id="GroupsPeoplePane_Items" class="tab-content">
<div id="GroupItemPaneInstructions">
    <p>Groups have the ability to create and sell official shirts, pants, and t-shirts! All revenue goes to group funds.</p>
</div>
<div id="GroupItemContent">
    <div id="GroupItemPaneContent">
        <p>This group has no items.</p>
    </div>
</div>
                        </div>
                    </div>
                </div>

<div id="ctl00_cphLunarix_GroupWallPane_Wall">
    <div class="StandardBox" style="margin-bottom: 0px;border-bottom:none;">
        <span class="InsideBoxHeader">Wall</span>
        @if($canWallPost)
        <div id="WallPostBox">
            <form method="POST" action="/Groups/Group.aspx?gid={{ $group->id }}">
                @csrf
                <input type="hidden" name="action" value="post_wall">
                <textarea name="content" maxlength="1000" rows="2" cols="20" class="GroupWallPostText" style="width:85%;"></textarea>
                <input type="submit" value="Post" class="btn-control btn-control-large GroupWallPostBtn translate" />
            </form>
        </div>
        @endif
        <div style="clear:both;"></div>
    </div>
    <div class="StandardBox GroupWallPane" style="background:#fff;border-top:none;">
        <div id="ctl00_cphLunarix_GroupWallPane_GroupWallUpdatePanel">
            @foreach($wallPosts as $i => $post)
                        <div class="{{ $i % 2 === 0 ? 'AlternatingItemTemplateOdd' : 'AlternatingItemTemplateEven' }}">
                            <div class="RepeaterImage">
                                <a class="notranslate" title="{{ $post->author->username }}" href="/users/{{ $post->user_id }}/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;">
                                    <img src="/Thumbs/Avatar.ashx?userId={{ $post->user_id }}" height="100" width="100" border="0" alt="{{ $post->author->username }}" class="notranslate" />
                                </a>
                            </div>
                            <div class="RepeaterText">
                                <div class="GroupWall_PostContainer notranslate linkify">{{ $post->content }}</div>
                                <div>
                                    <div class="GroupWall_PostDate">
                                        <span style="color: Gray;">{{ $post->created_at->format('n/j/Y g:i:s A') }}</span>
                                        by
                                        <span class="UserLink notranslate">
                                            <a href="/users/{{ $post->user_id }}/profile">{{ $post->author->username }}</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                       </div>
            @endforeach
                <div style="clear:both;"></div>
                <div class="FooterPager">
                    {{ $wallPosts->onEachSide(1)->links() }}
                </div>
</div>
    </div>
</div>

            </div>
        </div>
        <div id="right-column">
            <div id="Div2" style="height: 600px">
    <iframe allowtransparency="true" frameborder="0" height="612" scrolling="no" src="/userads/2" width="160" data-js-adtype="iframead"></iframe>
            </div>
        </div>
        <div style="clear: both;"></div>
        <script type="text/javascript">
            if (typeof Lunarix === "undefined") { Lunarix = {}; }
            if (typeof Lunarix.Resources === "undefined") { Lunarix.Resources = {}; }
            Lunarix.Resources.more = "More";
            Lunarix.Resources.less = "Less";
            $(function () {
                $('.GroupsPeopleContainer .tab, #GroupsPeopleContainer .tab').on('click', function () {
                    var target = $(this).data('tab-target');
                    $('.tab').removeClass('active');
                    $(this).addClass('active');
                    $('.tab-content').hide();
                    $('#' + target).show();
                });
            });
        </script>
    </div>
                    <div style="clear:both"></div>
                </div>
            </div>
        </div>
@include('layout.footerlegacy')
@endsection