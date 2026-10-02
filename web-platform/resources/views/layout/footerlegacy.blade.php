@php
    $legacyFooterHost = config('app.base_url_nohttp');
@endphp

<div id="Footer" class="footer-container">
    <div class="FooterNav">
        <a href="/info/Privacy.aspx">Privacy Policy</a>
        &nbsp;|&nbsp;
        <a href="http://{{ $legacyFooterHost }}/about" class="lunarix-interstitial">About us</a>
        &nbsp;|&nbsp;
        <a href="http://blog.{{ $legacyFooterHost }}" class="lunarix-interstitial">Contact Us</a>
    </div>
    <div class="legal">
        <p class="Legalese">
            Lunarix, "Be Anything, Build Anything" is an independent community-made platform made by <a target="_blank" href="#" class="lrx-link lunarix-interstitial">Sukaira's Fridge</a>. Lunarix is not sponsored, authorized or endorsed by corporations or companies in any way, shape or form. Use of this site signifies your acceptance of the <a href="/info/terms-of-service" target="_blank" class="lrx-link">Terms and Conditions</a>.
        </p>
        <div class="clear"></div>
    </div>
</div>

        </div>
    </div>
</div>

    <script type="text/javascript">
        function urchinTracker() {}
        GoogleAnalyticsReplaceUrchinWithGAJS = true;
    </script>

<script type="text/javascript">
//<![CDATA[
$(function() { LunarixEventManager.triggerEvent('lrx_evt_newuser', {}); });//]]>
</script>
</form>

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

<script type="text/javascript">
    Lunarix.Client._skip = null;
    Lunarix.Client._CLSID = '76D50904-6780-4c8b-8986-1A7EE0B1716D';
    Lunarix.Client._installHost = 'setup.lunarix.lol';
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

<div id="PlaceLauncherStatusPanel" style="display:none;width:300px"
     data-new-plugin-events-enabled="True"
     data-event-stream-for-plugin-enabled="True"
     data-event-stream-for-protocol-enabled="True"
     data-is-protocol-handler-launch-enabled="True"
     data-is-user-logged-in="False"
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
            <img src="/images/Logo/logo_meatball.svg" width="90" height="90" alt="R" />
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
            <img src="/images/Logo/logo_meatball.svg" width="90" height="90" alt="R" />
        </div>
        <div class="ph-areyouinstalleddialog-content">
            <p class="larger-font-size">
                You're moments away from getting into the game!
            </p>
            <div>
                <button type="button" class="btn lrx-btn-primary-sm" id="ProtocolHandlerInstallButton">
                    Download and Install LUNARIX
                </button>
            </div>
            <div class="lrx-small lrx-text-notes">
                <a href="https://en.help.lunarix.lol/hc/en-us/articles/204473560" class="lrx-link" target="_blank">Click here for help</a>
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
            Gameplay sponsored by:
        </div>
        <div id="videoPrerollMainDiv"></div>
        <div id="videoPrerollCompanionAd"></div>
        <div id="videoPrerollLoadingDiv">
            Loading <span id="videoPrerollLoadingPercent">0%</span> - <span id="videoPrerollMadStatus" class="MadStatusField">Starting game...</span><span id="videoPrerollMadStatusBackBuffer" class="MadStatusBackBuffer"></span>
            <div id="videoPrerollLoadingBar">
                <div id="videoPrerollLoadingBarCompleted">
                </div>
            </div>
        </div>
        <div id="videoPrerollJoinBC">
            <span>Get more with Bloxxers Club!</span>
            <a href="/Upgrades/BloxxersClubMemberships.aspx?ctx=preroll" target="_blank" class="btn-medium btn-primary" id="videoPrerollJoinBCButton">Join Bloxxers Club</a>
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
        Choose Your Character
    </div>
    <div style="min-height: 275px; background-color: white;">
        <div style="clear:both; height:25px;"></div>

        <div style="text-align: center;">
            <div class="VisitButtonsGuestCharacter VisitButtonBoyGuest" style="float:left; margin-left:45px;"></div>
            <div class="VisitButtonsGuestCharacter VisitButtonGirlGuest" style="float:right; margin-right:45px;"></div>
        </div>
        <div style="clear:both; height:25px;"></div>
        <div class="RevisedFooter">
            <div style="width:200px;margin:10px auto 0 auto;">
                <a href="/?returnUrl=%2Fcatalog%2FDefault.aspx"><div class="RevisedCharacterSelectSignup"></div></a>
                <a class="HaveAccount" href="/newlogin?returnUrl=%2Fcatalog%2FDefault.aspx">I have an account</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function checkLunarixInstall() {
             return LunarixLaunch.CheckLunarixInstall('/install/download.aspx');
    }

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

<div class="ConfirmationModal modalPopup unifiedModal smallModal" data-modal-handle="confirmation" style="display:none;">
    <a class="genericmodal-close ImageButton closeBtnCircle_20h"></a>
    <div class="Title"></div>
    <div class="GenericModalBody">
        <div class="TopBody">
            <div class="ImageContainer lunarix-item-image"  data-image-size="small" data-no-overlays data-no-click>
                <img class="GenericModalImage" alt="generic image" />
            </div>
            <div class="Message"></div>
        </div>
        <div class="ConfirmationModalButtonContainer">
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
        <script>
            $(function () {
                Lunarix.DeveloperConsoleWarning.showWarning();
            });
        </script>
    
