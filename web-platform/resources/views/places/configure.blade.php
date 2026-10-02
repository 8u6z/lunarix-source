@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___23e1cfc4f7f34bdc2ff4f3c2d637a122_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___335c7b8a45e52c280387f93bc1a3a19c_m.css">
@endpush
@push('js')
<script src="https://js.lunarix.lol/c6b47ce9ee4cd0423d35c985917d2b4e.js"></script>
<script src="/js/ConfigurePlace.js"></script>
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

        <script type="text/javascript">Lunarix.FixedUI.gutterAdsEnabled=false;</script>

        <div id="Container"></div>

        @include('layout.body.alert')
        <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
<div id="BodyWrapper">
    <div id="RepositionBody">
        <div id="Body" style='width:970px;'>
            <div>
                <div id="PlaceConfigureData" data-place-id="{{ $place->id }}" style="display:none;"></div>
                <h1>Configure place</h1>
            <div id="CreateTabs" class="tab-container">
                    <div id="BasicSettingsTab"  class="tab-active">Basic Settings</div>
                    <div id="AccessTab">Access</div>
                    <div id="ExtrasTab" >Extras</div>
                    <div id="UploadTab" >Upload</div>
                    <div id="ThumbnailTab" >Thumbnail</div>
                </div>
                <div>
                    <div id="BasicSettings" class="tab-active">
                    <div style="display:flex; flex-direction:row; gap:16px; align-items:flex-start;">
                        <form id="ConfigureForm" style="display:flex;flex-direction:column;gap:6px;">
                            <label>Name:</label>
                            <input type="text" name="name" value="{{ $place->name }}" style="width: 400px;">
                            <label>Description:</label>
                            <textarea name="description" style="width: 400px; height: 100px;">{{ $place->description }}</textarea>
                        </form>
                        <div style="width: 150px;">
                            <img title="{{ $place->name }}" class="" height="182" src="/Thumbs/Asset.ashx?assetId={{ $place->id }}" style="border: 1px solid #858585;">
                        </div>
                    </div>
                    </div>
                    <div id="Access">
                        <div id="playerAccess" class="default-hidden" style="display: block;">
                        <div class="headline" style="margin-bottom:10px;">
                        <h2>Access</h2>
                        </div>
                        <div style="display:flex;flex-direction:column;gap:6px;">
                        <div id="options" style="display:flex;flex-direction:column;gap:8px;margin-top:15px;">
                            <label class="form-label" for="NumPlayers">Number of Players:</label>
                            <select class="form-select" id="NumPlayers" name="NumPlayers" style="margin:0;height:20px;width:100px;">
                                @for ($i = 1; $i <= 50; $i++)
                                <option {{ $place->max_players == $i ? 'selected="selected"' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <label class="form-label" for="AccessSelect">Access:</label>
                            <select class="form-select" id="AccessSelect" name="Access" style="margin:0;height:20px;width:100px;">
                                <option value="1" {{ $place->access == 1 ? 'selected="selected"' : '' }}>Everyone</option>
                                <option value="2" {{ $place->access == 2 ? 'selected="selected"' : '' }}>Friends</option>
                                <option value="0" {{ $place->access == 0 ? 'selected="selected"' : '' }}>No One</option>
                            </select>
                            <img class="TipsyImg tooltip-bottom h2-tooltip place-access-tooltip" src="/images/65cb6e4009a00247ca02800047aafb87.png" data-toggle="tooltip" alt="To restrict who may access this place, first you must disable private servers and not sell experience access." data-original-title="To restrict who may access this place, first you must disable private servers and not sell experience access." original-title="" style="display: none;">
                            <span class="field-validation-valid" data-valmsg-for="Access" data-valmsg-replace="true"></span>
                            <div style="clear:both;"></div>
                        </div>
                        </div>
                        </div>
                    </div>
                    <div id="Extras">
                        <div class="headline">
                        <h2 style="margin-bottom:5px;">Other Permissions</h2>
                        <div style="margin-top:15px;display:flex;flex-direction:column;gap:5px;">
                        <label style="margin-left:8px;"><input type="checkbox" name="commentscheckbox" id="CommentsCheckbox" {{ $place->can_comment ? 'checked' : '' }}>Comments Enabled</label>
                        </div>
                        </div>
                        </div>
                    <div id="Upload">
                        <div class="headline">
                        <h2 style="margin-bottom:5px;">Upload</h2>
                        <div style="margin-top:15px;display:flex;flex-direction:column;gap:5px;">
    			<div class="col-12">
        		<div class="ms-4 me-4 mt-4">
            		<p>Find your .lrxl: <input name="placeItem" accept="lrxl" id="itemPlace" type="file"></p>
        		</div>
    			</div>
                        </div>
                        </div>
                        </div>
                    <div id="Thumbnail">
                        <div class="headline">
                        <h2 style="margin-bottom:5px;">Thumbnail</h2>
                        <div style="margin-top:15px;display:flex;flex-direction:column;gap:5px;">
    			<div class="col-12">
        		<div class="ms-4 me-4 mt-4">
                        <p>It's too janky but i'll work on it -sukaira</p>
            		<p>Large Thumbnail: <input name="thumbnail_large" accept="image/png" id="itemThumbnailLarge" type="file"></p>
            		<p>Square Thumbnail: <input name="thumbnail_square" accept="image/png" id="itemThumbnailSquare" type="file"></p>
        		</div>
    			</div>
                        </div>
                        </div>
                        </div>
                        <a id="ConfigurePlaceSubmit" class="btn-medium btn-neutral" style="float:left;margin-left: 15px;">Save</a>
                        <a class="btn-medium btn-negative" href="/develop?View=9" style="margin-left: 15px;">Cancel</a>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>
</div>
        <div id="ProcessingView" class="ProcessingView" style="display:none">
            <div class="ProcessingModalBody">
                <p style="margin:0px"><img src='https://cdn.lunarix.lol/ec4e85b0c4396cf753a06fade0a8d8af.gif' alt="Processing..." /></p>
                <p style="margin:7px 0px">Saving Place...</p>
            </div>
        </div>
@include('layout.footerlegacy')
@endsection