        </div>
    </div>

@php
    $footerHost = config('app.base_url_nohttp');
@endphp

<footer class="container-footer">
    <div class="footer">
        <ul class="row footer-links" style="display: flex; flex-wrap: wrap; justify-content: center;">
            <li class="col-xs-4 col-sm-2 footer-link">
                <a href="//{{ $footerHost }}/about" class="lunarix-interstitial" target="_blank">
                    <h2>About Us</h2>
                </a>
            </li>
            <li class="col-xs-4 col-sm-2 footer-link">
                <a href="//blog.{{ $footerHost }}" class="lunarix-interstitial" target="_blank">
                    <h2>Blog</h2>
                </a>
            </li>
            <li class="col-xs-4 col-sm-2 footer-link">
                <a href="/info/Privacy.aspx" target="_blank">
                    <h2>Privacy</h2>
                </a>
            </li>
            <li class="col-xs-4 col-sm-2 footer-link">
                <a href="/contributors" target="_blank">
                    <h2>Contributors</h2>
                </a>
            </li>
        </ul>
        <p class="footer-note">
            Lunarix, "Be Anything, Build Anything" is an independent community-made platform made by <a target="_blank" href="#" class="lrx-link lunarix-interstitial">Sukaira's Fridge</a>. Lunarix is not sponsored, authorized or endorsed by corporations or companies in any way, shape or form. Use of this site signifies your acceptance of the <a href="/info/terms-of-service" target="_blank" class="lrx-link">Terms and Conditions</a>.
        </p>
    </div>
</footer>

</div>

<script type="text/javascript">function urchinTracker() {}</script>

<div id="PlaceLauncherStatusPanel" style="display:none;width:300px"
     data-new-plugin-events-enabled="True"
     data-event-stream-for-plugin-enabled="True"
     data-event-stream-for-protocol-enabled="True"
     data-is-protocol-handler-launch-enabled="True"
     data-is-user-logged-in="{{ auth()->check() ? 'True' : 'False' }}"
     data-os-name="Windows"
     data-protocol-name-for-client="lunarix-player"
     data-protocol-name-for-studio="lunarix-studio"
     data-protocol-url-includes-launchtime="true"
     data-protocol-detection-enabled="true">
    <div class="modalPopup blueAndWhite PlaceLauncherModal" style="min-height: 160px">
        <div id="Spinner" class="Spinner" style="padding:20px 0;">
            <img src="https://cdn.lunarix.lol/e998fb4c03e8c2e30792f2f3436e9416.gif" height="32" width="32" alt="Progress" />
        </div>
        <div id="status" style="min-height:40px;text-align:center;margin:5px 20px">
            <div id="Starting" class="PlaceLauncherStatus MadStatusStarting" style="display:block">
                Starting Lunarix...
            </div>
            <div id="Waiting" class="PlaceLauncherStatus MadStatusField">Connecting to Players...</div>
            <div id="StatusBackBuffer" class="PlaceLauncherStatus PlaceLauncherStatusBackBuffer MadStatusBackBuffer"></div>
        </div>
        <div style="text-align:center;margin-top:1em">
            <input type="button" class="Button CancelPlaceLauncherButton translate" value="Cancel" />
        </div>
    </div>
</div>

<div id="ProtocolHandlerStartingDialog" style="display:none;">
    <div class="modalPopup ph-modal-popup">
        <div class="ph-modal-header">

        </div>
        <div class="ph-logo-row">
            <img src="/images/LogoOutline.png" width="90" height="90" alt="R" />
        </div>
        <div class="ph-areyouinstalleddialog-content">
            <p class="larger-font-size">
                Lunarix is now loading. Get ready to play!
            </p>
            <div class="ph-startingdialog-spinner-row">
                <img src="https://cdn.lunarix.lol/4bed93c91f909002b1f17f05c0ce13d1.gif" width="82" height="24" />
            </div>
        </div>
    </div>
</div>
<div id="ProtocolHandlerAreYouInstalled" style="display:none;">
    <div class="modalPopup ph-modal-popup">
        <div class="ph-modal-header">
            <span class="lrx-icon-close simplemodal-close"></span>
        </div>
        <div class="ph-logo-row">
            <img src="/images/LogoOutline.png" width="90" height="90" alt="R" />
        </div>
        <div class="ph-areyouinstalleddialog-content">
            <p class="larger-font-size">
                You're moments away from getting into the game!
            </p>
            <div>
                <button type="button" class="btn lrx-btn-primary-sm" id="ProtocolHandlerInstallButton">
                    Download and Install Lunarix
                </button>
            </div>
            <div class="lrx-small lrx-text-notes">
                <a href="https://en.help.lunarix.com/hc/en-us/articles/204473560" class="lrx-link" target="_blank">Click here for help</a>
            </div>

        </div>
    </div>
