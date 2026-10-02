@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___23e1cfc4f7f34bdc2ff4f3c2d637a122_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___9a4182a4485f796c2e3a9036b8bbaca8_m.css">
@endpush
@push('js')
<script type='text/javascript' src='https://js.lrxcdn.com/d889f94994884abbbc63bd33700ab0f7.js.gzip'></script>
@endpush
@section('content')
@include('layout.header')
        <div id="navContent" class="nav-content"><div class="nav-content-inner">
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
                RobloxEventManager.triggerEvent('rbx_evt_odr', {});
                cookie.odr = 1;
            }
            if (daysSinceFirstVisit >= 1 && daysSinceFirstVisit <= 7 && typeof cookie.sdr === "undefined") {
                RobloxEventManager.triggerEvent('rbx_evt_sdr', {});
                cookie.sdr = 1;
            }
            try {
                localStorage.setItem(cookieName, JSON.stringify(cookie));
            } catch (ex) {
                return false;
            }
        }

        GoogleListener.init();


    
        RobloxEventManager.initialize(true);
        RobloxEventManager.triggerEvent('rbx_evt_pageview');
        trackReturns();
        

    
        RobloxEventManager._idleInterval = 450000;
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_start');
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_ftp');
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_success');
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_fmp');
        RobloxEventManager.startMonitor();
        

    });

</script>



        <script type="text/javascript">Roblox.FixedUI.gutterAdsEnabled=false;</script>

        

        <div id="Container">
            
            
        </div>

		
            <div id="AdvertisingLeaderboard">
                

    <iframe allowtransparency="true" frameborder="0" height="110" scrolling="no" src="https://www.roblox.com/userads/1" width="728" data-js-adtype="iframead"></iframe>

            </div>
        
        
        
        <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
        
        
        
        
        <div id="BodyWrapper">
            
            <div id="RepositionBody">
                <div id="Body" style='width:970px;'>
                    
    <style type="text/css">
        #Body {
            padding: 10px;
            width: 970px;
        }
    </style>
    
            
<script type="text/javascript">
     Roblox.Clans = Roblox.Clans || {};
     //<sl:translate>
     Roblox.Clans.Resources = {
        BuyClanTitle: "Purchase Clan",
        BuyClanMessage: "Purchasing a Clan will cost <span class='robux'>{0}</span>. Do you want to continue?<p class='use-group-funds invisible'><input type='checkbox' /> Use Group funds to purchase a Clan</p>",
        BuyClanAcceptText: "Buy Now",
        BuyClanCancelText: "Cancel",
        PersonalBalanceAfterText: "Your balance after this transaction will be ",
        GroupBalanceAfterText: "Your group's balance after this transaction will be ",
        BuyClanNotEnoughMoneyText: "You need {0} more ROBUX to purchase a Clan. <a href='/upgrades/robux'>Purchase ROBUX now</a>!",
        ErrorTitle: "Error",
        SuccessTitle: "Success!",
        SuccessClanInvitationText: "Your invitation has been sent.",
        ClanInviteTitle : "Invite To {0}",
        ClanInviteMessage : "Do you want to join this Clan?",
        ClanInviteSubMessage : "You may only be in one Clan at a time. You will be removed from your current Clan.",
        ClanInviteAcceptText : "Accept",
        ClanInviteCancelText : "Decline",
        CreateInviteTitle: "Invite to Clan",
        CreateInviteText: "Invite this user to your Clan?",
        ClanKickTitle: "Kick from Clan",
        ClanKickText: "Are you sure you want to kick this user from your Clan? They will remain a member of the group.",
        ClanKickSuccessText: "Clan kick successful.",
        LeaveClanTitle: "Leave Clan",
        LeaveClanText: "Are you sure you want to leave the Clan?",
        LeaveClanSuccessText: "You are no longer in the Clan.",
        CancelInviteTitle: "Cancel Clan Invitation",
        CancelInviteText: "Are you sure you want to cancel this pending Clan invitation?",
        CancelInviteSuccessText: "The Clan invitation has been cancelled.",
        AdminJoinClanTitle: "Join Clan",
        AdminJoinClanText: "Join this Clan? <span class='already-in-clan invisible'>You will automatically leave your current Clan.</span>"
     };
 //</sl:translate>
 </script>
 


<div class="GenericModal modalPopup unifiedModal smallModal" style="display:none;">
    <div class="Title"></div>
    <div class="GenericModalBody">
        <div>
            <div class="ImageContainer">
                <img class="GenericModalImage" alt="generic image"/>
            </div>
            <div class="Message"></div>
        </div>
        <div class="clear"></div>
        <div id="GenericModalButtonContainer" class="GenericModalButtonContainer">
            <a class="ImageButton btn-neutral btn-large roblox-ok">OK</a>
        </div>
    </div>
</div>

<input name="__RequestVerificationToken" type="hidden" value="lo9mga0DWHg40g0XXGQ4MIITRPlNI5NpJNIBzdoWAr6-JqHrpzsy1vz8nR6BOxp9B9lwUwfqAZsaZo2PZjCBUVfEYNb0XnQPT8b3OvsjxCS2xNSC0" /><div id="ClanInvitationData" 
     data-is-invitation-pending="False" 
     data-group-id="977619"
     data-is-in-other-clan="False"
     data-group-name="Dunkin&#39; Donuts &#174;"></div>

            <div id="left-column">
                <div class="GroupListContainer StandardBox">
                    <div id="ctl00_cphRoblox_CreateNewGroup" disabled="disabled" title="You may only be in a maximum of 5 groups at one time">
	
                        
                        <div id="CreateGroupBtn" class="btn-large btn-disabled-primary">
                            Create
                        </div>   
                        
</div>
                    

<div id="GroupThumbnails" >
    <div id="ctl00_cphRoblox_MyGroupsPane_SmallThumbsPanel" class="CarouselPager">
	
        
                
                
                <div class="GroupListItemContainer selected">
                    <div class="GroupListImageContainer notranslate">                                                
                        <a id="ctl00_cphRoblox_MyGroupsPane_SmallGroupThumbnails_ctrl0_ctl00_AssetImage1" title="Dunkin&amp;#39; Donuts ®" href="http://www.roblox.com/My/Groups.aspx?gid=977619" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t2.rbxcdn.com/d6a307b945b22d16207c198e503761d0" height="42" width="42" border="0" alt="Dunkin&amp;#39; Donuts ®" /></a>
                    </div>
                    <div class="GroupListName notranslate">Dunkin&#39; Donuts &#174;</div>
                    <div style="clear:both;"></div>
                </div>
            
                <div class="GroupListItemContainer ">
                    <div class="GroupListImageContainer notranslate">                                                
                        <a id="ctl00_cphRoblox_MyGroupsPane_SmallGroupThumbnails_ctrl0_ctl01_AssetImage1" title="Keystone Middle School" href="http://www.roblox.com/My/Groups.aspx?gid=2649944" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t4.rbxcdn.com/f09c3e21f07cf4b5c0d76f8f6a41848e" height="42" width="42" border="0" alt="Keystone Middle School" /></a>
                    </div>
                    <div class="GroupListName notranslate">Keystone Middle School</div>
                    <div style="clear:both;"></div>
                </div>
            
                <div class="GroupListItemContainer ">
                    <div class="GroupListImageContainer notranslate">                                                
                        <a id="ctl00_cphRoblox_MyGroupsPane_SmallGroupThumbnails_ctrl0_ctl02_AssetImage1" title="KFC || Kentucky Fried Chicken®" href="http://www.roblox.com/My/Groups.aspx?gid=2515510" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t2.rbxcdn.com/f09682ce5d49c027a6b0b27787143916" height="42" width="42" border="0" alt="KFC || Kentucky Fried Chicken®" /></a>
                    </div>
                    <div class="GroupListName notranslate">KFC || Kentucky Fried Chicken&#174;</div>
                    <div style="clear:both;"></div>
                </div>
            
                <div class="GroupListItemContainer ">
                    <div class="GroupListImageContainer notranslate">                                                
                        <a id="ctl00_cphRoblox_MyGroupsPane_SmallGroupThumbnails_ctrl0_ctl03_AssetImage1" title="Shake Shack ®" href="http://www.roblox.com/My/Groups.aspx?gid=1227426" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t5.rbxcdn.com/96c15c9a503bd819411b63930a54fdb8" height="42" width="42" border="0" alt="Shake Shack ®" /></a>
                    </div>
                    <div class="GroupListName notranslate">Shake Shack &#174;</div>
                    <div style="clear:both;"></div>
                </div>
            
                <div class="GroupListItemContainer ">
                    <div class="GroupListImageContainer notranslate">                                                
                        <a id="ctl00_cphRoblox_MyGroupsPane_SmallGroupThumbnails_ctrl0_ctl04_AssetImage1" title="The Robloxian General Hospital" href="http://www.roblox.com/My/Groups.aspx?gid=2580112" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t6.rbxcdn.com/9d45cc0d38547a30473d6b69690bb95b" height="42" width="42" border="0" alt="The Robloxian General Hospital" /></a>
                    </div>
                    <div class="GroupListName notranslate">The Robloxian General Hospital</div>
                    <div style="clear:both;"></div>
                </div>
            
            
            
    
