@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___23e1cfc4f7f34bdc2ff4f3c2d637a122_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___335c7b8a45e52c280387f93bc1a3a19c_m.css">
@endpush
@push('js')
<script src="https://js.lunarix.lol/c6b47ce9ee4cd0423d35c985917d2b4e.js"></script>
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

        

        <div id="Container">
            
            
        </div>
        
        @include('layout.body.alert')
        <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
<div id="BodyWrapper">
    <div id="RepositionBody">
        <div id="Body" style='width:970px;'>
    <div style="margin: 10px auto 10px auto; width: 500px; border: black thin solid; padding: 22px;">
        <h2>BC Eligibility</h2>
        <div id="BCEligibilityStuff">
        <p>Bloxxers Club isn't like any other membership but is rather skill based, you'll need to complete the tasks below to get it.</p>
        @if(!$eligible && empty($checks))
        <p style="color:red;">You've already redeemed Bloxxers Club or you may have a higher tier of it currently.</p>
        @else
        <div style="display:flex;flex-direction:column;margin:12px;">
        <label style="color:{{ $checks['knockouts'] ? 'green' : 'red' }};">• Get 50 Knockouts</label>
        <label style="color:{{ $checks['account_age'] ? 'green' : 'red' }};">• Account must be a week old</label>
        <label style="color:{{ $checks['friends'] ? 'green' : 'red' }};">• Friend 3 people</label>
        <label style="color:{{ $checks['no_recent_punishment'] ? 'green' : 'red' }};">• Must not have received an account punishment for over 2 weeks</label>
        </div>
        <p>Please note that you are agreeing to our <a href="/info/terms-of-service">Terms of Service</a> when redeeming Bloxxers Club.</p>
        <input type="button" value="Redeem" class="btn-large translate {{ $eligible ? 'btn-neutral' : 'btn-disabled-neutral' }}" style="height:50px;" @if(!$eligible) disabled @endif />
        @endif
        </div>
    </div>

                    <div style="clear:both"></div>
                </div>
            </div>
        </div>
<script type="text/javascript">
document.querySelector('input[value="Redeem"]')?.addEventListener('click', function() {
    this.disabled = true;
    this.classList.remove('btn-neutral');
    this.classList.add('btn-disabled-neutral');
    fetch('/Upgrades/BCEligibility.ashx', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success === true) {
            document.getElementById('BCEligibilityStuff').innerHTML = '<p style="color:green">You\'ve successfully redeemed Bloxxers Club, it may take a bit just for it to be added onto your account!</p>';
        }
    });
});
</script>
@include('layout.footerlegacy')
@endsection