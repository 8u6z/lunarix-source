@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___7000c43d73500e63554d81258494fa21_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=leanbase___f9e2a82b042c4b4f945b16e30fb19e87_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___52ecb4339a49a1b9212e1c6894fd0ca0_m.css">
@endpush
@push('js')
<script type='text/javascript' src='http://js.lunarix.lol/f49d858ef181e7cd401d8fcb4245e6e8.js.gzip'></script>
<script type='text/javascript' src='http://js.lunarix.lol/6d2c5d08317da59677c25876e4f7f6a0.js.gzip'></script>
@endpush
@section('content')
@include('layout.header')
    <div id="navContent" style="background-color:#fff;" class="nav-content  ">
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
        <div id="Body" style='width:970px; padding:10px;'>
            <h1>Send New Message</h1>
            <br />
            <div id="errortextbox" class="status-error lunarix-message-error" style="width:745px;word-wrap:break-word;display:none;"></div>
            <span class="form-label" style="float:left;font-weight: 800;">From: <a class="text-link" style="margin-left:42px;">{{ $currentUser->username }}</a></span><br />
            <span class="form-label" style="float:left;font-weight: 800;">To: <a class="text-link" style="margin-left:59px;">{{ $recipient->username }}</a></span><br />
            <div style="min-height: 30px;">
                <span class="font-header-2" style="float:left;padding-top:5px;margin-right:23px;font-weight: 800;">Subject:</span>
                <div style="float: left; width: 183px; text-align:left;">
                    <input type="text" name="subject" class="text-box text-box-large" style="width: 660px;" />
                </div>
            </div>
            <div style="min-height: 30px;">
                <span class="form-label" style="float:left;padding-top:5px;margin-right:46px;font-weight: 800;">Body: </span>
                <div style="float: left; width: 660px; text-align:left;">
                    <textarea class="text-box text-area-medium" cols="80" id="textbox" name="body" rows="15" style="width: 660px;"></textarea>
                    <p style="margin-left: 0px;"><span style="color: #E04A32; float: left; width: 660px;"><i>Remember, Lunarix Staff will never ask for your password. People who ask for your password are trying to steal your account.</i></span></p>
                </div>
            </div>
            <div style="clear:both; margin-top: 15px;">
                <a class="lrx-btn-secondary-xs" style="float:right;margin-right:210px;" onclick="sendMessage()">Send</a>
            </div>
        </div>
    </div>
</div>
<script>
function sendMessage() {
    const subject = document.querySelector('input[name="subject"]').value;
    const body = document.querySelector('textarea[name="body"]').value;
    if (!subject || !body) {
        showError('Please fill in all fields.');
        return;
    }
    fetch('/messages/api/send-message', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({
            recipientId: {{ $recipient->id }},
            subject: subject,
            body: body
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.href = '/my/messages/#!/inbox';
        } else {
            showError(data.error ?? 'Failed to send message.');
        }
    })
    .catch(() => {
        showError('Something went wrong. Please try again.');
    });
}
function showError(message) {
    const box = document.getElementById('errortextbox');
    box.textContent = message;
    box.style.display = 'block';
}
</script>
@endsection
