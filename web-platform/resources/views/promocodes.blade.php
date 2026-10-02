@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___23e1cfc4f7f34bdc2ff4f3c2d637a122_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___bf085a0aa25ce4df4c0be2fa1dc7e79a_m.css">
@endpush
@push('js')
<script type='text/javascript' src='https://js.lunarix.lol/8161cad58075fe515dc23ed4c28a654c.js.gzip'></script>
@endpush
@section('content')
@include('layout.header')
    <div id="navContent" class="nav-content
                                 
                                
                                {{ auth()->check() ? 'logged-in' : 'logged-out' }}">
        <div class="nav-content-inner">
            <div id="MasterContainer">
                    <script type="text/javascript">
                        if (top.location != self.location) {
                            top.location = self.location.href;
                        }
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


                <div>
                    @include('layout.body.alert')
                    <div class="alert-container">
                        <noscript>&lt;div class="alert-info"&gt;Please enable Javascript to use all the features on this site.&lt;/div&gt;</noscript>
                    </div>

                                        <div id="BodyWrapper" class="">
                        <div id="RepositionBody">
                            <div id="Body" class="body-width">
                                        <div id="TosAgreementInfo" data-terms-check-needed="False">
                                        </div>

                                
<h1><span>Redeem Lunarix Promotions</span></h1>
<div id="RedeemContainer">
    <div id="Instructions">
        <div class="header">How to Use</div>
        <div class="listitem">Have you received a Lunarix promotional code from one of our many events or give-aways?</div>
        <div class="listitem">This is the place to claim your goods. Enter the promotional code in the section to the right.</div>
        <div class="footnote">Promotional codes may expire, or only be active for a short period of time.</div>
    </div>
    <div style="float:left;">
        <div id="CodeInput">
            <div class="header">Enter Your Code:</div>
            <input id="pin" type="text">
            <span class="btn-primary btn-small" onclick="Lunarix.GameCard.redeemCode()">
                Redeem
            </span>
            <img id="busy" src="https://cdn.lunarix.lol/21e504e643e6c21e0c90e5a1b03325f9.gif" alt="Loading" style="visibility: hidden; display: none;">
        </div>
        <div class="ResultContainer">
            <div id="success" class="ResultSuccessBox" style="display: none;"><img src="https://cdn.lunarix.lol/6acd50d6f06cb4801309f2334d6728ab.png" alt="Success"><span id="SuccessMessage" class="ResultBoxTextAligned"></span></div>
            <div id="error" class="ResultErrorBox" style="display: none;"><img src="https://cdn.lunarix.lol/6acd50d6f06cb4801309f2334d6728ab.png" alt="Success"><span id="errorText" class="ResultBoxTextAligned"></span></div>
        </div>
    </div>
</div>
                                <div style="clear: both"></div>
                            </div>
                        </div>
                    </div>
@include('layout.footerlegacy')
@endsection