</div>
<div id="ProtocolHandlerClickAlwaysAllowed" class="ph-clickalwaysallowed" style="display:none;">
    <p class="larger-font-size">
        <span class="lrx-icon-moreinfo"></span>
        Check <b>Remember my choice</b> and click <img src="https://cdn.lunarix.lol/7c8d7a39b4335931221857cca2b5430b.png" alt="Launch Application" />  in the dialog box above to join games faster in the future!
    </p>
</div>

<div id="videoPrerollPanel" style="display:none">
        <div id="videoPrerollTitleDiv">
            Gameplay sponsored by: Neuro-sama
        </div>
        <div id="videoPrerollMainDiv"></div>
        <div id="videoPrerollLoadingDiv">
            Loading <span id="videoPrerollLoadingPercent">0%</span> - <span id="videoPrerollMadStatus" class="MadStatusField">Starting game...</span><span id="videoPrerollMadStatusBackBuffer" class="MadStatusBackBuffer"></span>
            <div id="videoPrerollLoadingBar">
                <div id="videoPrerollLoadingBarCompleted">
                </div>
            </div>
        </div>
        <div id="videoPrerollJoinBC">
            <span>Get more with Bloxxers Club!</span>
            <a href="/Upgrades/BloxxersClubMemberships.aspx?ctx=preroll" target="_blank" class="lrx-btn-secondary-xs" id="videoPrerollJoinBCButton">Join Bloxxers Club</a>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            if (Lunarix.VideoPreRoll) {
                Lunarix.VideoPreRoll.showVideoPreRoll = false;
                Lunarix.VideoPreRoll.isPrerollShownEveryXMinutesEnabled = true;
                Lunarix.VideoPreRoll.loadingBarMaxTime = 33000;
                Lunarix.VideoPreRoll.videoOptions.key = "lunarixcorporation"; 
                    Lunarix.VideoPreRoll.videoOptions.categories = "AgeUnknown,GenderUnknown";
                                     Lunarix.VideoPreRoll.videoOptions.id = "games";
                Lunarix.VideoPreRoll.videoLoadingTimeout = 11000;
                Lunarix.VideoPreRoll.videoPlayingTimeout = 41000;
                Lunarix.VideoPreRoll.videoLogNote = "Guest";
                Lunarix.VideoPreRoll.logsEnabled = true;
                Lunarix.VideoPreRoll.excludedPlaceIds = "32373412";
                Lunarix.VideoPreRoll.adTime = 15;
                    
                Lunarix.VideoPreRoll.specificAdOnPlacePageEnabled = true;
                Lunarix.VideoPreRoll.specificAdOnPlacePageId = 192800;
                Lunarix.VideoPreRoll.specificAdOnPlacePageCategory = "stooges";
                
                                    
                Lunarix.VideoPreRoll.specificAdOnPlacePage2Enabled = true;
                Lunarix.VideoPreRoll.specificAdOnPlacePage2Id = 2370766;
                Lunarix.VideoPreRoll.specificAdOnPlacePage2Category = "lego";
                
                $(Lunarix.VideoPreRoll.checkEligibility);
            }
        });
    </script>


<div id="GuestModePrompt_BoyGirl" class="Revised GuestModePromptModal" style="display:none;">
    <div class="simplemodal-close">
        <a class="ImageButton closeBtnCircle_20h" style="cursor: pointer; margin-left:455px;top:7px; position:absolute;"></a>
    </div>
    <div class="Title">
        You are not logged in
    </div>
    <div style="min-height: 275px; background-color: white;">
        <div style="clear:both; height:25px;"></div>

        <div style="text-align: center;">
            <h4>Please Sign up</h4>
        </div>
        <div style="clear:both; height:25px;"></div>
        <div class="RevisedFooter" >
            <div style="width:200px;margin:10px auto 0 auto;">
                <a href="/newlogin?returnUrl=%2Fusers%2F1%2Fprofile"><div class="RevisedCharacterSelectSignup"></div></a>
                <a class="HaveAccount" href="/newlogin?returnUrl=%2Fusers%2F1%2Fprofile">I have an account</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function checkLunarixInstall() {
             return LunarixLaunch.CheckLunarixInstall('https://setup.lunarix.lol/LunarixPlayerLauncher.exe');
    }

</script>

