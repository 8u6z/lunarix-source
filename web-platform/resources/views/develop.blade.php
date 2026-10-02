@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___23e1cfc4f7f34bdc2ff4f3c2d637a122_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___e18vueuuipo91sutifozyditjb0f59ez_m.css">
@endpush
@section('content')
@include('layout.header')
<script>String.format = function() {var s = arguments[0];for (var i = 0; i < arguments.length - 1; i++) {s = s.replace(new RegExp('\\{' + i + '\\}', 'gm'), arguments[i + 1]);} return s;};</script>
<script type="text/javascript" src="/gigya.js"></script>
<script src='http://js.lunarix.lol/50cb8c7590b75499925be4825ab1fb8f.js'></script>
<script src='https://js.lunarix.lol/c5827143734572fa7bd8fcc79c3c126b.js.gzip'></script>
<script type='text/javascript'>Lunarix.config.externalResources = [];Lunarix.config.paths['Pages.Catalog'] = 'http://js.lunarix.lol/1612c57544c7977e19cd15c824f7ecc3.js';Lunarix.config.paths['Pages.CatalogShared'] = 'http://js.lunarix.lol/4eb48eec34ca711d5a7b08a4291ac753.js';Lunarix.config.paths['Pages.Messages'] = 'http://js.lunarix.lol/e8cbac58ab4f0d8d4c707700c9f97630.js';Lunarix.config.paths['Resources.Messages'] = 'http://js.lunarix.lol/fb9cb43a34372a004b06425a1c69c9c4.js';Lunarix.config.paths['Widgets.AvatarImage'] = 'http://js.lunarix.lol/bbaeb48f3312bad4626e00c90746ffc0.js';Lunarix.config.paths['Widgets.DropdownMenu'] = 'http://js.lunarix.lol/7b436bae917789c0b84f40fdebd25d97.js';Lunarix.config.paths['Widgets.GroupImage'] = 'http://js.lunarix.lol/33d82b98045d49ec5a1f635d14cc7010.js';Lunarix.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.lunarix.lol/fbb86cf0752d23f389f983419d3085b4.js';Lunarix.config.paths['Widgets.ItemImage'] = 'http://js.lunarix.lol/838ec9c8067ba6fd6793a8bdbdb48a5c.js';Lunarix.config.paths['Widgets.PlaceImage'] = 'http://js.lunarix.lol/f2697119678d0851cfaa6c2270a727ed.js';Lunarix.config.paths['Widgets.SurveyModal'] = 'http://js.lunarix.lol/d6e979598c460090eafb6d38231159f6.js';</script><script type="text/javascript">
    $(function () {
        Lunarix.JSErrorTracker.initialize({ 'suppressConsoleError': true});
    });
