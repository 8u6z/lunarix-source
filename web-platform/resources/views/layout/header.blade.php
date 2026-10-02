<script type='text/javascript' src='https://js.lunarix.lol/9715e76471ffacd5f6d9c24a5ab101ad.js'></script>
<div class="nav-container no-gutter-ads">
<div id="header" class="navbar-fixed-top lrx-header" role="navigation">
    <div class="container-fluid">
        <div class="lrx-navbar-header">
            <div data-behavior="nav-notification" class="lrx-nav-collapse" onselectstart="return false;">
                @auth
                <!-- here's the big bs about this, lunarix's nav functionality is HORRID and just breaks sometimes so i added one line of javascript here to fix the issue -->
                <span class="lrx-icon-nav-menu" onclick="$('[data-behavior=&quot;left-col&quot;]').toggleClass('nav-show')"></span>
                @endauth
                <div class="lrx-nav-notification hide lrx-font-xs" title="0">
                </div>
            </div>
            <div class="navbar-header">
                <a class="navbar-brand" href="/"><span class="logo"></span></a>
            </div>
        </div>
        <ul class="nav lrx-navbar hidden-xs hidden-sm col-md-4 col-lg-3">
            <li>
                <a href="/games">Games</a>
            </li>
            <li>
                <a href="/catalog">Catalog</a>
            </li>
            <li>
                <a href="/develop">Develop</a>
            </li>
            <li>
                <a class="buy-robux" href="/videos">Videos</a>
            </li>
        </ul><!--lrx-navbar-->
        <div id="navbar-universal-search" class="navbar-left lrx-navbar-search col-xs-5 col-sm-6 col-md-3" data-behavior="univeral-search" role="search">
            <div class="input-group lrx-input-group">


                <input id="navbar-search-input" class="form-control lrx-input-field" type="text" placeholder="Search" maxlength="120" />
                <div class="input-group-btn lrx-input-group-btn">
                    <button id="navbar-search-btn" class="lrx-input-addon-btn" type="submit">
                        <span class="lrx-icon-nav-search"></span>
                    </button>
                </div>
            </div>
            <ul data-toggle="dropdown-menu" class="lrx-dropdown-menu" role="menu">
                <li class="lrx-navbar-search-option selected" data-searchurl="/search/users?keyword=">
                    <span class="lrx-navbar-search-text">Search <span class="lrx-navbar-search-string"></span> in People</span>
                </li>
                        <li class="lrx-navbar-search-option" data-searchurl="/games/?Keyword=">
                            <span class="lrx-navbar-search-text">Search <span class="lrx-navbar-search-string"></span> in Games</span>
                        </li>
                        <li class="lrx-navbar-search-option" data-searchurl="/catalog/browse.aspx?CatalogContext=1&amp;amp;Keyword=">
                            <span class="lrx-navbar-search-text">Search <span class="lrx-navbar-search-string"></span> in Catalog</span>
                        </li>
                        <li class="lrx-navbar-search-option" data-searchurl="/groups/search.aspx?val=">
                            <span class="lrx-navbar-search-text">Search <span class="lrx-navbar-search-string"></span> in Groups</span>
                        </li>
                        <li class="lrx-navbar-search-option" data-searchurl="/develop/library?CatalogContext=2&amp;amp;Category=6&amp;amp;Keyword=">
                            <span class="lrx-navbar-search-text">Search <span class="lrx-navbar-search-string"></span> in Library</span>
                        </li>
                        <li class="lrx-navbar-search-option" data-searchurl="/videos?Keyword=">
                            <span class="lrx-navbar-search-text">Search <span class="lrx-navbar-search-string"></span> in Videos</span>
                        </li>
            </ul>
        </div><!--lrx-navbar-search-->
        <div class="navbar-right lrx-navbar-right col-xs-4 col-sm-3">

@auth
<ul class="nav navbar-right lrx-navbar-icon-group">
    <li>
        <a class="lrx-menu-item" data-toggle="popover" data-bind="popover-setting" data-viewport="#header">
            <span class="lrx-icon-nav-settings" id="nav-settings"></span>
            <span class="lrx-font-xs nav-setting-highlight hidden"></span>
        </a>
<div class="lrx-popover-content" data-toggle="popover-setting">
            <ul class="lrx-dropdown-menu" role="menu">
                <li>
                    <a class="lrx-menu-item" href="/my/account" data-turbo="false">
                        Settings
                </li>
        @role(1)
                <li>
                    <a class="lrx-menu-item" href="/administration" data-turbo="false">
                        Panel
                </li>
        @endrole
                <li><a href="/authentication/logout" data-turbo="false">Logout</a></li>
            </ul>
        </div>
    </li>
    <li>
        <a id="nav-robux-icon" class="lrx-menu-item" data-toggle="popover" data-bind="popover-robux">
            <span class="lrx-icon-nav-robux" id="nav-robux"></span>
            <span class="lrx-text-navbar-right" id="nav-robux-amount">{{ formatnum($currentUser->moons) }}</span>
        </a>
        <div class="lrx-popover-content" data-toggle="popover-robux">
            <ul class="lrx-dropdown-menu" role="menu">
                <li><a href="/My/Money.aspx#/#Summary_tab" id="nav-robux-balance">{{ number_format($currentUser->moons) }} Bytes</a></li>
            </ul>
        </div>
    </li>
    <li class="lrx-navbar-right-search" data-toggle="toggle-search">
        <a class="lrx-menu-icon">
            <span class="lrx-icon-nav-search-white"></span>
        </a>
    </li>
