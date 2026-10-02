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
        <h1>Create a User Ad</h1><br>
        <h2>Instructions</h2>
        <div style="display:flex;flex-direction:column;">
        <p id="adUploadErrorWrap" style="display:none;margin:0;margin-top:12px;margin-bottom:12px;"><span class="status-error" id="adUploadError"></span></p>
        <label>On Lunarix, users can bid an amount of Bytes to buy advertising for their places, groups, clothing and models.</label>
        <p style="margin:0;margin-top:12px;">Download, Edit and upload one of the following templates:</p>
        </div>
        <p>• 728 x 90 Banner <a href="/img/ads/templates/banner.png" style="margin-left:29px;" class="btn-small btn-neutral">Download</a></p>
        <p>• 160 x 600 Skyscraper <a href="/img/ads/templates/skyscraper.png" class="btn-small btn-neutral">Download</a></p>
        <p>• 300 x 250 Rectangle <a href="/img/ads/templates/rectangle.png" style="margin-left:7px;" class="btn-small btn-neutral">Download</a></p>
        <div style="display:flex;flex-direction:column;">
        <p style="margin:0;margin-top:12px;"><b>Upload an Ad</b> <input style="margin-left:28px;" name="adItem" accept="png" id="itemImage" type="file"></p>
        <p style="margin:0;margin-bottom:12px;margin-top:12px;"><b>Name Your Ad</b> <input style="margin-left:28px;" id="itemName" type="text"></p>
        </div>
        <input id="adUploadBtn" type="button" value="Upload" class="btn-large translate btn-primary" style="height:50px;margin-bottom:3px;" />
        <div class="footnote">The ad needs to be approved by a Moderator before it can be launched from your <a href="/develop?View=userads">Ad</a> page.</div>
    </div>

                    <div style="clear:both"></div>
                </div>
            </div>
        </div>
<script type="text/javascript">
document.getElementById('adUploadBtn')?.addEventListener('click', function() {
    var errorWrap = document.getElementById('adUploadErrorWrap');
    var errorEl = document.getElementById('adUploadError');
    errorEl.textContent = '';
    errorWrap.style.display = 'none';
    var params = new URLSearchParams(window.location.search);
    var targetID = params.get('targetID');
    var fileInput = document.getElementById('itemImage');
    var nameInput = document.getElementById('itemName');
    function showError(msg) {
        errorEl.textContent = msg;
        errorWrap.style.display = '';
    }
    if (!targetID) {
        showError('Missing target ID.');
        return;
    }
    if (!fileInput.files[0]) {
        showError('Please choose an image to upload.');
        return;
    }
    if (!nameInput.value.trim()) {
        showError('Please name your ad.');
        return;
    }
    this.disabled = true;
    var formData = new FormData();
    formData.append('targetID', targetID);
    formData.append('adItem', fileInput.files[0]);
    formData.append('itemName', nameInput.value.trim());
    var self = this;
    fetch('/My/NewUserAd.ashx', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success === true) {
            window.location.href = '/develop?View=userads';
        } else {
            showError(data.message || 'Upload failed.');
            self.disabled = false;
        }
    });
});
</script>
@include('layout.footerlegacy')
@endsection