</script>
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



        <script type="text/javascript">Lunarix.FixedUI.gutterAdsEnabled=true;</script>

        

        <div id="Container">
            
            
        </div>
        
        
        <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
        @include('layout.body.alert')
    <div id="AdvertisingLeaderboard"  class = " top-ad-728 ">
        

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
      <div id="TosAgreementInfo" data-terms-check-needed="True"></div>
      <div id="DevelopTabs" class="tab-container">
        <div id="MyCreationsTabLink" class="tab-active" data-url="/develop">My Creations</div>
        <div id="GroupCreationsTabLink" data-url="/develop/groups" data-default-get-url="/build/buildview" style="display:none">Group Creations</div>
        <div id="LibraryTabLink" data-url="/develop/library" data-library-get-url="/catalog/contents?CatalogContext=DevelopOnly&amp;Category=Models">Library</div>
      </div>
      <div>
        <div id="MyCreationsTab" class="tab-active">
          <div class="BuildPageContent" data-groupid="">
            <input id="assetTypeId" name="assetTypeId" type="hidden" value="9">
            <input data-val="true" data-val-required="The IsTgaUploadEnabled field is required." id="isTgaUploadEnabled" name="isTgaUploadEnabled" type="hidden" value="True">
            <table id="build-page" data-asset-type-id="9" data-showcases-enabled="true" data-edit-opens-studio="True">
              <tbody>
                <tr>
                  <td class="menu-area divider-right">
                    <a href="/develop?View=9" class="tab-item @if($activeView === 9) tab-item-selected @endif">Places</a>
                    <a href="/develop?View=10" class="tab-item @if($activeView === 10) tab-item-selected @endif">Models</a>
                    <a href="/develop?View=13" class="tab-item @if($activeView === 13) tab-item-selected @endif">Decals</a>
                    <a href="/develop?View=21" class="tab-item @if($activeView === 21) tab-item-selected @endif">Badges</a>
                    <a href="/develop?View=34" class="tab-item @if($activeView === 34) tab-item-selected @endif">Game Passes</a>
                    <a href="/develop?View=3" class="tab-item @if($activeView === 3) tab-item-selected @endif">Audio</a>
                    <a href="/develop?View=40" class="tab-item @if($activeView === 40) tab-item-selected @endif">Meshes</a>
                    <a href="/develop?View=userads" class="tab-item @if($activeView === 'userads') tab-item-selected @endif">User Ads</a>
                    <a href="/develop?View=11" class="tab-item @if($activeView === 11) tab-item-selected @endif">Shirts</a>
                    <a href="/develop?View=2" class="tab-item @if($activeView === 2) tab-item-selected @endif">T-Shirts</a>
                    <a href="/develop?View=12" class="tab-item @if($activeView === 12) tab-item-selected @endif">Pants</a>
                    <a href="/develop?View=38" class="tab-item @if($activeView === 38) tab-item-selected @endif">Plugins</a>
                    <a href="/develop?View=videos" class="tab-item @if($activeView === 'videos') tab-item-selected @endif">Videos</a>
                    <div id="StudioWidget">
											<div class="widget-name">
												<h3>Lunarix Studio</h3>
											</div>
											<div class="content">
												<div id="LeftColumn">
													<div class="studio-icon"><img src="/images/LogoOutline.png"></div>
												</div>
												<div id="RightColumn">
													<ul>
														<li><a href="//setup.lunarix.lol/LunarixStudioLauncherBeta.exe" class="studio-launch" download="//setup.lunarix.lol/LunarixStudioLauncherBeta.exe">Download</a></li>
														<li><a href="/Forum/default.aspx">Forum</a></li>
													</ul>
												</div>
											</div>
										</div>
                  </td>
                    <td class="content-area">
                  @if(isset($contentView))
                        @include($contentView)
                    @else
                        @include('developviews.9')
                    @endif
                  </td>                </tr>
              </tbody>
            </table>
            @if($isGamesView)
            <div id="build-dropdown-menu">
              <a href="#" data-href-template="/places/0/update">Configure Place</a>
              <a href="#" data-gameonly-link="true" data-href-template="/places/0/stats">Developer Stats</a>
              <a class="shutdown-all-servers-button" href="#">Shut Down All Servers</a>
            </div>
            @else
            <div id="build-dropdown-menu">
              <a href="#" data-href-template="/my/Item.aspx?id=0">Configure Item</a>
              <a href="#" data-href-template="/My/NewUserAd.aspx?targetID=0">Advertise</a>
            </div>
            @endif
            <div class="PlaceSelectorModal modalPopup unifiedModal" style="display:none">
              <div class="Title">Select Place</div>
              <div class="GenericModalBody text">
                <div class="place-selector-modal" data-place-loader-url="/universes/get-places-by-context?creationContext=NonGameCreation&amp;universeId=0&amp;groupId=">
                  <div class="place-selector-container">
                    <div id="PlaceSelectorItemContainer" class="place-selector-item-container"></div>
                    <div id="PlaceSelectorPagerContainer" class="place-selector-pager-container"></div>
                  </div>
                  <div class="place-selector template" title="Place" style="display:none">
                    <div class="place-image" data-retry-url-template="/asset-thumbnail/json?height=100&amp;width=160&amp;format=jpeg&amp;returnAutoGenerated=True">
                      <img alt="^_^" class="item-image" src="https://cdn.lunarix.lol/ec5c01d220bf1b73403fa51519267742.gif">
                    </div>
                    <div class="InfoContainer">
                      <div class="place-name"></div>
                      <div class="game-name">
                        <span class="form-label">Game: </span>
                        <span class="game-name-text"></span>
                      </div>
                    </div>
                    <div style="clear:both"></div>
                  </div>
                </div>
              </div>
            </div>
            <script>
              $(function() {
                Lunarix.PlaceSelector.Init();
                Lunarix.PlaceSelector.Resources = {
                  anErrorOccurred: 'An error occurred, please try again.'
                };
              });
            </script>
            <div class="GenericModal modalPopup unifiedModal smallModal" style="display:none">
              <div class="Title"></div>
              <div class="GenericModalBody">
                <div>
                  <div class="ImageContainer">
                    <img class="GenericModalImage" alt="generic image">
                  </div>
                  <div class="Message"></div>
                </div>
                <div class="GenericModalButtonContainer">
                  <a class="ImageButton btn-neutral btn-large lunarix-ok">OK</a>
                </div>
              </div>
            </div>
            <script>
              Lunarix = Lunarix || {};
              Lunarix.BuildPage = Lunarix.BuildPage || {};
              Lunarix.BuildPage.AlertURL = "https://cdn.lunarix.lol/43ac54175f3f3cd403536fedd9170c10.png";
            </script>
          </div>
          <div class="Ads_WideSkyscraper">
             <iframe allowtransparency="true"
            frameborder="0"
            height="612"
            scrolling="no"
            src="/userads/2"
            width="160"
            data-js-adtype="iframead"></iframe>

          </div>
          <script>
            if (typeof Lunarix === "undefined") {
              Lunarix = {};
            }
            if (typeof Lunarix.BuildPage === "undefined") {
              Lunarix.BuildPage = {};
            }
            Lunarix.BuildPage.Resources = {
                active: "Active",
                inactive: "Inactive",
                activatePlace: "Activate Place",
                editGame: "Edit Game",
                ok: "OK",
                lunarixStudio: "Lunarix Studio",
                openIn: "To edit this game, open to this page in ",
                placeInactive: "Place Inactive",
                toBuileHere: "To build here, please activate this place by clicking the ",
                inactiveButton: "inactive button. ",
                createModel: "Create Model",
                toCreate: "To create models, please use ",
                makeActive: "Make Active",
                makeInactive: "Make Inactive",
                purchaseComplete: "Purchase Complete!",
                youHaveBid: "You have successfully bid ",
                confirmBid: "Confirm the Bid",
                placeBid: "Place Bid",
                cancel: "Cancel",
                errorOccurred: "Error Occurred",
                adDeleted: "Ad Deleted",
                theAdWasDeleted: "The Ad has been deleted.",
                confirmDelete: "Confirm Deletion",
                areYouSureDelete: "Are you sure you want to delete this Ad?",
                bidRejected: "Your bid was Rejected",
                bidRange: "Bid value must be a number between ",
                bidRange2: "Bid value must be a number greater than ",
                and: " and ",
                yourRejected: "Your bid was Rejected",
                estimatorExplanation: "This estimator uses data from ads run yesterday to guess how many impressions your ad will recieve.",
                estimatedImpressions: "Estimated Impressions ",
                makeAdBid: "Make Ad Bid",
                wouldYouLikeToBid: "Would you like to bid ",
                verify: "Verify",
                emailVerifiedTitle: "Verify Your Email",
                emailVerifiedMessage: "You must verify your email before you can work on your place. You can verify your email on the  < a href = '/my/account?confirmemail=1' > Account < /a> page.",continueText:"Continue",profileRemoveTitle:"Remove from profile?",profileRemoveMessage:"This game is inactive and listed on your profile, do you wish to remove it?",profileAddTitle:"Add to profile?",profileAddMessage:"This game is active, but not listed on your profile, do you wish to add it?",deactivateTitle:"Deactivate Place",deactivateBody:"This will shut down any running games; VIP subscriptions will also be cancelled. < br / > < br / > Do you still want to deactivate ? ",deactivateButton:"
                Deactivate ",questionmarkImgUrl:"
                https: //static.lrxcdn.com/images/Buttons/questionmark-12x12.png",activationRequestFailed:"Request to activate game failed. Please retry in a few minutes!",deactivationRequestFailed:"Request to deactivate game failed. Please retry in a few minutes!",tooManyActiveMessage:"You have reached the maximum number of active places for your membership level. Deactivate one of your existing active places before making this place active.",activeSlotsMessage:"{0} of {1} active slots used"};
          </script>
        </div>
        <div id="GroupCreationsTab" style="display:none">
          <div class="BuildPageContent" data-groupid="">
            <div class="GenericModal modalPopup unifiedModal smallModal" style="display:none">
              <div class="Title"></div>
              <div class="GenericModalBody">
                <div>
                  <div class="ImageContainer">
                    <img class="GenericModalImage" alt="generic image">
                  </div>
                  <div class="Message"></div>
                </div>
                <div class="GenericModalButtonContainer">
                  <a class="ImageButton btn-neutral btn-large lunarix-ok">OK</a>
                </div>
              </div>
            </div>
            <script>
              Lunarix = Lunarix || {};
              Lunarix.BuildPage = Lunarix.BuildPage || {};
              Lunarix.BuildPage.AlertURL = "https://cdn.lunarix.lol/43ac54175f3f3cd403536fedd9170c10.png";
            </script>
          </div>
          <div class="Ads_WideSkyscraper">
            <div id="Skyscraper-Adp-Right" class="abp abp-container right-abp">
              <iframe allowtransparency="true"
                      frameborder="0"
                      height="612"
                      scrolling="no"
                      src="/userads/2"
                      width="160"
                      data-js-adtype="iframead"></iframe>
                </div>
          </div>
          <script>
            if (typeof Lunarix === "undefined") {
              Lunarix = {};
            }
            if (typeof Lunarix.BuildPage === "undefined") {
              Lunarix.BuildPage = {};
            }
            Lunarix.BuildPage.Resources = {
                active: "Active",
                inactive: "Inactive",
                activatePlace: "Activate Place",
                editGame: "Edit Game",
                ok: "OK",
                lunarixStudio: "Lunarix Studio",
                openIn: "To edit this game, open to this page in ",
                placeInactive: "Place Inactive",
                toBuileHere: "To build here, please activate this place by clicking the ",
                inactiveButton: "inactive button. ",
                createModel: "Create Model",
                toCreate: "To create models, please use ",
                makeActive: "Make Active",
                makeInactive: "Make Inactive",
                purchaseComplete: "Purchase Complete!",
                youHaveBid: "You have successfully bid ",
                confirmBid: "Confirm the Bid",
                placeBid: "Place Bid",
                cancel: "Cancel",
                errorOccurred: "Error Occurred",
                adDeleted: "Ad Deleted",
                theAdWasDeleted: "The Ad has been deleted.",
                confirmDelete: "Confirm Deletion",
                areYouSureDelete: "Are you sure you want to delete this Ad?",
                bidRejected: "Your bid was Rejected",
                bidRange: "Bid value must be a number between ",
                bidRange2: "Bid value must be a number greater than ",
                and: " and ",
                yourRejected: "Your bid was Rejected",
                estimatorExplanation: "This estimator uses data from ads run yesterday to guess how many impressions your ad will recieve.",
                estimatedImpressions: "Estimated Impressions ",
                makeAdBid: "Make Ad Bid",
                wouldYouLikeToBid: "Would you like to bid ",
                verify: "Verify",
                emailVerifiedTitle: "Verify Your Email",
                emailVerifiedMessage: "You must verify your email before you can work on your place. You can verify your email on the  < a href = '/my/account?confirmemail=1' > Account < /a> page.",continueText:"Continue",profileRemoveTitle:"Remove from profile?",profileRemoveMessage:"This game is inactive and listed on your profile, do you wish to remove it?",profileAddTitle:"Add to profile?",profileAddMessage:"This game is active, but not listed on your profile, do you wish to add it?",deactivateTitle:"Deactivate Place",deactivateBody:"This will shut down any running games; VIP subscriptions will also be cancelled. < br / > < br / > Do you still want to deactivate ? ",deactivateButton:"
                Deactivate ",questionmarkImgUrl:"
                https: //static.lrxcdn.com/images/Buttons/questionmark-12x12.png",activationRequestFailed:"Request to activate game failed. Please retry in a few minutes!",deactivationRequestFailed:"Request to deactivate game failed. Please retry in a few minutes!",tooManyActiveMessage:"You have reached the maximum number of active places for your membership level. Deactivate one of your existing active places before making this place active.",activeSlotsMessage:"{0} of {1} active slots used"};
          </script>
        </div>
        <div id="LibraryTab">
          <div class="loading" id="LibraryLoadingIndicatorContainer">
            <img id="LibraryLoadingIndicator" src="https://cdn.lunarix.lol/ec4e85b0c4396cf753a06fade0a8d8af.gif" alt="Progress">
          </div>
        </div>

      </div>
      <div id="AdPreviewModal" class="simplemodal-data" style="display:none">
        <div id="ConfirmationDialog" style="overflow:hidden">
          <div id="AdPreviewContainer" style="overflow:hidden"></div>
        </div>
      </div>
      <script>
        Lunarix.CatalogValues = Lunarix.CatalogValues || {};
        Lunarix.CatalogValues.CatalogContentsUrl = "/catalog/contents";
        Lunarix.CatalogValues.CatalogContext = 2;
        Lunarix.CatalogValues.CatalogContextDevelopOnly = 2;
        Lunarix.CatalogValues.ContainerID = "LibraryTab";
        $(function() {
          if (Lunarix && Lunarix.AdsHelper && Lunarix.AdsHelper.AdRefresher) {
            Lunarix.AdsHelper.AdRefresher.globalCreateNewAdEnabled = true;
            Lunarix.AdsHelper.AdRefresher.adRefreshRateInMilliseconds = 3000;
          }
        });
      </script>
      <div style="clear:both"></div>
    </div>
  </div>
</div>
@include('layout.footerlegacy')
@endsection