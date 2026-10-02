@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=reset___90041b2af2fb6b9b7864ee66001ba812_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___52c69b42777a376ab8c76204ed8e75e2_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___5a8ff58299be0fe55dfc145a90d39e8c_m.css">
@endpush
@push('js')
<script type='text/javascript' src='https://js.lunarix.lol/fbf1ee7f87e15b4da11fda4617461836.js'></script>
@endpush
@section('content')
<div id="TwoStepVerificationApiPaths"
     data-request-code-unauthenticated="https://api.lunarix.lol/twostepverification/request-unauthenticated"
     data-request-code="https://api.lunarix.lol/twostepverification/request"
     data-verify-code-unauthenticated="https://api.lunarix.lol/twostepverification/verify-unauthenticated"
     data-verify-code="https://api.lunarix.lol/twostepverification/verify">
</div>
 <div id="NotLoggedInPanel" class="lrx-login-form">
	<form name="FacebookLoginForm" method="post" action="/Login/iFrameLogin.aspx" id="FacebookLoginForm" class="lrx-form-horizontal" role="form">
        @csrf
<div>
</div>
        
        <div id="LoginForm" class="lrx-newLogin">
            <div id="credentials-section" class="log-in-form">
                <div class="lrx-form-group">
                    <input name="UserName" type="text" id="UserName" class="form-control lrx-input-field LoginFormInput hidden" name="UserName" placeholder="Username" />
                </div>
                <div class="lrx-form-group">
                    <input name="Password" type="password" id="Password" class="form-control lrx-input-field LoginFormInput" placeholder="Password" />
                </div>
                <div id="iFrameCaptchaControl">
                    
                </div>
                <div class="lrx-login-btns">
                    <a class="lrx-btn-secondary-sm" id="LoginButton" tabindex="4">Log In</a>
					<a class="lrx-btn-control-sm" href="/login?returnUrl=" target="_top">Sign up</a>
                </div>
				<span id="LoggingInStatus" class="lrx-login-status">
					<img src="https://cdn.lunarix.lol/6ec6fa292c1dcdb130dcf316ac050719.gif" alt="" />
					<span>Logging in...</span>
				</span>
            </div>
            <div id="two-step-verification-section" class="log-in-form" style="display: none">
                <div class="lrx-form-group">
                    <div id="TwoStepVerificationMessage" class="two-step-verification-message">Enter your two step verification code.</div>
                </div>
                <div class="lrx-form-group">
                    <input name="TwoStepVerificationCodeInput" type="text" id="TwoStepVerificationCodeInput" class="form-control lrx-input-field LoginFormInput" placeholder="Code" />
                </div>
                <div class="lrx-login-btns">
                    <a id="TwoStepVerificationNewCodeButton" class="lrx-btn-secondary-sm" style="display:none">New Code</a>
                    <a id="TwoStepVerificationSubmitButton" class="lrx-btn-secondary-sm">Submit</a>
                    <a id="TwoStepVerificationCancelButton" class="lrx-btn-control-sm">Cancel</a>
                </div>
            </div>
                <div class="lrx-login-msg">
                    <span id="ForgotPasswordLink">
					    <a href="ResetPasswordRequest.aspx" target="_top" class="lrx-link lrx-font-sm">Forgot Password?</a>
					</span>
				    <span id="ErrorMessage" class="lrx-text-danger lrx-font-sm"></span>
                </div>
                    

<div id="SocialIdentitiesInformation"
     data-lrx-login="/social/notify-login"
     data-lrx-update="/social/update-info"
     data-lrx-disconnect="/social/disconnect"
     data-lrx-login-redirect-url="/social/postlogin"
     
     
     >
</div>
				</div>
            </div>
    </form>
  </div>
	<script type="text/javascript">
	    $(function () {
	        Lunarix.iFrameLogin.Resources = {
	            //<sl:translate>
	            invalidCaptchaEntry: 'Invalid Captcha entry',
	            //</sl:translate>
	            useSignOnApi: true,
	            signOnApiPath: '/login/v1',
	            requestCodeUnauthenticatedPath: '/twostepverification/request-unauthenticated',
                verifyCodeUnauthenticatedPath: '/twostepverification/verify-unauthenticated',
	            enterTwoStepCodeMessage: 'Enter your two step verification code.',
	            invalidCodeMessage: 'Sorry, but the code you entered was invalid or has expired.',
	            floodedTwoStepMessage: 'Too many unsuccessful attempts. Please try again later.',
	            verifyEmailMessage: 'You do not have a verified email address. Please contact customer support.',
                unknownTwoStepErrorMessage: 'Sorry, an unknown error has occurred.'
	        };
	        Lunarix.iFrameLogin.init();
	    });
	</script>
@endsection