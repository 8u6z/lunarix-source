@extends('layout.root')

@push('css')
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___23e1cfc4f7f34bdc2ff4f3c2d637a122_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___92fc433fdbc3efa2a6026f7b0fafa0d8_m.css">
@endpush

@section('content')
@include('layout.header')
<div id="navContent" class="nav-content">
    <div class="nav-content-inner">
        <div id="MasterContainer">
            <div id="BodyWrapper">
                <div id="RepositionBody">
                    <div id="Body" style="width:970px">
                        <h1>{{ $action === 'link' ? 'Approve Discord Link' : 'Approve Discord Unlink' }}</h1>
                        <div id="loginarea" class="divider-bottom">
                            <div id="leftArea">
                                <div id="loginPanel">
                                    <p class="text">
                                        @if($action === 'link')
                                            Approve linking this Discord account to Lunarix account <strong>{{ $user->username }} ({{ $user->id }})</strong>?
                                        @else
                                            Approve unlinking Discord from Lunarix account <strong>{{ $user->username }} ({{ $user->id }})</strong>?
                                        @endif
                                    </p>
                                    <p class="footnote">This link expires after 30 minutes.</p>
                                    <form method="POST" action="{{ route('discord.confirm', $token) }}">
                                        @csrf
                                        <button class="btn-medium btn-neutral" type="submit">{{ $action === 'link' ? 'Approve Link' : 'Approve Unlink' }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.footerlegacy')
@endsection
