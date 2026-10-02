@extends('layout.root')

@push('css')
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___d7f658c4695ed776947e7d072c17ef0f_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___bf085a0aa25ce4df4c0be2fa1dc7e79a_m.css">
@endpush

@php
    $code = (int) ($code ?? request('code', 500));
    $ref = $ref ?? request('ref');

    $error = match ($code) {
        403 => [
            'image' => 'https://cdn.lunarix.lol/05636e8bda24cdc11428e091e386605c.png',
            'title' => 'Access Denied',
            'message' => "Sorry, you don't have permission to view this page!",
            'support' => 'If you continue to receive this page, please contact the developers.',
        ],
        404 => [
            'image' => '/images/4bd2ab534d227b98097ab7730f61f49a.png',
            'title' => 'Requested page not found',
            'message' => 'You may have clicked an expired link or mistyped the address.',
            'support' => '',
        ],
        default => [
            'image' => 'https://cdn.lunarix.lol/b47ba5565699c01cb4521af3f339b36b.png',
            'title' => 'Unexpected error with your request',
            'message' => 'Please try again after a few moments.',
            'support' => 'If you continue to receive this page, please contact the developers.',
        ],
    };
@endphp

@push('js')
    <script type="text/javascript">
        $(function () {
            function trackReturns() {
                function dayDiff(d1, d2) {
                    return Math.floor((d1 - d2) / 86400000);
                }

                if (!localStorage) {
                    return false;
                }

                var cookieName = 'RBXReturn';
                var cookie = {};

                try {
                    cookie = JSON.parse(localStorage.getItem(cookieName) || '{}');
                } catch (ex) {
                    cookie = {};
                }

                if (typeof cookie.ts === 'undefined' || isNaN(new Date(cookie.ts))) {
                    localStorage.setItem(cookieName, JSON.stringify({ ts: new Date().toDateString() }));
                    return false;
                }

                var daysSinceFirstVisit = dayDiff(new Date(), new Date(cookie.ts));

                if (daysSinceFirstVisit === 1 && typeof cookie.odr === 'undefined') {
                    LunarixEventManager.triggerEvent('lrx_evt_odr', {});
                    cookie.odr = 1;
                }

                if (daysSinceFirstVisit >= 1 && daysSinceFirstVisit <= 7 && typeof cookie.sdr === 'undefined') {
                    LunarixEventManager.triggerEvent('lrx_evt_sdr', {});
                    cookie.sdr = 1;
                }

                localStorage.setItem(cookieName, JSON.stringify(cookie));
            }

            if (typeof GoogleListener !== 'undefined') {
                GoogleListener.init();
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
@endpush

@section('content')
@include('layout.header')

<div id="navContent" class="nav-content">
    <div class="nav-content-inner">
        <div class="container-main">
            <script type="text/javascript">
                if (top.location !== self.location) {
                    top.location = self.location.href;
                }
            </script>

            <noscript>
                <div class="SystemAlert">
                    <div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div>
                </div>
            </noscript>

            @include('layout.body.alert')

            <div id="Body" class="simple-body">
                <div id="ErrorPage">
                    <img
                        src="{{ $error['image'] }}"
                        id="ctl00_cphLunarix_ErrorImage"
                        alt="Alert"
                        class="ErrorAlert"
                    >

                    <h1><span id="ctl00_cphLunarix_ErrorTitle">{{ $error['title'] }}</span></h1>
                    <h3><span id="ctl00_cphLunarix_ErrorMessage">{{ $error['message'] }}</span></h3>

                    @if($error['support'] !== '')
                        <p><span id="ctl00_cphLunarix_CustomerServiceMessage">{{ $error['support'] }}</span></p>
                    @endif

                    <pre style="text-align: left; margin-left: 10px;"><span id="ctl00_cphLunarix_errorMsgLbl"></span></pre>
                    <div class="divideTitleAndBackButtons">&nbsp;</div>

                    @if($ref)
                        <p class="error-reference">Reference ID: {{ $ref }}</p>
                    @endif

                    <div class="CenterNavigationButtonsForFloat">
                        <a class="btn-small btn-neutral" title="Go to Previous Page Button" onclick="history.back(); return false;" href="#">Go to Previous Page</a>
                        <a class="btn-neutral btn-small" title="Return Home" href="/">Return Home</a>
                        <div style="clear: both"></div>
                    </div>
                </div>
            </div>

@include('layout.footerlegacy')
@endsection