</div>
    <div style="clear:both;"></div>
</div> 

<script type="text/javascript"> 
    $(function() {
        $(".GroupListImageContainer").find('a').each(function (index, elem) { $(elem).attr('title', $(elem).attr('title').replace(new RegExp("&quot;", "gm"), '"')); });
    });
</script>
                </div>
            </div>
            <div id="mid-column">
                
<div id="SearchControls">
    
    <div class="content">
        <input name="ctl00$cphRoblox$GroupSearchBar$SearchKeyword" type="text" id="ctl00_cphRoblox_GroupSearchBar_SearchKeyword" onclick="if(this.value == &#39;Search all groups&#39;){ this.value = &#39;&#39;};$(this).removeClass(&#39;default&#39;);" class="SearchKeyword default translate" maxlength="100" value="Search all groups" />
        <!--<select name="ctl00$cphRoblox$GroupSearchBar$SearchFiltersDropdown2" id="ctl00_cphRoblox_GroupSearchBar_SearchFiltersDropdown2">

</select>-->
        <input type="submit" name="ctl00$cphRoblox$GroupSearchBar$SearchButton" value="Search" onclick="javascript:if ($get(SearchKeywordText).value == &#39;&#39; || $get(SearchKeywordText).value == &#39;Search all groups&#39;) return false;" id="ctl00_cphRoblox_GroupSearchBar_SearchButton" class="group-search-button translate" />
        <input type="text" style="visibility: hidden; position: absolute">
        <!-- Enter key submission hack - IE -->
    </div>
</div>

<script type="text/javascript">
    var SearchKeywordText = 'ctl00_cphRoblox_GroupSearchBar_SearchKeyword';       
</script>


                
                <div id="description">
                    <div class="GroupPanelContainer">
                        <div class="left-col">
                            <div class="GroupThumbnail">
                                <a id="ctl00_cphRoblox_GroupDescriptionEmblem" title="Dunkin&#39; Donuts ®" onclick="__doPostBack(&#39;ctl00$cphRoblox$GroupDescriptionEmblem&#39;,&#39;&#39;)" style="display:inline-block;cursor:pointer;"><img src="http://t5.rbxcdn.com/5dac0e99b8f37edb2bae85079515a8d4" height="150" width="150" border="0" alt="Dunkin&#39; Donuts ®" /></a>
                            </div>
                            <div class="GroupOwner">
                                
                                <div id="ctl00_cphRoblox_OwnershipPanel">
	Owned By: <a style="font-style: italic;" href="http://www.roblox.com/users/7693641/profile" onclick="">Jazzyx3</a>
</div>
                                <div id="MemberCount">Members: 46484</div>
                                <div id="ClanMemberCount">Clan Members: <span class="clan-members-count">9</span></div>

                                
                            </div>
                            <div class="MyRank">
                                <div>My Rank: <span id="ctl00_cphRoblox_StatusRank" class="notranslate">Customer</span></div>
                            </div>
                        </div>
                        <div class="right-col">
                            <h2 class="notranslate">Dunkin&#39; Donuts &#174;</h2>
                            <div id="GroupDescP" class="linkify">
                                <pre class="notranslate">Welcome to Dunkin&#39; Donuts! Roblox Runs on Dunkin&#39;!
Credit to Dunkin&#39; Donuts company.

Want a job? Go to interviews or pm the question with answers!
Please read the Handbook: http://forum.roblox.com/Forum/ShowPost.aspx?PostID=179818066

Our mission has always been to save the world from mediocre coffee. Right now most people think this is a noble yet hopelessly unachievable task. But every cup of our Mocha Italia blend created will then help us in our quest. We&#39;re going to become ROBLOXian&#39;s favorite coffee shop, and yet another step closer to a ROBLOX where bland, average coffee is consigned to history. 


Want to apply? Go to the application forum and fill it out and send it to one of our High Rank&#39;s! You also may attend interviews we have, at scheduled times!

Where can I find the uniform? The uniform is in the group store, please try and wear this at all times when in group places.

Chairman and Chairwomen are both owners of the group.

</pre>
                            </div>
                            <input type="hidden" id="GroupDesc_Full" class="notranslate" value="Welcome to Dunkin&#39; Donuts! Roblox Runs on Dunkin&#39;!
Credit to Dunkin&#39; Donuts company.

Want a job? Go to interviews or pm the question with answers!
Please read the Handbook: http://forum.roblox.com/Forum/ShowPost.aspx?PostID=179818066

Our mission has always been to save the world from mediocre coffee. Right now most people think this is a noble yet hopelessly unachievable task. But every cup of our Mocha Italia blend created will then help us in our quest. We&#39;re going to become ROBLOXian&#39;s favorite coffee shop, and yet another step closer to a ROBLOX where bland, average coffee is consigned to history. 


Want to apply? Go to the application forum and fill it out and send it to one of our High Rank&#39;s! You also may attend interviews we have, at scheduled times!

Where can I find the uniform? The uniform is in the group store, please try and wear this at all times when in group places.

Chairman and Chairwomen are both owners of the group.

" />
                            <div id="ctl00_cphRoblox_AbuseReportButton_AbuseReportPanel" class="ReportAbuse">
	
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_AbuseReportButton_ReportAbuseIconHyperLink" href="http://www.roblox.com/abusereport/group?id=977619&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx"><img src="../images/abuse.PNG?v=2" alt="Report Abuse" style="border-width:0px;" /></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_AbuseReportButton_ReportAbuseTextHyperLink" href="http://www.roblox.com/abusereport/group?id=977619&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx">Report Abuse</a></span>

