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
            <div>
                <h1>Report Abuse</h1><br>
                <div style="margin-left:75px;">
                <div style="white-space:pre-line;margin-bottom:12px;">
                <h2>Tell us how you think {{ $targetName }} is breaking the rules of Lunarix.</h2>
                </div>
                <form method="POST" action="/abusereport/{{ $subject }}?id={{ $targetId }}&redirectUrl={{ urlencode($redirectUrl) }}" style="display:flex;flex-direction:column;gap:12px;">
                @csrf
                        <input type="hidden" name="target_id" value="{{ $targetId }}">
                        <input type="hidden" name="redirectUrl" value="{{ $redirectUrl }}">
                        <div>
                            <label for="reportType">Subject:</label>
                            <select id="reportType" name="report_type" required>
                                @foreach($reportTypes as $type)
                                    <option value="{{ $type }}" @selected(old('report_type') === $type)>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="display:flex;gap:4px;">
                            <label for="reportComment">Comment:</label>
                            <textarea id="reportComment" name="comment" rows="6" cols="60" maxlength="1000">{{ old('comment') }}</textarea>
                        </div>
                        <div>
                            <button class="btn-medium btn-primary">Submit Report</button>
                        </div>
                </form>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>
</div>
@include('layout.footerlegacy')
@endsection