<div id="InstallationInstructions" style="display:none;">
    <div class="ph-installinstructions">
        <div class="ph-modal-header">
            <span class="lrx-icon-close simplemodal-close"></span>
            <h3>Thanks for playing Lunarix</h3>
        </div>
        <div class="ph-installinstructions-body">
                <div class="ph-install-step ph-installinstructions-step1-of4">
                    <h1>1</h1>
                    <p class="larger-font-size">Click LunarixPlayerLauncher.exe to run the Lunarix installer, which just downloaded via your web browser.</p>
                    <img width="230" height="180" src="https://cdn.lunarix.lol/22ff09393bb9dc4093b85439f420a531.png" />
                </div>
                <div class="ph-install-step ph-installinstructions-step2-of4">
                    <h1>2</h1>
                    <p class="larger-font-size">Click <strong>Run</strong> when prompted by your computer to begin the installation process.</p>
                    <img width="230" height="180" src="https://cdn.lunarix.lol/4a3f96d30df0f7879abde4ed837446c6.png" />
                </div>
                <div class="ph-install-step ph-installinstructions-step3-of4">
                    <h1>3</h1>
                    <p class="larger-font-size">Click <strong>Ok</strong> once you've successfully installed Lunarix.</p>
                    <img width="230" height="180" src="https://cdn.lunarix.lol/1889460e8475fd0bc24c6b57992b31d4.png" />
                </div>
                <div class="ph-install-step ph-installinstructions-step4-of4">
                    <h1>4</h1>
                    <p class="larger-font-size">After installation, click <strong>Play</strong> below to join the action!</p>
                    <div class="VisitButton VisitButtonContinuePH">
                        <a class="btn lrx-btn-primary-lg disabled">Play</a>
                    </div>
                </div>
        </div>
        <div class="lrx-font-sm lrx-text-notes">
            The Lunarix installer should download shortly. If it doesn’t, <a href="#" onclick="Lunarix.ProtocolHandlerClientInterface.startDownload(); return false;">start the download now.</a>
        </div>
    </div>
</div>
<div class="InstallInstructionsImage" data-modalwidth="970" style="display:none;"></div>



<div id="pluginObjDiv" style="height:1px;width:1px;visibility:hidden;position: absolute;top: 0;"></div>
<iframe id="downloadInstallerIFrame" style="visibility:hidden;height:0;width:1px;position:absolute"></iframe>

<script type='text/javascript' src='http://js.lunarix.lol/453a3526187103f27673584103a84bc7.js'></script>

