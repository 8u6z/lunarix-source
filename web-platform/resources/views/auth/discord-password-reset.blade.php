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
            @include('layout.body.alert')
            <div id="BodyWrapper">
                <div id="RepositionBody">
                    <div id="Body" style="width:970px">
                        <h1>Reset Password</h1>

                        @if($errors->any())
                            <div class="validation-summary-errors">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('discord.password-reset', $token) }}">
                            @csrf
                            <div id="loginarea" class="divider-bottom">
                                <div id="leftArea">
                                    <div id="loginPanel">
                                        <p class="text">If you did not request this password reset please ignore this page. Contact Lunarix staff and reset your current password.</p>
                                        <table id="logintable">
                                            <tr>
                                                <td><label class="form-label" for="Password">New password:</label></td>
                                                <td><input class="text-box text-box-medium" id="Password" name="password" type="password" minlength="8" required autofocus></td>
                                            </tr>
                                            <tr>
                                                <td><label class="form-label" for="PasswordConfirmation">Confirm password:</label></td>
                                                <td><input class="text-box text-box-medium" id="PasswordConfirmation" name="password_confirmation" type="password" minlength="8" required></td>
                                            </tr>
                                        </table>
                                        <div id="signInButtonPanel">
                                            <button class="btn-medium btn-neutral" type="submit">Reset Password</button>
                                        </div>
                                        <div class="clearFloats"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.footerlegacy')
@endsection
