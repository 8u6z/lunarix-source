@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___23e1cfc4f7f34bdc2ff4f3c2d637a122_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___335c7b8a45e52c280387f93bc1a3a19c_m.css">
@endpush
@push('js')
<script src="https://js.lunarix.lol/c6b47ce9ee4cd0423d35c985917d2b4e.js"></script>
<script src="/js/ConfigureAsset.js"></script>
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
                <div id="ItemConfigureData" data-asset-id="{{ $asset->id }}" data-fee-percent="{{ $feePercent }}" style="display:none;"></div>
                <h1>Configure {{ $asset->name }}</h1>
            <div id="CreateTabs" class="tab-container">
                    <div id="ConfigureTab"  class="tab-active">Configure</div>
                    <div id="SellTab">Sell</div>
                    <div id="ExtrasTab" >Extras</div>
                </div>
                <div>
                    <div id="Configure" class="tab-active">
                    <div style="display:flex; flex-direction:row; gap:16px; align-items:flex-start;">
                        <form id="ConfigureForm" style="display:flex;flex-direction:column;gap:6px;">
                            <label>Name:</label>
                            <input type="text" name="name" value="{{ $asset->name }}" style="width: 400px;">
                            <label>Description:</label>
                            <textarea name="description" style="width: 400px; height: 100px;">{{ $asset->description }}</textarea>
                        </form>
                        <div style="width: 150px;">
                            <img title="{{ $asset->name }}" class="" height="182" src="/Thumbs/Asset.ashx?assetId={{ $asset->id }}" style="border: 1px solid #858585;">
                        </div>
                    </div>
                    </div>
                    <div id="Sell">
                        <div id="playerAccess" style="display: block;">
                        <div style="display:flex;flex-direction:column;gap:6px;">
                        <label>Check the box and enter a price if you want to sell this item in the Lunarix catalog. Uncheck the box to remove the item from the catalog.</label>
                        <label style="margin-left:8px;"><input type="checkbox" name="sellcheckbox" id="SellCheckbox" {{ $asset->onsale ? 'checked' : '' }}>Sell this Item</label>
                        <div id="SellDetails" style="display:{{ $asset->onsale ? 'flex' : 'none' }};flex-direction:column;gap:15px;">
                        <label style="margin-left:8px;">Price: <span class="robux notranslate"><input type="text" id="PriceInput" name="price" value="{{ $price }}" style="width: 75px;"></span>
                        </label>
                        <div style="display:flex;flex-direction:column;gap:0px;">
                        <label style="margin-left:8px;">Marketplace Fee: <span class="robux notranslate" id="FeeDisplay">{{ $marketplaceFee }}</span></label>
                        <label style="margin-left:8px;">(Fee Percent: {{ $feePercent }}%)</label>
                        </div>
                        <label style="margin-left:8px;">You Earn: <span class="robux notranslate" id="EarnDisplay">{{ $sellerEarnings }}</span></label>
                        </div>
                        </div>
                        </div>
                    </div>
                    <div id="Extras">
                        <div class="headline">
                        <h2 style="margin-bottom:5px;">Turn Comments on/off</h2>
                        <li class="lrx-divider"></li>
                        <div style="margin-top:15px;display:flex;flex-direction:column;gap:5px;">
                        <label>Choose whether or not this item is open for comments.</label>
                        <label style="margin-left:8px;"><input type="checkbox" name="commentscheckbox" id="CommentsCheckbox" {{ $asset->can_comment ? 'checked' : '' }}>Allow Comments</label>
                        </div>
                        </div>
                        </div>
                        <a id="CreatePlaceSubmit" class="btn-medium btn-neutral" style="float:left;margin-left: 15px;">Save</a>
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
                <p style="margin:7px 0px">Configuring Asset...</p>
            </div>
        </div>
@include('layout.footerlegacy')
@endsection