<script type="text/javascript">
    Lunarix.Client._skip = null;
    Lunarix.Client._CLSID = '76D50904-6780-4c8b-8986-1A7EE0B1716D';
    Lunarix.Client._installHost = 'setup.lunarix.com';
    Lunarix.Client.ImplementsProxy = true;
    Lunarix.Client._silentModeEnabled = true;
    Lunarix.Client._bringAppToFrontEnabled = false;
    Lunarix.Client._currentPluginVersion = '';
    Lunarix.Client._eventStreamLoggingEnabled = true;

        
        Lunarix.Client._installSuccess = function() {
            if(GoogleAnalyticsEvents){
                GoogleAnalyticsEvents.ViewVirtual('InstallSuccess');
                GoogleAnalyticsEvents.FireEvent(['Plugin','Install Success']);
                if (Lunarix.Client._eventStreamLoggingEnabled && typeof Lunarix.GamePlayEvents != "undefined") {
                    Lunarix.GamePlayEvents.SendInstallSuccess(Lunarix.Client._launchMode, play_placeId);
                }
            }
        }
        
            
        if ((window.chrome || window.safari) && window.location.hash == '#chromeInstall') {
            window.location.hash = '';
            var continuation = '(' + $.cookie('chromeInstall') + ')';
            play_placeId = $.cookie('chromeInstallPlaceId');
            Lunarix.GamePlayEvents.lastContext = $.cookie('chromeInstallLaunchMode');
            $.cookie('chromeInstallPlaceId', null);
            $.cookie('chromeInstallLaunchMode', null);
            $.cookie('chromeInstall', null);
            LunarixLaunch._GoogleAnalyticsCallback = function() { var isInsideLunarixIDE = 'website'; if (Lunarix && Lunarix.Client && Lunarix.Client.isIDE && Lunarix.Client.isIDE()) { isInsideLunarixIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Plugin Location', 'Launch Attempt', isInsideLunarixIDE]);GoogleAnalyticsEvents.FireEvent(['Plugin', 'Launch Attempt', 'Play']);EventTracker.fireEvent('GameLaunchAttempt_Win32', 'GameLaunchAttempt_Win32_Plugin'); if (typeof Lunarix.GamePlayEvents != 'undefined') { Lunarix.GamePlayEvents.SendClientStartAttempt(null, play_placeId); }  }; 
            Lunarix.Client.ResumeTimer(eval(continuation));
        }
        
</script>

<div class="ConfirmationModal modalPopup unifiedModal smallModal" data-modal-handle="confirmation" style="display:none;">
    <a class="genericmodal-close ImageButton closeBtnCircle_20h"></a>
    <div class="Title"></div>
    <div class="GenericModalBody">
        <div class="TopBody">
            <div class="ImageContainer lunarix-item-image" data-image-size="small" data-no-overlays data-no-click>
                <img class="GenericModalImage" alt="generic image" />
            </div>
            <div class="Message"></div>
        </div>
        <div class="ConfirmationModalButtonContainer GenericModalButtonContainer">
            <a href id="lunarix-confirm-btn"><span></span></a>
            <a href id="lunarix-decline-btn"><span></span></a>
        </div>
        <div class="ConfirmationModalFooter">
        
        </div>  
    </div>  
    <script type="text/javascript">
        Lunarix = Lunarix || {};
        Lunarix.Resources = Lunarix.Resources || {};
        
        //<sl:translate>
        Lunarix.Resources.GenericConfirmation = {
            yes: "Yes",
            No: "No",
            Confirm: "Confirm",
            Cancel: "Cancel"
        };
        //</sl:translate>
    </script>
</div>



<script type="text/javascript">
    var Lunarix = Lunarix || {};
    Lunarix.jsConsoleEnabled = false;
</script>





    
    <script type='text/javascript' src='http://js.lunarix.lol/aa490490f6ad512989da8d22ff4063bd.js'></script>


    
<script type='text/javascript' src='http://js.lunarix.lol/10cc00d9523cce67f7bdbbb8805d84e5.js'></script>
            <script type='text/javascript' src='http://js.lunarix.lol/822491cace41a2d39fd76db6cfd17800.js'></script>


    
    <script type='text/javascript'>Lunarix.config.externalResources = [];Lunarix.config.paths['Pages.Catalog'] = 'http://js.lunarix.lol/1612c57544c7977e19cd15c824f7ecc3.js';Lunarix.config.paths['Pages.CatalogShared'] = 'http://js.lunarix.lol/209f2b781ea84e8d0332648ddf547d57.js';Lunarix.config.paths['Pages.Messages'] = 'http://js.lunarix.lol/e8cbac58ab4f0d8d4c707700c9f97630.js';Lunarix.config.paths['Resources.Messages'] = 'http://js.lunarix.lol/fb9cb43a34372a004b06425a1c69c9c4.js';Lunarix.config.paths['Widgets.AvatarImage'] = 'http://js.lunarix.lol/bbaeb48f3312bad4626e00c90746ffc0.js';Lunarix.config.paths['Widgets.DropdownMenu'] = 'http://js.lunarix.lol/7b436bae917789c0b84f40fdebd25d97.js';Lunarix.config.paths['Widgets.GroupImage'] = 'http://js.lunarix.lol/33d82b98045d49ec5a1f635d14cc7010.js';Lunarix.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.lunarix.lol/fbb86cf0752d23f389f983419d3085b4.js';Lunarix.config.paths['Widgets.ItemImage'] = 'http://js.lunarix.lol/8babd891cf420dfe3999b3824a0154cb.js';Lunarix.config.paths['Widgets.PlaceImage'] = 'http://js.lunarix.lol/f2697119678d0851cfaa6c2270a727ed.js';Lunarix.config.paths['Widgets.SurveyModal'] = 'http://js.lunarix.lol/d6e979598c460090eafb6d38231159f6.js';</script>

    
    <script>
        Lunarix.XsrfToken.setToken('AhPgk0fy71wx');
    </script>

        <script>
            $(function () {
                Lunarix.DeveloperConsoleWarning.showWarning();
            });
        </script>
    <script type="text/javascript">
    $(function () {
        Lunarix.JSErrorTracker.initialize({ 'suppressConsoleError': true});
    });
</script>
    

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


    
    

<script type="text/javascript">
    var Lunarix = Lunarix || {};
    Lunarix.UpsellAdModal = Lunarix.UpsellAdModal || {};

    Lunarix.UpsellAdModal.Resources = {
        //<sl:translate>
        title: "Remove Ads Like This",
        body: "Bloxxers Club members do not see external ads like these.",
        accept: "Upgrade Now",
        decline: "No, thanks"
        //</sl:translate>
    };
</script>
