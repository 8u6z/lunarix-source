@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___7000c43d73500e63554d81258494fa21_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___7a27dc130118fdc2c185a6a1a3db1c2f_m.css">
@endpush
@push('js')
@endpush
@section('content')
<form name="aspnetForm" method="post" action="/My/Character.aspx" id="aspnetForm" class="nav-container no-gutter-ads">
@csrf
<div>
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="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" />
</div>

<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['aspnetForm'];
if (!theForm) {
    theForm = document.aspnetForm;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
//]]>
</script>


<!--
<script src="/ScriptResource.axd?d=PNxpIlDNxHhNQn8qOu3HPlzJIgROLYl7r-S2vBjZOfnwsFi0I7f5c8cbqCpQFoBqk-PMsxQr12YK88iZ3Zln99R2klscvuI7_3geHZC10UEM_pbL-jX2TFndzF1aWhx5W6x2KxNZC6j8vSGuu6LiB6EaVAsRY8xUxtE1elPTg-fwfpS9Rmmq5Ti1SDnHkC6dmJh5Ya3Ya_3-sHcAOFuU4Edi4wpVSYiUzDp7SVFcRuHpOgCTzsFVGIa50pu28mZVUul-iK5RAckd_BkPeIcySx1TBuhYGdkXhvduLZ2XxrUnRm5Nlo1Zv2ndQz2Qb8us5lZx9gWbo-hp10wSMNxBZuY1gUE2XYt_RJOL8ekvpm5kUVZg9UQ6VSSSJRp6EznSIklBAuA-ukSSw-BMELNxeHOb73N7dk18xwtfp10Tc3UjwCEu0" type="text/javascript"></script>
<script src="/ScriptResource.axd?d=fSWNswqNUC5RkUBTfQmfzk_IzT8z0X1-ZXnjpYVgZuJnS5llRz7w7MOdqnu4lQwpfCCvsBhhqvU-GIMlb0QaZ6ow0tCQULahz6WB6uFsrHkP5c6J0&amp;t=fffffffffa029ff1" type="text/javascript"></script>
-->
<script src="../Thumbs/Asset.asmx/js" type="text/javascript"></script>
<script src="../Thumbs/Avatar.asmx/js" type="text/javascript"></script>
<div>

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="1ECBBB27" />
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="xOmPvfndnEm3JMiMV5tCLHSfECUjMeyrWbkDTol1fEjdGdIazwksiz4E8v4maKOhxOXSQ21c4mu4yJTQwPXma9zrKeQZDgZFsBIhQZIKGq7fU1CFET8X5bcn33zxXubqgrDR7ZyO8gpC8Wv7ZexAg9ePWKD9DC/ukw3frh9hClTGrtPF/J/5+e1lfgPrjF4htDe6AC3B7IyLEar/38lcG4tZFAMtlmlHvfPeGveASm+Zw5bK+8thZDazeVhuhwtdyNrnMRpuHPk/l1MXKjgmCb6na7HcZH6qqi4t+GlU/ZzOWKvEO1JM5F51rpz8wCGCwzcl5bK3zn1pISl5ZOaOMV9G04IbHbZ1DzEoEuy8I8u1RDLkByd4uycgZz1hY/jy4jdb7TlQFp1r0jyYaoWgo9P82wqBWy7wCGavMaUn10xb5c8XRU6Em4m9KsGQ+whk8m6mahmViIseMHSz3pGfK+mtJv2O/HdeS5bD/RTo1/bzoT7Ki+ZbL0q7J2txHcKzRvtXlh7kf5Us1JjRL6aLXqLH3+2v00t2NyWisGflPdqYOvYXyGTapFJSxq0ygt/CbcqiHsP3ZWgne8+HNF7Wfgzv0lEbkSdTMl9L4jo6gOn6LTXISG8vvVCzN6fnJOQMTFK2fSKV6PX/PlBtk5oKhd0XRuo=" />
</div>
    <div id="fb-root">
    </div>
    <script type="text/javascript">
//<![CDATA[
Sys.WebForms.PageRequestManager._initialize('ctl00$ctl00$ScriptManager', 'aspnetForm', ['tctl00$ctl00$cphLunarix$cphMyLunarixContent$CustomizeCharacterUpdatePanelAvatar','','tctl00$ctl00$cphLunarix$cphMyLunarixContent$UpdatePanelBodyColors','','tctl00$ctl00$cphLunarix$cphMyLunarixContent$UpdatePanelWardrobe','','tctl00$ctl00$cphLunarix$cphMyLunarixContent$UpdatePanelAccoutrements',''], [], [], 90, 'ctl00$ctl00');
//]]>
</script>
<script>
var prm = Sys.WebForms.PageRequestManager.getInstance();

prm.add_endRequest(function(sender, args) {
  if (args.get_error()) {
    console.error("Server error during UpdatePanel postback:", args.get_error().message);
    args.set_errorHandled(true); 
  } else {
    console.log("UpdatePanel postback succeeded");
  }
});
</script>     
<script type='text/javascript' src='https://js.lunarix.lol/f49d858ef181e7cd401d8fcb4245e6e8.js.gzip'></script>
<script type='text/javascript'>Lunarix.config.externalResources = [];Lunarix.config.paths['Pages.Catalog'] = 'https://js.lunarix.lol/c1d70e1b98c87fcdb85e894b5881f60c.js.gzip';Lunarix.config.paths['Pages.CatalogShared'] = 'https://js.lunarix.lol/bd76a582ffb966eb0af3f16d61defa7f.js.gzip';Lunarix.config.paths['Pages.Messages'] = 'https://js.lunarix.lol/b123274ceba7c65d8415d28132bb2220.js.gzip';Lunarix.config.paths['Resources.Messages'] = 'https://js.lunarix.lol/6307f9bd9c09fa9d88c76291f3b68fda.js.gzip';Lunarix.config.paths['Widgets.AvatarImage'] = 'https://js.lunarix.lol/64f4ed4d4cf1c0480690bc39cbb05b73.js.gzip';Lunarix.config.paths['Widgets.DropdownMenu'] = 'https://js.lunarix.lol/5cf0eb71249768c86649bbf0c98591b0.js.gzip';Lunarix.config.paths['Widgets.GroupImage'] = 'https://js.lunarix.lol/556af22c86bce192fb12defcd4d2121c.js.gzip';Lunarix.config.paths['Widgets.HierarchicalDropdown'] = 'https://js.lunarix.lol/7689b2fd3f7467640cda2d19e5968409.js.gzip';Lunarix.config.paths['Widgets.ItemImage'] = 'https://js.lunarix.lol/d689e41830fba6bc49155b15a6acd020.js.gzip';Lunarix.config.paths['Widgets.PlaceImage'] = 'https://js.lunarix.lol/45d46dd8e2bd7f10c17b42f76795150d.js.gzip';Lunarix.config.paths['Widgets.SurveyModal'] = 'https://js.lunarix.lol/56ad7af86ee4f8bc82af94269ed50148.js.gzip';</script><script type="text/javascript">
    $(function () {
        Lunarix.JSErrorTracker.initialize({ 'suppressConsoleError': true});
    });
</script><script type='text/javascript' src='https://js.lunarix.lol/8220b4ecd0fe4da790391da3fd0b442c.js.gzip'></script>
<script type='text/javascript' src='https://js.lunarix.lol/59e30cf6dc89b69db06bd17fbf8ca97c.js.gzip'></script>
<script type='text/javascript' src='https://js.lunarix.lol/f3251ed8271ce1271b831073a47b65e3.js.gzip'></script>
<script type='text/javascript' src='https://js.lunarix.lol/11538f50c384b7e98cc9fdd96e55772d.js.gzip'></script>
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



        <script type="text/javascript">Lunarix.FixedUI.gutterAdsEnabled=false;</script>

        

        <div id="Container">
                @include('layout.body.alert')
            
            
        </div>

		
            <div id="AdvertisingLeaderboard">
             <iframe allowtransparency="true"
            frameborder="0"
            height="110"
            scrolling="no"
            src="/userads/1"
            width="728"
            data-js-adtype="iframead"></iframe>



            </div>
        
        
        
        <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
        
        
        
        
        <div id="BodyWrapper">
            
            <div id="RepositionBody">
                <div id="Body" style='width:970px;'>
                    
    
    
    
    <script type="text/javascript">
        Lunarix.Thumbs.Image.prototype._doShowSpinner = Lunarix.Thumbs.Image.prototype._showSpinner;
        Lunarix.Thumbs.Image.prototype._showSpinner = function () {
            if (typeof (this._userID) !== "undefined") {
                this._spinnerUrl = "/images/Spinners/ajax_loader_blue_300.gif";
            }

            this._doShowSpinner();

            if (typeof (this._userID) !== "undefined") {
                this._spinner.style.height = "300px";
                this._spinner.style.width = "300px";
                this._spinner.style.padding = "26px";
                this._spinner.style.backgroundColor = "#fff";
            }
        };
    </script>
	<style type="text/css">
		#Body  /*Needs to be on the Page to override MasterPage #Body */
		{
			padding: 10px;
		}
	</style>
    <div class="MyLunarixContainer">


                <h1>Character Customizer</h1>
                <div class="Column1f left-nav-menu">
                    <h2>
                        <span>Avatar</span>
                    </h2>
                    <div style="height:446px;margin-top: 10px;">
                        <div>
                            

<div id="UserAvatar" class="thumbnail-holder" data-reset-enabled-every-page data-3d-thumbs-enabled 
     data-url="/thumbnail/user-avatar?userId={{ $user->id }}&amp;thumbnailFormatId=124&amp;width=352&amp;height=352" style="width:352px; height:352px;">
    <span class="thumbnail-span" data-3d-url="/avatar-thumbnail-3d/json?userId={{ $user->id }}"  data-js-files='https://js.lunarix.lol/1b5ff54032ecaa6588a0c5f2ad7e1a4c.js' ><img alt="{{ $user->username }}" class="" src="/Thumbs/Avatar.ashx?userId={{ $user->id }}" /></span>
    <span class="enable-three-dee btn-control btn-control-small"></span>
</div>


                        </div> 
                        <div id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_CustomizeCharacterUpdatePanelAvatar">
	
                        <div class="ReDrawAvatar">
                            <span id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_lblInvalidateThumbnails">Something wrong with your Avatar?</span><br />
                            <a id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_cmdInvalidateThumbnails" href="javascript:__doPostBack('InvalidateThumbnails','')">Click here to re-draw it!</a>
                            <a id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_cmdRefreshAllUpdatePanels2" href="javascript:__doPostBack('ctl00$ctl00$cphLunarix$cphMyLunarixContent$cmdRefreshAllUpdatePanels2','')"></a>
                            <script type="text/javascript">
                                var refreshAllUpdatePanels = function() {
                                    __doPostBack("ctl00$ctl00$cphLunarix$cphMyLunarixContent$cmdRefreshAllUpdatePanels2", "");
                                        
                                }
                            </script>
                        </div>
                        
</div>
                    </div>
                    <h2 style="margin-top:20px;">
                        <span>Avatar Colors</span>
                    </h2>
                    <div>
@php
$bodyColorMap = [45 => '#B4D2E4', 1024 => '#AFDDFF', 11 => '#80BBDC', 102 => '#6E99CA', 23 => '#0D69AC', 1010 => '#0000FF', 1012 => '#2154B9', 1011 => '#002060', 1027 => '#9FF3E9', 1018 => '#12EED4', 151 => '#789082', 1022 => '#7F8E64', 135 => '#74869D', 1019 => '#00FFFF', 1013 => '#04AFEC', 107 => '#008F9C', 1028 => '#CCFFCC', 29 => '#A1C48C', 119 => '#A4BD47', 37 => '#4B974B', 1021 => '#3A7D15', 1020 => '#00FF00', 28 => '#287F47', 141 => '#27462D', 1029 => '#FFFFCC', 226 => '#FDEA8D', 1008 => '#C1BE42', 24 => '#F5CD30', 1017 => '#FFAF00', 1009 => '#FFFF00', 1005 => '#FFAF00', 105 => '#E29B40', 1025 => '#FFC9C9', 125 => '#EAB892', 101 => '#DA867A', 1007 => '#A34B4B', 1016 => '#FF66CC', 1032 => '#FF00BF', 1004 => '#FF0000', 21 => '#C4281C', 9 => '#E8BAC8', 1026 => '#B1A7FF', 1006 => '#B480FF', 153 => '#957977', 1023 => '#8C5B9F', 1015 => '#AA00AA', 1031 => '#6225D1', 104 => '#6B327C', 5 => '#D7C59A', 1030 => '#FFCC99', 18 => '#CC8E69', 106 => '#DA8541', 38 => '#A05F35', 1014 => '#AA5500', 217 => '#7C5C46', 192 => '#694028', 1001 => '#F8F8F8', 1 => '#F2F3F3', 208 => '#E5E4DF', 1002 => '#CDCDCD', 194 => '#A3A2A5', 199 => '#635F62', 26 => '#1B2A35', 1003 => '#111111'];
$body = $user->body;
$headColor = $bodyColorMap[$body->headcolor ?? 1] ?? '#F2F3F3';
$torsoColor = $bodyColorMap[$body->torsocolor ?? 1] ?? '#F2F3F3';
$leftArmColor = $bodyColorMap[$body->leftarmcolor ?? 1] ?? '#F2F3F3';
$rightArmColor = $bodyColorMap[$body->rightarmcolor ?? 1] ?? '#F2F3F3';
$leftLegColor = $bodyColorMap[$body->leftlegcolor ?? 1] ?? '#F2F3F3';
$rightLegColor = $bodyColorMap[$body->rightlegcolor ?? 1] ?? '#F2F3F3';
@endphp
                        <div id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_ColorChooser" class="Mannequin">
                            <p>
                                Click a body part to change its color:
                            </p>
                            <div id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_UpdatePanelBodyColors">
	
                            <div id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_ColorChooserFrame" class="ColorChooserFrame" style="height:240px;width:194px;text-align:center;">
		
                                <div style="position: relative; margin: 11px 4px; height: 1%;">
                                    <div style="position: absolute; left: 72px; top: 0px; cursor: pointer" onclick="HeadOpen()">
                                        <div id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_HeadSelector" class="ColorChooserRegion" style="background-color:{{ $headColor }};height:44px;width:44px;">
			
                                        
		</div>
                                    </div>
                                    <div style="position: absolute; left: 0px; top: 52px; cursor: pointer" onclick="RightArmOpen()">
                                        <div id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_RightArmSelector" class="ColorChooserRegion" style="background-color:{{ $rightArmColor }};height:88px;width:40px;">
			
                                        
		</div>
                                    </div>
                                    <div style="position: absolute; left: 48px; top: 52px; cursor: pointer" onclick="TorsoOpen()">
                                        <div id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_TorsoSelector" class="ColorChooserRegion" style="background-color:{{ $torsoColor }};height:88px;width:88px;">
			
                                        
		</div>
                                    </div>
                                    <div style="position: absolute; left: 144px; top: 52px; cursor: pointer" onclick="LeftArmOpen()">
                                        <div id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_LeftArmSelector" class="ColorChooserRegion" style="background-color:{{ $leftArmColor }};height:88px;width:40px;">
			
                                        
		</div>
                                    </div>
                                    <div style="position: absolute; left: 48px; top: 146px; cursor: pointer" onclick="RightLegOpen()">
                                        <div id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_RightLegSelector" class="ColorChooserRegion" style="background-color:{{ $rightLegColor }};height:88px;width:40px;">
			
                                        
		</div>
                                    </div>
                                    <div style="position: absolute; left: 96px; top: 146px; cursor: pointer" onclick="LeftLegOpen()">
                                        <div id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_LeftLegSelector" class="ColorChooserRegion" style="background-color:{{ $leftLegColor }};height:88px;width:40px;">
			
                                        
		</div>
                                    </div>
                                </div>
                            
	</div>
            
                            {{-- say no to bloat --}}
                            @foreach (['RightLeg', 'LeftLeg', 'RightArm', 'LeftArm', 'Head', 'Torso'] as $part)
                            @include('layout.body.partials.cpm', ['part' => $part])
                            @endforeach
                                </div>
                            </div>
                            <script type="text/javascript">
                                var colorPickerModalProperties = { overlayClose: true, escClose: true, opacity: 0, overlayCss: { backgroundColor: "#000"} };

                                RightLegOpen = function () {
                                    $("#PopupRightLeg").modal(colorPickerModalProperties);
                                };

                                LeftLegOpen = function () {
                                    $("#PopupLeftLeg").modal(colorPickerModalProperties);
                                };

                                RightArmOpen = function () {
                                    $("#PopupRightArm").modal(colorPickerModalProperties);
                                };

                                LeftArmOpen = function () {
                                    $("#PopupLeftArm").modal(colorPickerModalProperties);
                                };

                                HeadOpen = function () {
                                    $("#PopupHead").modal(colorPickerModalProperties);
                                };

                                TorsoOpen = function () {
                                    $("#PopupTorso").modal(colorPickerModalProperties);
                                };
                            </script>
                        
</div>
                        </div>
                <div class="Column2f">
                    <div class="tab-container">
	                    <div class="tab-active" data-id="tab-wardrobe">Wardrobe</div>
                        
	                    <div data-id="tab-outfits">Outfits</div>
                        
                    </div>
                    <div>
	                    <div id="tab-wardrobe" class="tab-active">
                        <div style="margin-top: 10px;">
                            <div id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_UpdatePanelWardrobe">
	
                            <div class="CustomizeCharacterContainer">

                            <div class="AttireCategory" style="text-align:center">
                            @php
                            $categories = ['Head' => 'Heads', 'Face' => 'Faces', 'Hat' => 'Hats', 'T-Shirt' => 'T-Shirts', 'Shirt' => 'Shirts', 'Pants' => 'Pants', 'Gear' => 'Gear'];
                            $bodyParts  = ['Torso' => 'Torsos', 'LArm' => 'L Arms', 'RArm' => 'R Arms', 'LLeg' => 'L Legs', 'RLeg' => 'R Legs', 'Package' => 'Packages'];
                            @endphp
                                @foreach ($categories as $key => $label)
                                <a class="AttireCategorySelector{{ $currentCategory === $key ? '_Selected' : '' }}" href="{{ request()->fullUrlWithQuery(['category' => $key, 'inventory_page' => 1]) }}">{{ $label }}</a>
                                @if (!$loop->last) &nbsp;|&nbsp; @endif
                                @endforeach
                                <br />
                                @foreach ($bodyParts as $key => $label)
                                <a class="AttireCategorySelector{{ $currentCategory === $key ? '_Selected' : '' }}" href="{{ request()->fullUrlWithQuery(['category' => $key, 'inventory_page' => 1]) }}">{{ $label }}</a>
                                @if (!$loop->last) &nbsp;|&nbsp; @endif
                                @endforeach
                                <br />
                                <b class="create-or-shop">
                                <a href="/catalog">Shop</a>&nbsp;|&nbsp;<a href="/develop">Create</a>
                                </b>
                              </div>
                                
                                        <div class="AttireContent">
                                            
                                        <div class="TileGroup">
                                        @forelse ($inventory as $item)
												<div class="Asset">
													<div class="AssetThumbnail">
														<a title="click to wear" onclick="__doPostBack('WearAccoutrementButton','{{ $item->asset_id }}')" style="display:inline-block;height:110px;width:110px;cursor:pointer;">
															<img src="/Thumbs/Asset.ashx?assetId={{ $item->asset_id }}" height="110" width="110" border="0" alt="click to wear" />
														</a>
                                                        @if($item->asset?->is_limited_unique)
                                                            <img src="/images/AssetIcons/limitedunique.png" alt="Limited Unique" style="position:absolute;bottom:0;left:0;z-index:2;">
                                                        @elseif($item->asset?->is_limited)
                                                            <img src="/images/AssetIcons/limited.png" alt="Limited" style="position:absolute;bottom:0;left:0;z-index:2;">
                                                        @endif
														<div style="position: absolute;right:-7px;text-align: center;top: 0px;">
															<a title="click to wear" class="btn-small btn-neutral" href="javascript:__doPostBack('WearAccoutrementButton','{{ $item->asset_id }}')">Wear</a>
														</div>
													</div>
													<div class="AssetDetails">
														<div class="AssetName">
@php
$itemName = $item->asset->name ?? 'idk';
$itemSlug = urlencode(str_replace(' ', '-', $itemName));
$itemLink = "/{$itemSlug}-item?id={$item->asset_id}";
@endphp
															 <a id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_AttireListView_ctrl0_ctl00_AssetNameHyperLink" title="click to view" class="notransalate" href="{{ $itemLink }}">{{ $itemName }}</a>
														</div>
													</div>
												</div>
@empty
@endforelse
                                    
                                        </div>
                                    
                                        </div>
                                <div class="FooterPager">
                                    <span id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_AttireDataPager_Footer">
                                    @if ($inventory->onFirstPage())
                                    <a disabled="disabled">First</a>&nbsp;<a disabled="disabled">Previous</a>
                                    @else
                                    <a href="{{ $inventory->url(1) }}">First</a>&nbsp;<a href="{{ $inventory->previousPageUrl() }}">Previous</a>
                                    @endif
                                    &nbsp;
                                    @foreach (range(1, $inventory->lastPage()) as $page)
                                    @if ($page === $inventory->currentPage())
                                    <a href="javascript:__doPostBack('ctl00$ctl00$cphLunarix$cphMyLunarixContent$AttireDataPager_Footer$ctl01$ctl01','')">{{ $page }}</a>
                                    @endif
                                    &nbsp;
                                    @endforeach
                                    @if ($inventory->hasMorePages())
                                    <a href="{{ $inventory->nextPageUrl() }}">Next</a>&nbsp;<a href="{{ $inventory->url($inventory->lastPage()) }}">Last</a>&nbsp;
                                    @else
                                    <a disabled="disabled">Next</a>&nbsp;<a disabled="disabled">Last</a>
                                    @endif
                                 </span>
                                </div>
                            </div>
                            
</div>
                        </div>
                        </div>
                        
                            <div id="tab-outfits">
                                <div class="validation-summary-valid" data-valmsg-summary="true"><ul><li style="display:none"></li>
</ul></div><input name="__RequestVerificationToken" type="hidden" value="jmZGuE-LqIWXNuPAEGDdkJg9o55btdlBJ0-wGiaSdZaX-QJ07k7j5VnHT2VtuI4eeMKBc0gfJaaXe5_JiPjkpJkAz1wlLWrZaYAUv4_8gWVefsHU0" />
<div id="OutfitsTab" data-isiosapp="false" class="outfits-tab">


    <div class="outfits-banner">
        <div class="outfits-banner-left">
                <h2>Make some outfits!</h2>
                                    <div id="outfits-error" class="outfits-error status-error"></div>
        </div>
        <div class="outfits-banner-right">
            <div id="CreateNewOutfitContainer">
                <a id="CreateNewOutfit" class="text-link ">
                    <span class="btn-control btn-control-large">Create New Outfit</span>
                </a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    //<sl:translate>
        if (typeof Lunarix === "undefined") {
            Lunarix = {};
        }
        if (typeof Lunarix.Outfits === "undefined") {
            Lunarix.Outfits = {};
        }
        Lunarix.Outfits.Resources = {
            createTitle: "Create New Outfit",
            createText: "An outfit will be created from your character's current appearance.",
            createConfirm: "Create",
            createCancel: "Cancel",
            outfitNameTextBoxLabel: "Name: ",
            deleteTitle: "Delete Outfit",
            deleteText: "Are you sure you want to delete this outfit?",
	        deleteConfirm: "Delete",
            deleteCancel: "Cancel",
	        updateTitle: "Update Outfit",
	        updateText: "Do you want to update this outfit? This will overwrite the outfit with your character's current appearance.",
	        updateConfirm: "Update Outfit",
	        updateCancel: "Cancel",
	        renameTitle: "Rename Outfit",
	        renameText: "Choose a new name for your outfit.",
	        renameConfirm: "Rename",
            renameCancel: "Cancel"
            }
    //</sl:translate>
    </script>
    <div class="outfits-container">
    </div>
    <div class="outfits-pager">
    </div>
    <div id="ProcessingView" style="display:none">
	    <div class="ProcessingModalBody">
		    <p class="processing-indicator"><img src='/lrxcdn_img/ec4e85b0c4396cf753a06fade0a8d8af.gif' alt="Processing..." /></p>
		    <p class="processing-text">Processing...</p>
	    </div>
    </div>


</div>
                            </div>
                        


                   </div>
                    <script type="text/javascript">
                        function switchTabs(nextTabElem) {
                            var currentTab = $('.tab-container div.tab.active');
                            currentTab.removeClass('active');
                            $('#' + currentTab.data('id')).hide();
                            nextTabElem.addClass('active');
                            $('#' + nextTabElem.data('id')).show();
                        }
                        $('div.tab').bind('click', function () {
                            switchTabs($(this));
                        });
                    </script>

                    <div class="divider-top" style="margin-top: 10px; padding-left: 20px;position: relative;left: -20px;"></div>
                    <h2 style="margin-top: 20px;">
                        <span>Currently Wearing</span>
                    </h2>
                    <div style="margin-top: 10px;">
                        <div id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_UpdatePanelAccoutrements">
	
                        <div id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_AccoutrementsPane" class="CustomizeCharacterContainer">
                            
                                    
                                    <div class="TileGroup">
                                    @forelse ($wornAssets as $asset)
                                    @php
                                    $assetId = $asset->id;
                                    $name = $asset->name;
                                    $urlName = urlencode(str_replace(' ', '-', $name));
                                    $link = "/{$urlName}-item?id={$assetId}";
                                    $thumbUrl = "/Thumbs/Asset.ashx?assetId={$assetId}";
                                    @endphp
                                    <div class="Asset">
                                        <div class="AssetThumbnail">
                                            <a id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_AccoutrementsListView_ctrl0_ctl00_AssetThumbnailHyperLink" title="click to remove" onclick="__doPostBack('ctl00$ctl00$cphLunarix$cphMyLunarixContent$AccoutrementsListView$ctrl0$ctl00$AssetThumbnailHyperLink','{{ $assetId }}')" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="{{ $thumbUrl }}" height="110" width="110" border="0" alt="click to remove" /></a>
                                        @if($asset->is_limited_unique)
                                            <img src="/images/AssetIcons/limitedunique.png" alt="Limited Unique" style="position:absolute;bottom:0;left:0;z-index:2;">
                                        @elseif($asset->is_limited)
                                            <img src="/images/AssetIcons/limited.png" alt="Limited" style="position:absolute;bottom:0;left:0;z-index:2;">
                                        @endif
                                        <div style="position: absolute;right:-7px;text-align: center;top: 0;">
                                            <a id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_AccoutrementsListView_ctrl0_ctl00_RemoveAccoutrementButton" title="click to remove" class="btn-small btn-neutral" href="javascript:__doPostBack('RemoveAccoutrementButton','{{ $assetId }}')">    
                                                Remove
                                            </a>
                                            
                                            </div>
                                        </div>
                                        <div class="AssetDetails">
                                            <div class="AssetName">
                                                <a id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_AccoutrementsListView_ctrl0_ctl00_AssetNameHyperLink" title="click to view" class="notranslate" href="{{ $link }}">{{ $name }}</a>
                                            </div>
                                            <div class="AssetType">
                                                <span class="Label">Type: </span> <span class="Detail">{{ $asset->getTypeName() }}</span>
                                            </div>
                                        </div>
                                    </div>
					@empty
					@endforelse
                                    </div>
                                
                                
                            <div class="FooterPager">
                            @if ($wornAssets->onFirstPage())
                            <span id="ctl00_ctl00_cphLunarix_cphMyLunarixContent_AccoutrementsDataPager_Footer"><a disabled="disabled">First</a>&nbsp;<a disabled="disabled">Previous</a>
                            @else
                            <a href="{{ $wornAssets->url(1) }}">First</a>&nbsp;<a href="{{ $wornAssets->previousPageUrl() }}">Previous</a>
                            @endif
                            &nbsp;
@foreach (range(1, $wornAssets->lastPage()) as $page)
@if ($page === $wornAssets->currentPage())
<a href="javascript:__doPostBack('ctl00$ctl00$cphLunarix$cphMyLunarixContent$AccoutrementsDataPager_Footer$ctl01$ctl01','')">{{ $page }}</a>@endif &nbsp; @endforeach
@if ($wornAssets->hasMorePages())
<a href="javascript:__doPostBack('ctl00$ctl00$cphLunarix$cphMyLunarixContent$AccoutrementsDataPager_Footer$ctl02$ctl00','')">Next</a>&nbsp;<a href="javascript:__doPostBack('ctl00$ctl00$cphLunarix$cphMyLunarixContent$AccoutrementsDataPager_Footer$ctl02$ctl01','')">Last</a>&nbsp;@else
<a disabled="disabled">Next</a>&nbsp;<a disabled="disabled">Last</a> @endif</span>
                            </div>
                        </div>
                        
</div>
                    </div>
            </div>
    <br clear="all" />
    </div>
	                    </div>
						                    </div>

    
    

                    <div style="clear:both"></div>
                </div>
            </div>
        </div> 
        </div>
</form>
@include('layout.footerlegacy')
@endsection