</div>
                            <br />
                            <div id="ctl00_cphRoblox_GroupStatusPane_status">
    <div id="ctl00_cphRoblox_GroupStatusPane_StatusView" class="StatusView ">
        <div class="top" >
            <span id="ctl00_cphRoblox_GroupStatusPane_StatusTextField" class="StatusTextField linkify">[MSG] If you have nothing to do head down to the cafe for a Mint hot chocolate! [TOMORROW'S QOTD] Do you use shiftlock or default to move you're character? (Not meaning wasd and arrows)</span>
        </div>
        <div class="bottom">
            <div class="content">
                <a id="ctl00_cphRoblox_GroupStatusPane_StatusPoster" href="http://www.roblox.com/users/24254339/profile" style="font-style: italic;">Danfly</a>
                <span style="color: #808080; font-size: 8px"><span id="ctl00_cphRoblox_GroupStatusPane_StatusDate">12/19/2015 1:50:27 AM</span></span>
            </div>
            <div id="ctl00_cphRoblox_GroupStatusPane_AbuseReportButtonGroupStatus_AbuseReportPanel" class="ReportAbuse">
	
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_GroupStatusPane_AbuseReportButtonGroupStatus_ReportAbuseIconHyperLink" href="http://www.roblox.com/abuseReport/groupstatus?id=977619&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx"><img src="../images/abuse.PNG?v=2" alt="Report Abuse" style="border-width:0px;" /></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_GroupStatusPane_AbuseReportButtonGroupStatus_ReportAbuseTextHyperLink" href="http://www.roblox.com/abuseReport/groupstatus?id=977619&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx">Report Abuse</a></span>

</div>
            <div style="clear:both;"></div>
        </div>
    </div>
    
</div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </div>
                <div id="GroupsPeopleContainer" class="divider-bottom">
                    
                    <div>
                        
                            <div id="GroupsPeople_Games" class="tab active">Games</div>
                        
                            <div id="GroupsPeople_Clan" class="tab ">Clan</div>
                        
                        <div id="GroupsPeople_Members" class="tab ">Members</div>
                        <div id="GroupsPeople_Allies" class="tab">Allies</div>
                        <div id="GroupsPeople_Enemies" class="tab">Enemies</div>
                        <div id="GroupsPeople_Items" class="tab">Store</div>
                        
                        <div style="clear: both;"></div>
                    </div>
                    
                    <div id="GroupsPeople_Pane">
                    
                            <div id="GroupsPeoplePane_Games" class="tab-content" style="display: block">
                                
<div class="results-container" data-page="1" data-group-id="977619">
        <div class="GroupPlace">
                <div><a href="http://www.roblox.com/games/265360172/DD-Cafe-V-3"><img src="http://t5.rbxcdn.com/f90baa8a4ecabbccee1db18f88a77158" data-retry-url="" title="|-[DD]-| Cafe V.3"></a></div>
            <div class="PlaceName">
                    <a class="NameText" href="http://www.roblox.com/games/265360172/DD-Cafe-V-3">|-[DD]-| Cafe V.3</a>
            </div>
                <div class="PlayersOnline">55 players online</div>
        </div>
        <div class="GroupPlace">
                <div><a href="http://www.roblox.com/games/265359004/DD-Meeting-Center"><img src="http://t1.rbxcdn.com/6d9a5b53a2e9e650fc5fa8439ae16b6b" data-retry-url="" title="|-[DD]-| Meeting Center"></a></div>
            <div class="PlaceName">
                    <a class="NameText" href="http://www.roblox.com/games/265359004/DD-Meeting-Center">|-[DD]-| Meeting Center</a>
            </div>
                <div class="PlayersOnline">0 players online</div>
        </div>
        <div class="GroupPlace">
                <div><a href="http://www.roblox.com/games/265359487/DD-Interview-Center"><img src="http://t2.rbxcdn.com/c28e86bc7cacb8a3b2bbe3e0a64b40a7" data-retry-url="" title="|-[DD]-| Interview Center"></a></div>
            <div class="PlaceName">
                    <a class="NameText" href="http://www.roblox.com/games/265359487/DD-Interview-Center">|-[DD]-| Interview Center</a>
            </div>
                <div class="PlayersOnline">8 players online</div>
        </div>
    <div class="clear"></div>
</div>

                            </div> 
                        
                        <div id="GroupsPeoplePane_Clan" class="tab-content" style="display: none;">
                                <div class="GroupMember">
        <div class="Avatar">
            <span class="OnlineStatus offline" alt="DevMusic is offline (last seen at 12/19/2015 3:11:33 PM."></span>
            <a class="roblox-avatar-image" data-user-id="77576823" data-image-size="small" href="http://www.roblox.com/users/77576823/profile"></a>
        </div>
        <div class="Summary">
            <span class="Name">
                <a href="http://www.roblox.com/users/77576823/profile" class="NameText notranslate" title="DevMusic">DevMusic</a>
            </span>
        </div>
    </div>
    <div class="GroupMember">
        <div class="Avatar">
            <span class="OnlineStatus offline" alt="Jazzyx3 is offline (last seen at 12/19/2015 4:00:44 PM."></span>
            <a class="roblox-avatar-image" data-user-id="7693641" data-image-size="small" href="http://www.roblox.com/users/7693641/profile"></a>
        </div>
        <div class="Summary">
            <span class="Name">
                <a href="http://www.roblox.com/users/7693641/profile" class="NameText notranslate" title="Jazzyx3">Jazzyx3</a>
            </span>
        </div>
    </div>
    <div class="GroupMember">
        <div class="Avatar">
            <span class="OnlineStatus offline" alt="Restinq is offline (last seen at 12/19/2015 11:33:40 AM."></span>
            <a class="roblox-avatar-image" data-user-id="23884101" data-image-size="small" href="http://www.roblox.com/users/23884101/profile"></a>
        </div>
        <div class="Summary">
            <span class="Name">
                <a href="http://www.roblox.com/users/23884101/profile" class="NameText notranslate" title="Restinq">Restinq</a>
            </span>
        </div>
    </div>
    <div class="GroupMember">
        <div class="Avatar">
            <span class="OnlineStatus offline" alt="Fuzzness is offline (last seen at 12/19/2015 3:55:37 PM."></span>
            <a class="roblox-avatar-image" data-user-id="57498564" data-image-size="small" href="http://www.roblox.com/users/57498564/profile"></a>
        </div>
        <div class="Summary">
            <span class="Name">
                <a href="http://www.roblox.com/users/57498564/profile" class="NameText notranslate" title="Fuzzness">Fuzzness</a>
            </span>
        </div>
    </div>
    <div class="GroupMember">
        <div class="Avatar">
            <span class="OnlineStatus offline" alt="LuckyKatarina2599 is offline (last seen at 12/19/2015 2:13:14 PM."></span>
            <a class="roblox-avatar-image" data-user-id="31150261" data-image-size="small" href="http://www.roblox.com/users/31150261/profile"></a>
        </div>
        <div class="Summary">
            <span class="Name">
                <a href="http://www.roblox.com/users/31150261/profile" class="NameText notranslate" title="LuckyKatarina2599">LuckyKatarina2599</a>
            </span>
        </div>
    </div>
    <div class="GroupMember">
        <div class="Avatar">
            <span class="OnlineStatus offline" alt="httpAnita is offline (last seen at 12/19/2015 3:50:34 PM."></span>
            <a class="roblox-avatar-image" data-user-id="75715494" data-image-size="small" href="http://www.roblox.com/users/75715494/profile"></a>
        </div>
        <div class="Summary">
            <span class="Name">
                <a href="http://www.roblox.com/users/75715494/profile" class="NameText notranslate" title="httpAnita">httpAnita</a>
            </span>
        </div>
    </div>
    <div class="GroupMember">
        <div class="Avatar">
            <span class="OnlineStatus offline" alt="ali056 is offline (last seen at 12/19/2015 4:11:28 PM."></span>
            <a class="roblox-avatar-image" data-user-id="52083020" data-image-size="small" href="http://www.roblox.com/users/52083020/profile"></a>
        </div>
        <div class="Summary">
            <span class="Name">
                <a href="http://www.roblox.com/users/52083020/profile" class="NameText notranslate" title="ali056">ali056</a>
            </span>
        </div>
    </div>
    <div class="GroupMember">
        <div class="Avatar">
            <span class="OnlineStatus online" alt="Danfly is online at Website."></span>
            <a class="roblox-avatar-image" data-user-id="24254339" data-image-size="small" href="http://www.roblox.com/users/24254339/profile"></a>
        </div>
        <div class="Summary">
            <span class="Name">
                <a href="http://www.roblox.com/users/24254339/profile" class="NameText notranslate" title="Danfly">Danfly</a>
            </span>
        </div>
    </div>
    <div class="GroupMember">
        <div class="Avatar">
            <span class="OnlineStatus online" alt="ExploreTheLocal is online."></span>
            <a class="roblox-avatar-image" data-user-id="6996849" data-image-size="small" href="http://www.roblox.com/users/6996849/profile"></a>
        </div>
        <div class="Summary">
            <span class="Name">
                <a href="http://www.roblox.com/users/6996849/profile" class="NameText notranslate" title="ExploreTheLocal">ExploreTheLocal</a>
            </span>
        </div>
    </div>

<div class="clear"></div>


<input type="hidden" class="get-clan-members-data" data-results-per-page="10" data-group-id="977619"/>
                        </div>
                        
                        <div id="GroupsPeoplePane_Members" class="tab-content" style="display: none">
                            

<div id="GroupRoleSetsMembersPane" >
    <script type="text/javascript">
        Sys.WebForms.PageRequestManager.getInstance().add_endRequest(updateRolesetCount);
    </script>
    <div id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_GroupMembersUpdatePanel" Class="MembersUpdatePanel">
	
            <div>
                <div class="Members_DropDown">
                    <select name="ctl00$cphRoblox$rbxGroupRoleSetMembersPane$dlRolesetList" onchange="loading(&#39;members&#39;);setTimeout(&#39;__doPostBack(\&#39;ctl00$cphRoblox$rbxGroupRoleSetMembersPane$dlRolesetList\&#39;,\&#39;\&#39;)&#39;, 0)" id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlRolesetList" class="MembersDropDownList" style="max-width: 100%">
		<option selected="selected" value="6189062">Customer</option>
		<option value="6198072">Trainee</option>
		<option value="6713106">Barista</option>
		<option value="6198074">Senior Barista</option>
		<option value="6198073">Head Barista</option>
		<option value="17934423">Interview Assistant</option>
		<option value="6202054">Interviewer</option>
		<option value="6202045">Supervisor Team</option>
		<option value="6713273">Management Team</option>
		<option value="6202046">Board of Directors</option>
		<option value="6551685">Chief of Directors</option>
		<option value="6713244">Chief of Operations</option>
		<option value="6551537">Chief Staff Officer</option>
		<option value="6749204">Chief Executive Officer</option>
		<option value="17881629">Vice President</option>
		<option value="16828710">President</option>
		<option value="6198066">Chairman</option>
		<option value="6189060">Chairwoman</option>

	</select>
                    <input name="ctl00$cphRoblox$rbxGroupRoleSetMembersPane$RolesetCountHidden" type="text" value="40207" id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_RolesetCountHidden" class="RolesetCountHidden" style="display:none;" />
                    <div id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_AbuseReportButtonRoleSet_AbuseReportPanel" class="ReportAbuse">
		
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_AbuseReportButtonRoleSet_ReportAbuseIconHyperLink" href="http://www.roblox.com/abusereport/grouproleset?id=6189062&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx"><img src="../images/abuse.PNG?v=2" alt="Report Abuse" style="border-width:0px;" /></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_AbuseReportButtonRoleSet_ReportAbuseTextHyperLink" href="http://www.roblox.com/abusereport/grouproleset?id=6189062&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx">Report Abuse</a></span>

	</div>
                </div>
                <div>
                    <div class="spacer" style="visibility:hidden;display:block;height:69px;width:1px;float:left;"></div>
                    
	                
                            
                            <div class="GroupMember" >
				                <div class="Avatar">
                                    <span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl0_iOnlineStatus" src="../images/online.png" alt="Bladestormplays is online." style="border-width:0px;" /></span>
					                <a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl0_hlAvatar" class=" notranslate" title="Bladestormplays" class=" notranslate" href="http://www.roblox.com/users/96883720/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t6.rbxcdn.com/c9055db1963c0afc0afe44ab1f28bebf" height="100" width="100" border="0" alt="Bladestormplays" class=" notranslate" /></a>
                                </div>
				                <div class="Summary" >
					                <span class="Name"><a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl0_hlMember" title="Bladestormplays" class="NameText notranslate" href="http://www.roblox.com/users/96883720/profile">Bladestormplays</a></span>
				                </div>
                            </div>
                        
                            <div class="GroupMember" >
				                <div class="Avatar">
                                    <span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl1_iOnlineStatus" src="../images/online.png" alt="minecraftboy5729 is online." style="border-width:0px;" /></span>
					                <a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl1_hlAvatar" class=" notranslate" title="minecraftboy5729" class=" notranslate" href="http://www.roblox.com/users/65150911/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t7.rbxcdn.com/8b9a35019ee3326b271e4513ba37d517" height="100" width="100" border="0" alt="minecraftboy5729" class=" notranslate" /></a>
                                </div>
				                <div class="Summary" >
					                <span class="Name"><a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl1_hlMember" title="minecraftboy5729" class="NameText notranslate" href="http://www.roblox.com/users/65150911/profile">minecraftboy5729</a></span>
				                </div>
                            </div>
                        
                            <div class="GroupMember" >
				                <div class="Avatar">
                                    <span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl2_iOnlineStatus" src="../images/offline.png" alt="ElsaIce79 is offline (last seen at 12/19/2015 4:18:35 PM." style="border-width:0px;" /></span>
					                <a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl2_hlAvatar" class=" notranslate" title="ElsaIce79" class=" notranslate" href="http://www.roblox.com/users/55399365/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t3.rbxcdn.com/dd2116fcc8e43267ddab7be4c269654a" height="100" width="100" border="0" alt="ElsaIce79" class=" notranslate" /></a>
                                </div>
				                <div class="Summary" >
					                <span class="Name"><a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl2_hlMember" title="ElsaIce79" class="NameText notranslate" href="http://www.roblox.com/users/55399365/profile">ElsaIce79</a></span>
				                </div>
                            </div>
                        
                            <div class="GroupMember" >
				                <div class="Avatar">
                                    <span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl3_iOnlineStatus" src="../images/online.png" alt="PlyThePenguin is online." style="border-width:0px;" /></span>
					                <a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl3_hlAvatar" class=" notranslate" title="PlyThePenguin" class=" notranslate" href="http://www.roblox.com/users/45089819/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t3.rbxcdn.com/d0ddc4aee0a1339713b078f282f587b7" height="100" width="100" border="0" alt="PlyThePenguin" class=" notranslate" /><img src="/images/icons/overlay_obcOnly.png" class="bcOverlay" align="left" style="position:relative;top:-19px;" /></a>
                                </div>
				                <div class="Summary" >
					                <span class="Name"><a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl3_hlMember" title="PlyThePenguin" class="NameText notranslate" href="http://www.roblox.com/users/45089819/profile">PlyThePenguin</a></span>
				                </div>
                            </div>
                        
                            <div class="GroupMember" >
				                <div class="Avatar">
                                    <span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl4_iOnlineStatus" src="../images/offline.png" alt="LUCAS215909 is offline (last seen at 12/19/2015 4:20:06 PM." style="border-width:0px;" /></span>
					                <a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl4_hlAvatar" class=" notranslate" title="LUCAS215909" class=" notranslate" href="http://www.roblox.com/users/102005305/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t0.rbxcdn.com/f9ee890724f670520e02e84d5d906509" height="100" width="100" border="0" alt="LUCAS215909" class=" notranslate" /></a>
                                </div>
				                <div class="Summary" >
					                <span class="Name"><a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl4_hlMember" title="LUCAS215909" class="NameText notranslate" href="http://www.roblox.com/users/102005305/profile">LUCAS215909</a></span>
				                </div>
                            </div>
                        
                            <div class="GroupMember" >
				                <div class="Avatar">
                                    <span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl5_iOnlineStatus" src="../images/online.png" alt="rainbowsparkles23456 is online." style="border-width:0px;" /></span>
					                <a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl5_hlAvatar" class=" notranslate" title="rainbowsparkles23456" class=" notranslate" href="http://www.roblox.com/users/93703287/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t3.rbxcdn.com/e8c9d314d9988d7f99b023603cc81645" height="100" width="100" border="0" alt="rainbowsparkles23456" class=" notranslate" /></a>
                                </div>
				                <div class="Summary" >
					                <span class="Name"><a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl5_hlMember" title="rainbowsparkles23456" class="NameText notranslate" href="http://www.roblox.com/users/93703287/profile">rainbowsparkles23456</a></span>
				                </div>
                            </div>
                        
                            <div class="GroupMember" >
				                <div class="Avatar">
                                    <span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl6_iOnlineStatus" src="../images/online.png" alt="frozenelsa6 is online." style="border-width:0px;" /></span>
					                <a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl6_hlAvatar" class=" notranslate" title="frozenelsa6" class=" notranslate" href="http://www.roblox.com/users/53512578/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t7.rbxcdn.com/c3030eac2335d138e5afc9d9e48e3bbb" height="100" width="100" border="0" alt="frozenelsa6" class=" notranslate" /></a>
                                </div>
				                <div class="Summary" >
					                <span class="Name"><a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl6_hlMember" title="frozenelsa6" class="NameText notranslate" href="http://www.roblox.com/users/53512578/profile">frozenelsa6</a></span>
				                </div>
                            </div>
                        
                            <div class="GroupMember" >
				                <div class="Avatar">
                                    <span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl7_iOnlineStatus" src="../images/offline.png" alt="Victoriathequeen is offline (last seen at 12/19/2015 4:17:28 PM." style="border-width:0px;" /></span>
					                <a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl7_hlAvatar" class=" notranslate" title="Victoriathequeen" class=" notranslate" href="http://www.roblox.com/users/62474023/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t7.rbxcdn.com/01b8a1cc4b05241fd7e3ca89ab76be7e" height="100" width="100" border="0" alt="Victoriathequeen" class=" notranslate" /></a>
                                </div>
				                <div class="Summary" >
					                <span class="Name"><a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl7_hlMember" title="Victoriathequeen" class="NameText notranslate" href="http://www.roblox.com/users/62474023/profile">Victoriathequeen</a></span>
				                </div>
                            </div>
                        
                            <div class="GroupMember" >
				                <div class="Avatar">
                                    <span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl8_iOnlineStatus" src="../images/online.png" alt="lazercat164 is online." style="border-width:0px;" /></span>
					                <a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl8_hlAvatar" class=" notranslate" title="lazercat164" class=" notranslate" href="http://www.roblox.com/users/95446287/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t5.rbxcdn.com/2250529774139b8fe817e10136ccf35a" height="100" width="100" border="0" alt="lazercat164" class=" notranslate" /></a>
                                </div>
				                <div class="Summary" >
					                <span class="Name"><a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl8_hlMember" title="lazercat164" class="NameText notranslate" href="http://www.roblox.com/users/95446287/profile">lazercat164</a></span>
				                </div>
                            </div>
                        
                            <div class="GroupMember" >
				                <div class="Avatar">
                                    <span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl9_iOnlineStatus" src="../images/online.png" alt="Kc70000 is online." style="border-width:0px;" /></span>
					                <a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl9_hlAvatar" class=" notranslate" title="Kc70000" class=" notranslate" href="http://www.roblox.com/users/101674831/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t7.rbxcdn.com/00e4602e863257c18c8b3c22cd225510" height="100" width="100" border="0" alt="Kc70000" class=" notranslate" /></a>
                                </div>
				                <div class="Summary" >
					                <span class="Name"><a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl9_hlMember" title="Kc70000" class="NameText notranslate" href="http://www.roblox.com/users/101674831/profile">Kc70000</a></span>
				                </div>
                            </div>
                        
                            <div style="clear:both;"></div>
                        
                    <div style="clear:both;"></div>
                  <div id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_Footer_div" class="FooterPager" onclick="handlePagerClick(event, &#39;members&#39;);">
	                    <span id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_Footer"><span class="pagerbtns previous"> </span>&nbsp;
                                 <div id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_Footer_ctl01_MembersPagerPanel" onkeypress="javascript:return WebForm_FireDefaultButton(event, &#39;ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_Footer_ctl01_HiddenInputButton&#39;)">
		
                                <div id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_Footer_ctl01_Div1" class="paging_wrapper">
                                    Page <input name="ctl00$cphRoblox$rbxGroupRoleSetMembersPane$dlUsers_Footer$ctl01$PageTextBox" type="text" value="1" id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_Footer_ctl01_PageTextBox" class="paging_input" /> of 
                                    <div class="paging_pagenums_container" >4021</div>
                                    <input type="submit" name="ctl00$cphRoblox$rbxGroupRoleSetMembersPane$dlUsers_Footer$ctl01$HiddenInputButton" value="" onclick="loading(&#39;members&#39;);" id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_Footer_ctl01_HiddenInputButton" class="pagerbtns translate" style="display:none;" />
                                </div>
                                
	</div>
                                <a class="pagerbtns next" href="javascript:__doPostBack(&#39;ctl00$cphRoblox$rbxGroupRoleSetMembersPane$dlUsers_Footer$ctl02$ctl00&#39;,&#39;&#39;)"> </a>&nbsp;</span>
                    </div>
                </div>
            </div>
            <input name="ctl00$cphRoblox$rbxGroupRoleSetMembersPane$currentRoleSetID" type="hidden" id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_currentRoleSetID" value="6189062" />
        
</div>
    <div style="clear: both"></div>
</div>

                        </div>
                        <div id="GroupsPeoplePane_Allies" class="tab-content">
                            <div id="ctl00_cphRoblox_rbxGroupAlliesPane_RelationshipsUpdatePanel" class="grouprelationshipscontainer">
	
        <div >
            
            
                    
                    <div style="width:42px;height:42px;padding:8px;float:left">
                        <a id="ctl00_cphRoblox_rbxGroupAlliesPane_RelationshipsListView_ctrl0_AssetImage1" alt="Flawn®" title="Flawn®" href="http://www.roblox.com/Groups/group.aspx?gid=1238286" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t1.rbxcdn.com/fe6362bfcb3fcf162d3139963d276fd1" height="42" width="42" border="0" alt="Flawn®" /></a>
                    </div>
                
                    <div style="width:42px;height:42px;padding:8px;float:left">
                        <a id="ctl00_cphRoblox_rbxGroupAlliesPane_RelationshipsListView_ctrl1_AssetImage1" alt="Snowies" title="Snowies" href="http://www.roblox.com/Groups/group.aspx?gid=2658654" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t4.rbxcdn.com/a345e855e2bf0d1b164f68ba44d9adb3" height="42" width="42" border="0" alt="Snowies" /></a>
                    </div>
                
                    <div style="width:42px;height:42px;padding:8px;float:left">
                        <a id="ctl00_cphRoblox_rbxGroupAlliesPane_RelationshipsListView_ctrl2_AssetImage1" alt="Frappé®" title="Frappé®" href="http://www.roblox.com/Groups/group.aspx?gid=950346" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t0.rbxcdn.com/3c989f8599ab1825c9524dfce3aacde5" height="42" width="42" border="0" alt="Frappé®" /></a>
                    </div>
                
                    <div style="width:42px;height:42px;padding:8px;float:left">
                        <a id="ctl00_cphRoblox_rbxGroupAlliesPane_RelationshipsListView_ctrl3_AssetImage1" alt="[DD] Digital Designers" title="[DD] Digital Designers" href="http://www.roblox.com/Groups/group.aspx?gid=2578224" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t0.rbxcdn.com/4c4e8421410f3cd4d91ee3b9458c813a" height="42" width="42" border="0" alt="[DD] Digital Designers" /></a>
                    </div>
                
                    <div style="width:42px;height:42px;padding:8px;float:left">
                        <a id="ctl00_cphRoblox_rbxGroupAlliesPane_RelationshipsListView_ctrl4_AssetImage1" alt="SizzleBurger" title="SizzleBurger" href="http://www.roblox.com/Groups/group.aspx?gid=1016598" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t7.rbxcdn.com/9967f3c02a26378babb56b745e482eb4" height="42" width="42" border="0" alt="SizzleBurger" /></a>
                    </div>
                
                    <div style="width:42px;height:42px;padding:8px;float:left">
                        <a id="ctl00_cphRoblox_rbxGroupAlliesPane_RelationshipsListView_ctrl5_AssetImage1" alt="Dunkin&#39; Donuts ® Divisions" title="Dunkin&#39; Donuts ® Divisions" href="http://www.roblox.com/Groups/group.aspx?gid=2623719" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t5.rbxcdn.com/ded7688097df961d21c9f4771c1516f4" height="42" width="42" border="0" alt="Dunkin&#39; Donuts ® Divisions" /></a>
                    </div>
                
                    <div style="width:42px;height:42px;padding:8px;float:left">
                        <a id="ctl00_cphRoblox_rbxGroupAlliesPane_RelationshipsListView_ctrl6_AssetImage1" alt="Breezy&#39;z" title="Breezy&#39;z" href="http://www.roblox.com/Groups/group.aspx?gid=2563555" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t7.rbxcdn.com/7e1b0dc45a17e873a317fba6e9e38b79" height="42" width="42" border="0" alt="Breezy&#39;z" /></a>
                    </div>
                
                    <div style="width:42px;height:42px;padding:8px;float:left">
                        <a id="ctl00_cphRoblox_rbxGroupAlliesPane_RelationshipsListView_ctrl7_AssetImage1" alt="Shake Shack ®" title="Shake Shack ®" href="http://www.roblox.com/Groups/group.aspx?gid=1227426" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t5.rbxcdn.com/96c15c9a503bd819411b63930a54fdb8" height="42" width="42" border="0" alt="Shake Shack ®" /></a>
                    </div>
                
                    <div style="width:42px;height:42px;padding:8px;float:left">
                        <a id="ctl00_cphRoblox_rbxGroupAlliesPane_RelationshipsListView_ctrl8_AssetImage1" alt=" Kestrel " title=" Kestrel " href="http://www.roblox.com/Groups/group.aspx?gid=851558" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t0.rbxcdn.com/c1273c8302cf1a2ec489d988bbd48de1" height="42" width="42" border="0" alt=" Kestrel " /></a>
                    </div>
                
                    <div style="width:42px;height:42px;padding:8px;float:left">
                        <a id="ctl00_cphRoblox_rbxGroupAlliesPane_RelationshipsListView_ctrl9_AssetImage1" alt="True Colors" title="True Colors" href="http://www.roblox.com/Groups/group.aspx?gid=494936" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t4.rbxcdn.com/5e563baab11c8588ee2eb17c81cb36ee" height="42" width="42" border="0" alt="True Colors" /></a>
                    </div>
                
                    <div style="width:42px;height:42px;padding:8px;float:left">
                        <a id="ctl00_cphRoblox_rbxGroupAlliesPane_RelationshipsListView_ctrl10_AssetImage1" alt="Soro&#39;s Restaurant Franchise®" title="Soro&#39;s Restaurant Franchise®" href="http://www.roblox.com/Groups/group.aspx?gid=1108927" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t6.rbxcdn.com/6cc8d90029b840f24f0768b50142ab56" height="42" width="42" border="0" alt="Soro&#39;s Restaurant Franchise®" /></a>
                    </div>
                
                    <div style="width:42px;height:42px;padding:8px;float:left">
                        <a id="ctl00_cphRoblox_rbxGroupAlliesPane_RelationshipsListView_ctrl11_AssetImage1" alt="Tsunami Sushi" title="Tsunami Sushi" href="http://www.roblox.com/Groups/group.aspx?gid=1131775" style="display:inline-block;height:42px;width:42px;cursor:pointer;"><img src="http://t0.rbxcdn.com/e90550b62ad683b7a7ac8b4e70be3488" height="42" width="42" border="0" alt="Tsunami Sushi" /></a>
                    </div>
                
                    <div style="clear:both;margin-bottom:10px;"></div>
                
            <div style="text-align:center">
                
            </div>
        </div>
    
</div>
                        </div>
                        <div id="GroupsPeoplePane_Enemies" class="tab-content">
                            
                        </div>
                        <div id="GroupsPeoplePane_Items" class="tab-content">
                            
<div id="GroupItemPaneInstructions">
    <p>Groups have the ability to create and sell official shirts, pants, and t-shirts! All revenue goes to group funds.</p>
    
</div>
<div id="GroupItemContent">
    <div id="GroupItemPaneContent"></div>
    <div style="clear:both;text-align: center;padding-top:25px;">
        <a href="http://www.roblox.com/catalog/browse.aspx?IncludeNotForSale=false&SortType=3&CreatorID=50746130">See more items for sale by this group</a>
        
    </div>
</div>
<script type="text/javascript">
    
    $(function () {
        var url = '/catalog/html?CreatorId=50746130&ResultsPerPage=3&IncludeNotForSale=false&SortType=3&' + new Date().getTime();
     $.ajax({
            method: "GET",
            url: url,
            crossDomain: true,
            xhrFields: {
                withCredentials: true
            }
        }).done(function (data) {
            if (data.indexOf("CatalogItem") == -1) {
                $('#GroupItemPaneContent').html('<p>This group has no items.</p>');
                return;
            }
            $('#GroupItemPaneContent').html(data);
            Roblox.require('Widgets.ItemImage', function (itemImage) {
                itemImage.populate();
            });
        }, "text");
        });
    
</script>
                        </div>
                        
                    </div>
                </div>
                

<script type="text/javascript">
    Roblox.ExileModal.InitializeGlobalVars(6189062, 977619);
</script>

<div id="ctl00_cphRoblox_GroupWallPane_Wall">
    <div class="StandardBox" style="margin-bottom: 0px;border-bottom:none;" >
        <span class="InsideBoxHeader">Wall</span>
        <div id="WallPostBox">
            
            <textarea name="ctl00$cphRoblox$GroupWallPane$NewPost" rows="2" cols="20" id="ctl00_cphRoblox_GroupWallPane_NewPost" class="GroupWallPostText" style="width:85%;">
</textarea>
         <input type="submit" name="ctl00$cphRoblox$GroupWallPane$NewPostButton" value="Post" id="ctl00_cphRoblox_GroupWallPane_NewPostButton" class="btn-control btn-control-large GroupWallPostBtn translate" />
        </div>
        <div style="clear:both;"></div>
    </div>
    <div class="StandardBox GroupWallPane" style="background:#fff;border-top:none;">
        <div id="ctl00_cphRoblox_GroupWallPane_GroupWallUpdatePanel">
	

    <div id="ExileModal" class="modalPopup blueAndWhite" style="width: 380px; min-height: 50px; display: none;">
		<div id="Div4" class="simplemodal-close">
            <a class="ImageButton closeBtnCircle_35h" style="cursor: pointer; margin-left:385px; position:absolute; top:-18px; left:-10px;"></a>
        </div>
        <div style="text-align:center;">
            <div  class="titleBar">Warning!</div>
            <div style="text-align: center; padding: 10px">
		        <p>
		            Are you sure you want to exile this user?
                    
                    <span class="exile-user-clan-kick-message invisible">They will also be kicked from the Clan.</span>
                    
                </p>
		        <div style="text-align: center; margin: 5px 10px 0px 0px">
		            <a onclick="Roblox.ExileModal.Exile();" id="ctl00_cphRoblox_GroupWallPane_ContinueExile" class="btn-neutral btn-medium" href="javascript:__doPostBack(&#39;ctl00$cphRoblox$GroupWallPane$ContinueExile&#39;,&#39;&#39;)" style="cursor:pointer;"><span>Exile</span></a>
                    <a onclick="Roblox.ExileModal.Close();" id="ctl00_cphRoblox_GroupWallPane_CancelExile" class="btn-negative btn-medium" href="javascript:__doPostBack(&#39;ctl00$cphRoblox$GroupWallPane$CancelExile&#39;,&#39;&#39;)" style="cursor: pointer"><span>Cancel</span></a>
                    <p><input type="checkbox" id="deleteAllPostsByUser" value="1" name="deleteAllPostsByUser" onclick="Roblox.ExileModal.SetDeletePostsBool();"/> Also delete all posts by this user. (Please allow some time.)</p>
                </div>
            </div>
        </div>
    </div>
                
                
                        
                        <div class="AlternatingItemTemplateOdd">
                            <div class="RepeaterImage" >
                                <a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl0_hlAvatar" class=" notranslate" title="MacGirlie" class=" notranslate" href="http://www.roblox.com/users/70496022/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t0.rbxcdn.com/065347c3a7d88bfdc66f4a50c2c4bd1b" height="100" width="100" border="0" alt="MacGirlie" class=" notranslate" /><img src="/images/icons/overlay_bcOnly.png" class="bcOverlay" align="left" style="position:relative;top:-19px;" /></a>                   
                            </div>
                            <div class="RepeaterText" >
                                <div class="GroupWall_PostContainer notranslate linkify">
                                    When are interviews? I've been at the Interview Building for almost 2 hours.
                                </div>
                                <div>
                                    <div class="GroupWall_PostDate">
                                        <span style="color: Gray;">12/19/2015 4:19:45 PM</span>
                                        by
                                        <span class="UserLink notranslate">
                                            <a href="http://www.roblox.com/users/70496022/profile">
                                                MacGirlie
                                            </a>
                                        </span>
                                        <div style="float: right">
                                            <div id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl0_AbuseReportButton_AbuseReportPanel" class="ReportAbuse">
		
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl0_AbuseReportButton_ReportAbuseIconHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278808476&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx"><img src="../images/abuse.PNG?v=2" alt="Report Abuse" style="border-width:0px;" /></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl0_AbuseReportButton_ReportAbuseTextHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278808476&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx">Report Abuse</a></span>

	</div>
                                        </div>
                                    </div>
                                    <div class="GroupWall_PostBtns" style="min-height:0">
                                        
                                        
                                         
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                       </div>
                    
                        <div class="AlternatingItemTemplateEven">
                            <div class="RepeaterImage" >
                                <a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl1_hlAvatar" class=" notranslate" title="Princezzbunny" class=" notranslate" href="http://www.roblox.com/users/16255809/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t3.rbxcdn.com/6b38c7f780f30987df76731aba370b16" height="100" width="100" border="0" alt="Princezzbunny" class=" notranslate" /></a>                 
                            </div>
                            <div class="RepeaterText" >
                                <div class="GroupWall_PostContainer notranslate linkify">
                                    [Tomorrow's QOTD] I prefer shiftlock instead of default. This way I don't have to zoom in when I need to walk side-ways. I do unshift just to walk normally.
                                </div>
                                <div>
                                    <div class="GroupWall_PostDate">
                                        <span style="color: Gray;">12/19/2015 4:16:23 PM</span>
                                        by
                                        <span class="UserLink notranslate">
                                            <a href="http://www.roblox.com/users/16255809/profile">
                                                Princezzbunny
                                            </a>
                                        </span>
                                        <div style="float: right">
                                            <div id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl1_AbuseReportButton_AbuseReportPanel" class="ReportAbuse">
		
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl1_AbuseReportButton_ReportAbuseIconHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278807991&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx"><img src="../images/abuse.PNG?v=2" alt="Report Abuse" style="border-width:0px;" /></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl1_AbuseReportButton_ReportAbuseTextHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278807991&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx">Report Abuse</a></span>

	</div>
                                        </div>
                                    </div>
                                    <div class="GroupWall_PostBtns" style="min-height:0"> 
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                       </div>
                    
                        <div class="AlternatingItemTemplateOdd">
                            <div class="RepeaterImage" >
                                <a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl2_hlAvatar" class=" notranslate" title="Kodinek7" class=" notranslate" href="http://www.roblox.com/users/53128239/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t1.rbxcdn.com/5f4941ec2fe1ba5d09536775ff5fa744" height="100" width="100" border="0" alt="Kodinek7" class=" notranslate" /></a>                   
                            </div>
                            <div class="RepeaterText" >
                                <div class="GroupWall_PostContainer notranslate linkify">
                                    Frappe is stupid!!! I got banned for nothing, I got 2 warnings and they give me ban. They gave me ban on warning 2..
                                </div>
                                <div>
                                    <div class="GroupWall_PostDate">
                                        <span style="color: Gray;">12/19/2015 4:12:01 PM</span>
                                        by
                                        <span class="UserLink notranslate">
                                            <a href="http://www.roblox.com/users/53128239/profile">
                                                Kodinek7
                                            </a>
                                        </span>
                                        <div style="float: right">
                                            <div id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl2_AbuseReportButton_AbuseReportPanel" class="ReportAbuse">
		
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl2_AbuseReportButton_ReportAbuseIconHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278807371&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx"><img src="../images/abuse.PNG?v=2" alt="Report Abuse" style="border-width:0px;" /></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl2_AbuseReportButton_ReportAbuseTextHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278807371&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx">Report Abuse</a></span>

	</div>
                                        </div>
                                    </div>
                                    <div class="GroupWall_PostBtns" style="min-height:0">
                                        
                                        
                                         
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                       </div>
                    
                        <div class="AlternatingItemTemplateEven">
                            <div class="RepeaterImage" >
                                <a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl3_hlAvatar" class=" notranslate" title="Byakugans" class=" notranslate" href="http://www.roblox.com/users/92557157/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t7.rbxcdn.com/c3b86e56459e0f4aec740d6682b47c1d" height="100" width="100" border="0" alt="Byakugans" class=" notranslate" /></a>                 
                            </div>
                            <div class="RepeaterText" >
                                <div class="GroupWall_PostContainer notranslate linkify">
                                    #########
                                </div>
                                <div>
                                    <div class="GroupWall_PostDate">
                                        <span style="color: Gray;">12/19/2015 4:11:11 PM</span>
                                        by
                                        <span class="UserLink notranslate">
                                            <a href="http://www.roblox.com/users/92557157/profile">
                                                Byakugans
                                            </a>
                                        </span>
                                        <div style="float: right">
                                            <div id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl3_AbuseReportButton_AbuseReportPanel" class="ReportAbuse">
		
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl3_AbuseReportButton_ReportAbuseIconHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278807233&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx"><img src="../images/abuse.PNG?v=2" alt="Report Abuse" style="border-width:0px;" /></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl3_AbuseReportButton_ReportAbuseTextHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278807233&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx">Report Abuse</a></span>

	</div>
                                        </div>
                                    </div>
                                    <div class="GroupWall_PostBtns" style="min-height:0"> 
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                       </div>
                    
                        <div class="AlternatingItemTemplateOdd">
                            <div class="RepeaterImage" >
                                <a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl4_hlAvatar" class=" notranslate" title="XxCookies101xX" class=" notranslate" href="http://www.roblox.com/users/65105253/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t4.rbxcdn.com/9858121bfea824a75decbf60a8992847" height="100" width="100" border="0" alt="XxCookies101xX" class=" notranslate" /></a>                   
                            </div>
                            <div class="RepeaterText" >
                                <div class="GroupWall_PostContainer notranslate linkify">
                                    QoTD: Erm... Somtimes.
                                </div>
                                <div>
                                    <div class="GroupWall_PostDate">
                                        <span style="color: Gray;">12/19/2015 3:49:40 PM</span>
                                        by
                                        <span class="UserLink notranslate">
                                            <a href="http://www.roblox.com/users/65105253/profile">
                                                XxCookies101xX
                                            </a>
                                        </span>
                                        <div style="float: right">
                                            <div id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl4_AbuseReportButton_AbuseReportPanel" class="ReportAbuse">
		
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl4_AbuseReportButton_ReportAbuseIconHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278804446&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx"><img src="../images/abuse.PNG?v=2" alt="Report Abuse" style="border-width:0px;" /></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl4_AbuseReportButton_ReportAbuseTextHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278804446&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx">Report Abuse</a></span>

	</div>
                                        </div>
                                    </div>
                                    <div class="GroupWall_PostBtns" style="min-height:0">
                                        
                                        
                                         
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                       </div>
                    
                        <div class="AlternatingItemTemplateEven">
                            <div class="RepeaterImage" >
                                <a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl5_hlAvatar" class=" notranslate" title="cole3490" class=" notranslate" href="http://www.roblox.com/users/24950415/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t0.rbxcdn.com/a7de9bba70179e785c62022b50801431" height="100" width="100" border="0" alt="cole3490" class=" notranslate" /></a>                 
                            </div>
                            <div class="RepeaterText" >
                                <div class="GroupWall_PostContainer notranslate linkify">
                                    QoTD: MouseLock Shift.
                                </div>
                                <div>
                                    <div class="GroupWall_PostDate">
                                        <span style="color: Gray;">12/19/2015 3:44:52 PM</span>
                                        by
                                        <span class="UserLink notranslate">
                                            <a href="http://www.roblox.com/users/24950415/profile">
                                                cole3490
                                            </a>
                                        </span>
                                        <div style="float: right">
                                            <div id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl5_AbuseReportButton_AbuseReportPanel" class="ReportAbuse">
		
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl5_AbuseReportButton_ReportAbuseIconHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278803772&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx"><img src="../images/abuse.PNG?v=2" alt="Report Abuse" style="border-width:0px;" /></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl5_AbuseReportButton_ReportAbuseTextHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278803772&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx">Report Abuse</a></span>

	</div>
                                        </div>
                                    </div>
                                    <div class="GroupWall_PostBtns" style="min-height:0"> 
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                       </div>
                    
                        <div class="AlternatingItemTemplateOdd">
                            <div class="RepeaterImage" >
                                <a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl6_hlAvatar" class=" notranslate" title="Thunderstorm8555" class=" notranslate" href="http://www.roblox.com/users/41807498/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t6.rbxcdn.com/7375924a6edead760a6d5e34e90f53a6" height="100" width="100" border="0" alt="Thunderstorm8555" class=" notranslate" /></a>                   
                            </div>
                            <div class="RepeaterText" >
                                <div class="GroupWall_PostContainer notranslate linkify">
                                    Can someone give me HB?I just passed interviews again and it saved my points! :D
                                </div>
                                <div>
                                    <div class="GroupWall_PostDate">
                                        <span style="color: Gray;">12/19/2015 3:36:34 PM</span>
                                        by
                                        <span class="UserLink notranslate">
                                            <a href="http://www.roblox.com/users/41807498/profile">
                                                Thunderstorm8555
                                            </a>
                                        </span>
                                        <div style="float: right">
                                            <div id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl6_AbuseReportButton_AbuseReportPanel" class="ReportAbuse">
		
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl6_AbuseReportButton_ReportAbuseIconHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278802565&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx"><img src="../images/abuse.PNG?v=2" alt="Report Abuse" style="border-width:0px;" /></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl6_AbuseReportButton_ReportAbuseTextHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278802565&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx">Report Abuse</a></span>

	</div>
                                        </div>
                                    </div>
                                    <div class="GroupWall_PostBtns" style="min-height:0">
                                        
                                        
                                         
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                       </div>
                    
                        <div class="AlternatingItemTemplateEven">
                            <div class="RepeaterImage" >
                                <a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl7_hlAvatar" class=" notranslate" title="oliviam200" class=" notranslate" href="http://www.roblox.com/users/65636196/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t7.rbxcdn.com/0c52880f68ace7066f98d2e57032301a" height="100" width="100" border="0" alt="oliviam200" class=" notranslate" /></a>                 
                            </div>
                            <div class="RepeaterText" >
                                <div class="GroupWall_PostContainer notranslate linkify">
                                    QOTD: Sometimes shiftlock, sometimes default. So both :3
                                </div>
                                <div>
                                    <div class="GroupWall_PostDate">
                                        <span style="color: Gray;">12/19/2015 3:34:56 PM</span>
                                        by
                                        <span class="UserLink notranslate">
                                            <a href="http://www.roblox.com/users/65636196/profile">
                                                oliviam200
                                            </a>
                                        </span>
                                        <div style="float: right">
                                            <div id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl7_AbuseReportButton_AbuseReportPanel" class="ReportAbuse">
		
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl7_AbuseReportButton_ReportAbuseIconHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278802363&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx"><img src="../images/abuse.PNG?v=2" alt="Report Abuse" style="border-width:0px;" /></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl7_AbuseReportButton_ReportAbuseTextHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278802363&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx">Report Abuse</a></span>

	</div>
                                        </div>
                                    </div>
                                    <div class="GroupWall_PostBtns" style="min-height:0"> 
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                       </div>
                    
                        <div class="AlternatingItemTemplateOdd">
                            <div class="RepeaterImage" >
                                <a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl8_hlAvatar" class=" notranslate" title="BostonBruins2020" class=" notranslate" href="http://www.roblox.com/users/29147502/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t0.rbxcdn.com/6813e88bae7efb09849c8e02cb47776b" height="100" width="100" border="0" alt="BostonBruins2020" class=" notranslate" /><img src="/images/icons/overlay_obcOnly.png" class="bcOverlay" align="left" style="position:relative;top:-19px;" /></a>                   
                            </div>
                            <div class="RepeaterText" >
                                <div class="GroupWall_PostContainer notranslate linkify">
                                    elmo fans
                                </div>
                                <div>
                                    <div class="GroupWall_PostDate">
                                        <span style="color: Gray;">12/19/2015 3:31:46 PM</span>
                                        by
                                        <span class="UserLink notranslate">
                                            <a href="http://www.roblox.com/users/29147502/profile">
                                                BostonBruins2020
                                            </a>
                                        </span>
                                        <div style="float: right">
                                            <div id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl8_AbuseReportButton_AbuseReportPanel" class="ReportAbuse">
		
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl8_AbuseReportButton_ReportAbuseIconHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278801942&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx"><img src="../images/abuse.PNG?v=2" alt="Report Abuse" style="border-width:0px;" /></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl8_AbuseReportButton_ReportAbuseTextHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278801942&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx">Report Abuse</a></span>

	</div>
                                        </div>
                                    </div>
                                    <div class="GroupWall_PostBtns" style="min-height:0">
                                        
                                        
                                         
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                       </div>
                    
                        <div class="AlternatingItemTemplateEven">
                            <div class="RepeaterImage" >
                                <a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl9_hlAvatar" class=" notranslate" title="AkaSwift" class=" notranslate" href="http://www.roblox.com/users/49116399/profile" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="http://t3.rbxcdn.com/5a5fd12d526dd02d76777371af2eddd8" height="100" width="100" border="0" alt="AkaSwift" class=" notranslate" /><img src="/images/icons/overlay_bcOnly.png" class="bcOverlay" align="left" style="position:relative;top:-19px;" /></a>                 
                            </div>
                            <div class="RepeaterText" >
                                <div class="GroupWall_PostContainer notranslate linkify">
                                    Thank you for the Trainee Rank!
                                </div>
                                <div>
                                    <div class="GroupWall_PostDate">
                                        <span style="color: Gray;">12/19/2015 3:27:16 PM</span>
                                        by
                                        <span class="UserLink notranslate">
                                            <a href="http://www.roblox.com/users/49116399/profile">
                                                AkaSwift
                                            </a>
                                        </span>
                                        <div style="float: right">
                                            <div id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl9_AbuseReportButton_AbuseReportPanel" class="ReportAbuse">
		
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl9_AbuseReportButton_ReportAbuseIconHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278801418&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx"><img src="../images/abuse.PNG?v=2" alt="Report Abuse" style="border-width:0px;" /></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctrl9_AbuseReportButton_ReportAbuseTextHyperLink" href="http://www.roblox.com/abusereport/groupwallpost?id=278801418&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fmy%2fgroups.aspx">Report Abuse</a></span>

	</div>
                                        </div>
                                    </div>
                                    <div class="GroupWall_PostBtns" style="min-height:0"> 
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                       </div>
                    
                        <div style="clear:both;"></div>
                    
                <div style="clear:both;"></div>
                <div id="ctl00_cphRoblox_GroupWallPane_dlUsers_Footer_div" class="FooterPager" onclick="handlePagerClick(event, &#39;wall&#39;);">
	                <span id="ctl00_cphRoblox_GroupWallPane_GroupWallPager"><span class="pagerbtns previous"> </span>&nbsp;
                                    <div id="ctl00_cphRoblox_GroupWallPane_GroupWallPager_ctl01_GroupWallPagerPanel" onkeypress="javascript:return WebForm_FireDefaultButton(event, &#39;ctl00_cphRoblox_GroupWallPane_GroupWallPager_ctl01_HiddenInputButton&#39;)">
		
                                        <div id="ctl00_cphRoblox_GroupWallPane_GroupWallPager_ctl01_Div1" class="paging_wrapper">
                                            Page <input name="ctl00$cphRoblox$GroupWallPane$GroupWallPager$ctl01$PageTextBox" type="text" value="1" id="ctl00_cphRoblox_GroupWallPane_GroupWallPager_ctl01_PageTextBox" class="paging_input" /> of 
                                            <div class="paging_pagenums_container" >8806</div>
                                            <input type="submit" name="ctl00$cphRoblox$GroupWallPane$GroupWallPager$ctl01$HiddenInputButton" value="" onclick="loading(&#39;wall&#39;);" id="ctl00_cphRoblox_GroupWallPane_GroupWallPager_ctl01_HiddenInputButton" class="pagerbtns" style="display:none;" />
                                        </div>
                                    
	</div>
                                <a class="pagerbtns next" href="javascript:__doPostBack(&#39;ctl00$cphRoblox$GroupWallPane$GroupWallPager$ctl02$ctl00&#39;,&#39;&#39;)"> </a>&nbsp;</span>
                </div>
            
</div>
    </div>
</div>

                
            </div>
            <div id="right-column">
                
                <div class="GroupControlsBox">
                    <span class="InsideBoxHeader">Controls</span>
                    
                    <div id="AdminOptions">
                        
                    </div>
                    <div id="ctl00_cphRoblox_ManagePrimaryGroup">
                        <input type="submit" name="ctl00$cphRoblox$MakePrimaryGroupButton" value="Make Primary" onclick="return confirm(&#39;Are you sure you want to make this your primary group?&#39;);" id="ctl00_cphRoblox_MakePrimaryGroupButton" class="btn-control btn-control-medium translate" />
                        
                    </div>
                    
                    <div id="LeaveGroup">
                        <input type="submit" name="ctl00$cphRoblox$LeaveButton" value="Leave Group" onclick="return confirm(&#39;Are you sure you\&#39;d like to leave this group?&#39;);" id="ctl00_cphRoblox_LeaveButton" class="btn-control btn-control-medium translate" />
                    </div>
                    
                </div>
                <div id="ad" style="height: 600px">
                    

    <iframe allowtransparency="true" frameborder="0" height="612" scrolling="no" src="https://www.roblox.com/userads/2" width="160" data-js-adtype="iframead"></iframe>

                </div>
            </div>
        
    <br style="clear: both" />

    <div id="GetBC" class="modalPopup blueAndWhite" style="width: 380px; min-height: 50px; display: none; position: absolute; top: -200px;">
        <div id="Div2" class="simplemodal-close">
            <a class="ImageButton closeBtnCircle_35h" style="cursor: pointer; margin-left: 385px; position: absolute; top: -18px; left: -10px;"></a>
        </div>
        <div style="padding: 0px 0px 15px 0px; text-align: center;">
            <div class="titleBar">
                Uh-Oh!
            </div>
            <div>
                <p>Creating a group requires a Builders Club membership.</p>
                <div style="text-align: center; margin: 5px 10px 0px 0px">
                    <a class="btn-neutral btn-medium" style="cursor: pointer" href="https://www.roblox.com/premium/membership"><span>Get BC!</span></a>
                    <a class="btn-negative btn-medium" onclick="GetBC.close();return false;" style="cursor: pointer"><span>Cancel</span></a>
                </div>
            </div>
        </div>
    </div>

    <div id="LeaveGroupAsOwner" class="modalPopup blueAndWhite" style="width: 380px; min-height: 50px; display: none; position: absolute; top: -200px;">
        <div id="Div1" class="simplemodal-close">
            <a class="ImageButton closeBtnCircle_35h" style="cursor: pointer; margin-left: 385px; position: absolute; top: -18px; left: -10px;"></a>
        </div>
        <div style="padding: 0px 0px 15px 0px; text-align: center;">
            <div class="titleBar">
                Warning!
            </div>
            <p>You are the owner of this group.  Leaving the group will allow any Builders Club member to claim ownership.</p>
            <p>You will lose all of the privileges of group ownership.</p>
            <div style="text-align: center; margin: 5px 10px 0px 0px">
                <a id="ctl00_cphRoblox_LinkButton3" class="btn-neutral btn-medium" href="javascript:__doPostBack(&#39;ctl00$cphRoblox$LinkButton3&#39;,&#39;&#39;)" style="cursor: pointer"><span>Continue</span></a>
                <a onclick="LeaveGroupAsOwner.close();" id="ctl00_cphRoblox_LinkButton4" class="btn-negative btn-medium" href="javascript:__doPostBack(&#39;ctl00$cphRoblox$LinkButton4&#39;,&#39;&#39;)" style="cursor: pointer"><span>Cancel</span></a>
            </div>

        </div>
    </div>
    <script type="text/javascript">

        if (typeof Roblox === "undefined") {
            Roblox = {};
        }

        if (typeof Roblox.Resources === "undefined") {
            Roblox.Resources = {};
        }
        Roblox.Resources.more = "More";
        Roblox.Resources.less = "Less";

        var GetBC = {};
        var LeaveGroupAsOwner = {};
        GetBC.close = function () {
            $.modal.close(".GetBC");
        };

        GetBC.open = function () {
            var modalProperties = { overlayClose: true, escClose: true, opacity: 80, overlayCss: { backgroundColor: "#000" } };
            $("#GetBC").modal(modalProperties);
        };

        LeaveGroupAsOwner.close = function () {
            $.modal.close(".LeaveGroupAsOwner");
        };

        $(function () {
            var modalProperties = { overlayClose: true, escClose: true, opacity: 80, overlayCss: { backgroundColor: "#000" } };
            
        });

    </script>

                    <div style="clear:both"></div>
                </div>
            </div>
        </div> 
@include('layout.footerlegacy')
@endsection