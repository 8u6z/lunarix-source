@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___1cacbba05e42ebf55ef7a6de7f5dd3f0_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___3297996122eaf8389c3412b669a3c56c_m.css">
@endpush
@push('js')
<script type="text/javascript" src="https://js.lunarix.lol/7a712e30d49c02cdb47a510e4d8fb595.js.gzip"></script>
@endpush
@section('content')
@include('layout.header')
        <div id="navContent" class="nav-content">
        <div class="nav-content-inner">
    <div id="Container">
        <div style="clear: both"></div>
        @include('layout.body.alert')
        <div id="Body" class="simple-body">
            
    
    <div style="border: solid 1px #000; margin: 100px auto; padding: 30px; width: 500px;">
        @if((int) $currentUser->status === 3)
        <h2 style="text-align: center;">Warning</h2>
        @elseif((int) $currentUser->status === 4)
            @if($punishment?->expiry)
                @php
                $banDays = \Carbon\Carbon::parse($punishment->created_at)->diffInDays(\Carbon\Carbon::parse($punishment->expiry));
                @endphp
                <h2 style="text-align: center;">Banned for {{ $banDays }} {{ Str::plural('day', $banDays) }}</h2>
            @else
                <h2 style="text-align: center;">Banned</h2>
            @endif
        @else
            <h2 style="text-align: center;">Account Deleted</h2>
        @endif
        <p>Our content monitors have determined that your behavior at Lunarix has been in violation of our Terms of Service.
        
        We will terminate your account if you do not abide by the rules.</p>
        
        <p>Reviewed: <span style="font-weight: bold">{{ \Carbon\Carbon::parse($punishment->created_at)->format('M j, Y g:i A T') }}</span></p>
        <div id="ctl00_cphLunarix_ModeratorNotePanel">
	    @if($punishment?->mod_note)
            <p>Moderator Note: <span style="font-weight: bold"><span id="ctl00_cphLunarix_Label4" mode="Encode">{{ $punishment->mod_note }}</span></span></p>
            @endif
        
</div>
        <p>
            
                    </p>
        @if($reasons->isNotEmpty())
        @foreach($reasons as $reason)
                       <div style="background-color: #fff; border: solid 1px #000; margin-bottom: 5px; padding: 10px; width: 478px">
                        <div style="margin-bottom: 5px;"><strong>Reason:</strong> {{ $reason->reason }}</div>
                        <div>
                            <strong>Offensive Item:</strong>
                            <blockquote>
                                
        {{ $reason->offensiveitem }}   
                            </blockquote>
                        </div>
                    </div>
                        @endforeach
        @endif

        <p></p>
        
        <p>Please abide by the <a href="/info/terms-of-service">Lunarix Terms of Service</a> so that Lunarix can be fun for all users.</p>
        
        
        
        
        
        
        
        
        <div id="ctl00_cphLunarix_PanelReopen">
                @if($canReactivate)
                <p>You may re-activate your account by agreeing to our <a id="ctl00_cphLunarix_HyperLinkToS" href="/info/terms-of-service" target="_blank" style="text-decoration:underline;">Terms of Service</a>.</p>
                @endif
                @if((int) $currentUser->status === 4 && $punishment?->expiry && now()->lt(\Carbon\Carbon::parse($punishment->expiry)))
                <p>Your account has been disabled for {{ $banDays }} {{ Str::plural('day', $banDays) }}. You may re-activate it after {{ \Carbon\Carbon::parse($punishment->expiry)->format('M j, Y g:i A T') }}.</p>
                @endif
                @if((int) $currentUser->status === 4 && !$punishment?->expiry)
                <p>Your account has been terminated.</p>
                @endif
            @if($canReactivate)
            <form method="POST" action="{{ route('membership.reactivate') }}">
            @csrf
            <p style="text-align: center;"><input type="checkbox" id="AgreeCheckBox" onclick="EnableButton()">I Agree</p>
            <p style="text-align: center;">
                <input type="submit" name="ctl00$cphLunarix$ButtonAgree" value="Reactivate My Account" id="ctl00_cphLunarix_ButtonAgree" disabled="disabled" class="translate">
            </p>
            </form>
            @endif
        
</div>
        <form method="GET" action="/authentication/logout">
        <p style="text-align: center;">
            <input type="submit" name="ctl00$cphLunarix$LogoutButton" value="Logout" id="ctl00_cphLunarix_LogoutButton" class="translate">
        </p>
        </form>

        <script type="text/javascript">
            function EnableButton() {
                if (document.getElementById('AgreeCheckBox').checked) {
                    document.getElementById('ctl00_cphLunarix_ButtonAgree').disabled = false;
                }
                else {
                    document.getElementById('ctl00_cphLunarix_ButtonAgree').disabled = true;
                }
            }
        </script>
    </div>

        </div>
@include('layout.footerlegacy')
@endsection
