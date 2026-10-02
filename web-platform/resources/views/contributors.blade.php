@extends('layout.root')

@push('css')
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=leanbase___f9e2a82b042c4b4f945b16e30fb19e87_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___0513ca5a00c9bdedff82380744b7def6_m.css">
@endpush

@section('content')
@include('layout.header')
<div id="navContent" class="nav-content  nav-no-left" style="margin-left: 0px; width: 100%;">
        <div class="nav-content-inner">
            <div class="container-main    ">
            <script type="text/javascript">
                if (top.location != self.location) {
                    top.location = self.location.href;
                }
            </script>
        <noscript><div class="SystemAlert"><div class="lrx-alert-info" role="alert">Please enable Javascript to use all the features on this site.</div></div></noscript>
        @include('layout.body.alert')
        <div class="content  ">
        <style>
                .content {
                    max-width: 970px;
                    width: 100%;
                }
                .ctribs {
                    padding-left: 10px;
                    list-style: disc !important;
                }
                .ctribs li {
                    display: list-item !important;
                }
        </style>
            <h1>Contributions</h1>
                <p>As you may know, the Lunarix project is a community-made ROBLOX revival with the goal of reviving the 2016 era and without the help of these people Lunarix could've not been shaped into what it is today hence why we thank everyone who had helped us ever since Lunarix had began as a project</p>
                <p>Note: The last one does not mean we endorse you, we may or may not be doing that</p>
            <ul class="ctribs">
            <h3>Lunarix Maintainers</h3>
                <li><b>• Sukaira Nakamura</b> - Founder</li>
                <li><b>• Kar</b> - Co-Founder</li><br>
            <h3>Developers</h3>
                <li><b>• octacore</b> - Client Developer</li><br>
            <h3>Helpers</h3>
                <li><b>• Lanternoric</b> - Reported a Lunar-sama vulnerability</li>
                <li><b>• neva</b> - C++ help</li><br>
            <h3>Funding</h3>
                <li><b>• Alex (a3x)</b> - Donated synvo.live to the project</li>
                <li><b>• jvztl</b> - Donated to the project</li>
                <li><b>• Kore</b> - Donated to the project</li><br>
            <h3>Supporters</h3>
                <li><b>• VandGD</b> - Supported the project</li>
                <li><b>• Waylon</b> - Staff member but endorses what I'm doing</li>
                <li><b>• NTeto</b> - Tested features whenever I needed a tester to do that</li><br>
            <h3>People Who I thank for supporting</h3>
                <li><b>• Cobalt</b></li>
                <li><b>• meditext</b></li>
                <li><b>• UnitederYT</b></li>
                <li><b>• Sixless</b></li>
                <li><b>• ash</b></li>
                <li><b>• ASPXBunny</b></li>
                <li><b>• pablo57</b></li>
                <li><b>• Gubby (Kirby Superstar)</b></li>
        </ul>
    </div>
</div>
@include('layout.footer')
@endsection