</ul>        </div><!-- navbar right-->
@else
                <ul class="nav navbar-right lrx-navbar-right-nav" data-display-opened="False">
                    <li>
                        <a id="header-login" class="lrx-navbar-login" data-behavior="login" data-toggle="popover" data-bind="popover-login" data-viewport="#header" data-original-title="" title="">Log In</a>
                    </li>
                    <div id="iFrameLogin" class="lrx-popover-content" data-toggle="popover-login" role="menu">
                        <iframe class="lrx-navbar-login-iframe" src="/Login/iFrameLogin.aspx" scrolling="no" frameborder="0" width="320" data-ruffle-polyfilled="" style="height: 200px;"></iframe>
                    </div>
                    <li>
                        <a class="lrx-navbar-signup" href="/Login/NewAge.aspx">Sign Up</a>
                    </li>
                    <li class="lrx-navbar-right-search" data-toggle="toggle-search">
                        <a class="lrx-menu-icon">
                            <span class="lrx-icon-nav-search-white"></span>
                        </a>
                    </li>
                </ul>
        </div><!-- navbar right-->
@endauth
        <ul class="nav lrx-navbar hidden-md hidden-lg col-xs-12">
            <li>
                <a href="/games">Games</a>
            </li>
            <li>
                <a href="/catalog">Catalog</a>
            </li>
            <li>
                <a href="/develop">Develop</a>
            </li>
            <li>
                <a class="buy-robux" href="/videos">Videos</a>
            </li>
        </ul><!--lrx-navbar-->
    </div>
</div>

@auth
<!-- LEFT NAV MENU -->
    <div id="navigation" class="lrx-left-col" data-behavior="left-col">
        <ul>
            <li class="lrx-lead">
                <a href="/users/{{ $currentUser->id }}/profile">{{ $currentUser->username }}</a>
            </li>
            <li class="lrx-divider"></li>
        </ul>
        <div class="lrx-scrollbar" data-toggle="scrollbar" onselectstart="return false;">
            <ul>
                <li><a href="/home" id="nav-home"><span class="lrx-icon-nav-home"></span><span>Home</span></a></li>
                <li><a href="/users/{{ $currentUser->id }}/profile" id="nav-profile"><span class="lrx-icon-nav-profile"></span><span>Profile</span></a></li>
                <li>
                    <a href="/my/messages/#!/inbox" id="nav-message" data-count="{{ $unreadMessagesCount }}">
                        <span class="lrx-icon-nav-message"></span><span>Messages</span>
                        <span class="lrx-highlight" title="{{ $unreadMessagesCount }}">@if($unreadMessagesCount > 0) {{ $unreadMessagesCount }} @endif</span>
                    </a>
                </li>
                <li>
                    <a href="/users/{{ $currentUser->id }}/friends" id="nav-friends" data-count="{{ $friendRequestsCount }}">
                        <span class="lrx-icon-nav-friends"></span><span>Friends</span>
                        <span class="lrx-highlight" title="{{ $friendRequestsCount }}">@if($friendRequestsCount > 0) {{ $friendRequestsCount }} @endif</span>
                    </a>
                </li>
                <li>
                    <a href="/My/Character.aspx" id="nav-character">
                        <span class="lrx-icon-nav-charactercustomizer"></span><span>Character</span>
                    </a>
                </li>
                <li>
                    <a href="/users/{{ $currentUser->id }}/inventory" id="nav-inventory">
                        <span class="lrx-icon-nav-inventory"></span><span>Inventory</span>
                    </a>
                </li>
                <li>
                    <a href="/My/Money.aspx#/#TradeItems_tab" id="nav-trade">
                        <span class="lrx-icon-nav-trade"></span><span style="text-decoration: line-through;">Trade</span>
                    </a>
                </li>
                <li>
                   <a href="/My/Groups.aspx" id="nav-group">
                        <span class="lrx-icon-nav-group"></span><span style="text-decoration: line-through;">Groups</span>
                    </a>
                </li>
                <li>
                    <a href="/Forum/default.aspx" id="nav-forum">
                        <span class="lrx-icon-nav-forum"></span><span>Forum</span>
                    </a>
                </li>
                <li>
                    <a href="https://blog.lunarix.lol/" id="nav-blog">
                        <span class="lrx-icon-nav-blog"></span><span>Blog</span>
                    </a>
                </li>
    {{--    <li>
                    <a href="/videos" id="nav-blog">
                        <span class="lrx-icon-nav-menu"></span><span style="text-decoration: line-through;">SIDFO</span>
                    </a>
                </li> --}}


                <li class="lrx-upgrade-now">
                    <a href="/Upgrades/BloxxersClubMemberships.aspx?ctx=leftnav" class="lrx-btn-secondary-xs" id="upgrade-now-button">Upgrade Now</a>
                </li>
                <li class="lrx-text-notes lrx-font-bold lrx-font-sm">
                        Events
                    </li>
                    <li class="lrx-nav-sponsor" ng-non-bindable="">
                            <a class="menu-item" href="/sponsored/colorfularray" title="Colorful Array by Neuro-sama">
                                  <img src="/images/contests/colorfularray.png">
                                 
                            </a>
                        </li>
            </ul>
        </div>
    </div>
@endauth