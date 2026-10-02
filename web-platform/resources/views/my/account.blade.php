@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___1cacbba05e42ebf55ef7a6de7f5dd3f0_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___6d7bcbdfd9dfa4d697c4e627e71f4fc1_m.css">
    <script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery.validate.unobtrusive.js"></script>
<script type="text/javascript" src="/Services/Secure/AddParentEmail.js"></script>
<script type="text/javascript" src="/js/SignupFormValidator.js"></script>
<script type="text/javascript" src="/js/My/AccountMVC.js"></script>
<script type="text/javascript" src="/js/AddEmail.js"></script>
<script type="text/javascript" src="/js/SuperSafePrivacyIndicator.js"></script>
@endpush
@push('js')
<script type='text/javascript' src='http://js.lunarix.lol/77026e0e8875389783edcd7224c6e72b.js.gzip'></script>
@endpush
@section('content')
@include('layout.header')
<div id="navContent" class="nav-content">
<div class="nav-content-inner">
@include('layout.body.alert')
<div id="MasterContainer">
  <div id="BodyWrapper"><div id="RepositionBody"><div id="Body" style="width:970px">
    <div id="AccountPageContainer" data-missingparentemail="false" data-userabove13="true" data-currentdateyear="2026" data-currentdatemonth="1" data-currentdateday="1">
  <div id="AccountPageLeft" class="divider-right">
    <h1>My Account</h1>
    <form action="/my/account/update" id="UpdateAccountForm" method="post">
      <div class="tab-container">
        <div class="tab active" data-id="settings_tab">Settings</div>
        <div class="tab" data-id="privacy_tab">Privacy</div>
      </div>
      @csrf
      <div class="tab-content active" id="settings_tab" style="display: block;">
        <div id="AccountSettings" class="settings-section">
          <div class="SettingSubTitle" id="UsernameSetting" data-robux-remaining="{{ max(0, 1000 - (int) $user->moons) }}" data-email-verified="True" data-alerturl="https://cdn.lunarix.lol/cbb24e0c0f1fb97381a065bd1e056fcb.png" data-change-username-verifyurl="/account/username/verifyupdate" data-change-username-url="/account/username/update" data-buy-robux-url="/upgrades/robux">
            <span class="settingLabel form-label">Username:</span> <span id="username">{{ $user->username }}</span>
            <a class="btn-small btn-primary" id="changeUsername">Change My Username<span class="btn-text">Change My Username</span></a>
          </div>
          <div id="BirthdaySetting" class="SettingSubTitle">
            <span class="settingLabel form-label">Birthday:</span>
            <div id="Over13Birthday">
              <select class="accountPageChangeMonitor form-select" data-val="true" data-val-number="The field BirthMonth must be a number." data-val-range="The field BirthMonth must be between 1 and 12." data-val-range-max="12" data-val-range-min="1" data-val-required="The BirthMonth field is required."  id="MonthDropDown" name="BirthMonth">
        @for ($m = 1; $m <= 12; $m++)
              <option value="{{ $m }}" @selected($m == $birthMonth)>{{ \Carbon\Carbon::create()->month($m)->format('M') }}</option>
               @endfor
              </select>
              <select class="accountPageChangeMonitor form-select" data-val="true" data-val-number="The field BirthDay must be a number." data-val-range="The field BirthDay must be between 1 and 31." data-val-range-max="31" data-val-range-min="1" data-val-required="The BirthDay field is required."  id="DayDropDown" name="BirthDay">
        @for ($d = 1; $d <= 31; $d++)
            <option value="{{ $d }}" @selected($d == $birthDay)>{{ $d }}</option>
            @endfor
              </select>
              <select class="accountPageChangeMonitor form-select" data-val="true" data-val-number="The field BirthYear must be a number." data-val-required="The BirthYear field is required."  id="YearDropDown" name="BirthYear">
        @php $currentYear = now()->year - "14"; @endphp
          @for ($y = $currentYear; $y >= $currentYear - 99; $y--)
             <option value="{{ $y }}" @selected($y == $birthYear)>{{ $y }}</option>
          @endfor
              </select>
              <input id="BirthMonth" name="BirthMonth" type="hidden" value="{{ $birthMonth }}">
              <input id="BirthDay" name="BirthDay" type="hidden" value="{{ $birthDay }}">
              <input id="BirthYear" name="BirthYear" type="hidden" value="{{ $birthYear }}">
              <span>
              <a id="AskParentToVerifyAgeLink" class="btn-control btn-control-small" style = "display: none">
              Ask Parent To Change</a>
              </span>
            </div>
          </div>
          <div id="GenderSetting" class="SettingSubTitle">
            <span class="settingLabel form-label">Gender:</span>
            <div id="GenderControl">
              <div id="GenderSelectControl" class="accountPageChangeMonitor">
                <label class="radio-selection"><input @checked($user->gender === 'male') data-val="true" data-val-required="The Gender field is required." id="Gender_2" name="Gender" type="radio" value="2"><span for="Gender_2">Male</span></label><label class="radio-selection"><input id="Gender_3" @checked($user->gender === 'female') name="Gender" type="radio" value="3"><span for="Gender_3">Female</span></label>
                <span class="field-validation-valid" data-valmsg-for="Gender" data-valmsg-replace="true"></span>
              </div>
            </div>
          </div>
          <div id="PasswordSetting" class="SettingSubTitle">
            <span class="settingLabel form-label">Password:</span> <span id="securePassword">*********</span>
            <a id="changePassLink" class="changePassWord btn-control btn-control-small" href="/Login/ChangePassword.aspx">Change Password</a>
          </div>
          <div id="PersonalBlurbSetting" class="SettingSubTitle">
            <span class="settingLabel form-label">Personal blurb:</span>
            <div id="BlurbDesc">
              <textarea class="lunarix-blurb-default-text accountPageChangeMonitor text blurbGreyText valid" cols="20" data-val="true" data-val-length="The field Personal Blurb must be a string with a maximum length of 1000." data-val-length-max="1000" id="blurbText" name="PersonalBlurb" rows="2" title="Describe yourself here">{{ $user->description }}</textarea>
              <span class="field-validation-valid" data-valmsg-for="PersonalBlurb" data-valmsg-replace="true"></span>
              <br>
              <div id="blurbSubtext" class="footnote">
                Do not provide any details that can be used to identify you outside Lunarix.
                <span class="footnote"><br>(1000 character limit | ${bytes} to show your bytes amount)</span>
              </div>
            </div>
          </div>
          <div id="DiscordLinking" class="SettingSubTitle">
            <span class="settingLabel form-label">Linked Discord:</span>
            <span>{{ $user->discord_id ? (($user->discord_username ?: 'Discord User').' ('.$user->discord_id.')') : 'Not linked' }}</span>
            @if($user->discord_id)
              <button class="changePassWord btn-control btn-control-small" type="submit" form="discordUnlinkForm">Unlink Discord</button>
            @else
              <a id="linkDiscord" class="changePassWord btn-control btn-control-small" href="{{ route('discord.redirect') }}">Link Discord</a>
            @endif
          </div>
          <div id="DiscordNotificationSetting" class="SettingSubTitle">
            <span class="settingLabel form-label">Discord notifications:</span>
            <div class="accountPageChangeMonitor">
              <label class="radio-selection"><input @checked($privacy->discord_notifications) name="DiscordNotifications" type="radio" value="1"><span>Enabled</span></label>
              <label class="radio-selection"><input @checked(!$privacy->discord_notifications) name="DiscordNotifications" type="radio" value="0"><span>Disabled</span></label>
            </div>
          </div>
      {{-- planned feature --}}
          {{-- <div id="LanguageTypeSettings" class="SettingSubTitle">
            <span class="settingLabel form-label">Language:</span>
            <select class="accountPageChangeMonitor form-select valid" data-val="true" data-val-number="The field LanguageId must be a number." data-val-required="The LanguageId field is required." id="LanguageList" name="LanguageId">
              <option value="1">English</option>
            </select>
            <span class="field-validation-valid" data-valmsg-for="LanguageId" data-valmsg-replace="true"></span>
          </div> --}}
          <div style="clear: both;">
            <a class="btn-medium btn-neutral updateSettingsBtn" id="UpdateSettingsBtn1">Update<span class="btn-text">Update</span></a>
          </div>
        </div>
        <div id="AddEmailScreenModal" class="PurchaseModal simplemodal-data" data-uid="59896360" data-userip="72.211.206.23">
          <div id="CloseAddEmailScreen" class="simplemodal-close">
            <a id="closeEmailModal" runat="server" class="ImageButton closeBtnCircle_20h"></a>
          </div>
          <div id="changeEmailTitle" class="titleBar">
            Change Email Address
          </div>
          <div id="updateEmailBody">
            <div id="AddEmailDialog">
              <br>
              <div id="SubmitEmailButton">
                <a id="SubmitInfoButton" class="btn-medium btn-neutral btn-disabled-neutral">Update<span class="btn-text">Update</span></a> <a id="CancelInfoButton" class="btn-cancel-m btn-negative btn-medium">Cancel<span class="btn-text">Cancel</span></a>
              </div>
            </div>
            <div id="ConfirmationDialog">
              <div id="ConfirmationDialogInner">
                An email has been sent for verification.
              </div>
              <a href="#" id="updateEmailOK" class="ImageButton btn_blue_ok_l"></a>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-content" id="privacy_tab">
        <div id="PrivacySettings" class="settings-section">
          <div id="ChatSetting" class="SettingSubTitle">
            <span class="form-label priv-label">Chatting Mode:</span>
            <span class="InlineSuperSafeDiv">
              <select class="accountPageChangeMonitor form-select" id="ChatOptions" name="ChatVisibilityPrivacy">
                <option value="Normal" @selected($privacy->ChatPrivacy === \App\Models\UserPrivacy::CHAT_NORMAL)>Normal</option>
                <option value="SuperSafeChat" @selected($privacy->ChatPrivacy !== \App\Models\UserPrivacy::CHAT_NORMAL)>Super Safe Chat</option>
              </select>
              <span class="field-validation-valid" data-valmsg-for="ChatVisibilityPrivacy" data-valmsg-replace="true"></span> 
            </span>
          </div>
          <div id="GuestSetting" class="SettingSubTitle">
            <span class="form-label priv-label">Guest Mode:</span>
            <span class="InlineSuperSafeDiv">
              <select class="accountPageChangeMonitor form-select" id="GuestOptions" name="GuestMode">
                <option value="Enabled" @selected($privacy->GuestMode !== \App\Models\UserPrivacy::GUEST_DISABLED)>Enabled</option>
                <option value="Disabled" @selected($privacy->GuestMode === \App\Models\UserPrivacy::GUEST_DISABLED)>Disabled</option>
              </select>
              <span class="field-validation-valid" data-valmsg-for="GuestMode" data-valmsg-replace="true"></span> 
            </span>
          </div>
          <div id="PrivateMessageSetting" class="SettingSubTitle">
            <span class="form-label priv-label">Who can send me messages:</span>
            <span class="InlineSuperSafeDiv">
              <select class="accountPageChangeMonitor form-select" id="MessageList" name="PrivateMessagePrivacy">
                <option value="All" @selected($privacy->PrivateMessagePrivacy === \App\Models\UserPrivacy::SCOPE_ALL)>All Users</option>
                <option selected="selected" value="Friends" @selected($privacy->PrivateMessagePrivacy === \App\Models\UserPrivacy::SCOPE_FRIENDS)>Friends</option>
                <option value="Noone" @selected($privacy->PrivateMessagePrivacy === \App\Models\UserPrivacy::SCOPE_NOONE)>No One</option>
              </select>
              <span class="field-validation-valid" data-valmsg-for="PrivateMessagePrivacy" data-valmsg-replace="true"></span> 
            </span>
          </div>
          <div id="FollowSetting" class="SettingSubTitle">
            <span class="form-label priv-label">Who can follow me:</span>
            <select class="accountPageChangeMonitor form-select" id="FollowList" name="FollowMePrivacy" style="">
                <option value="All" @selected($privacy->FollowMePrivacy === \App\Models\UserPrivacy::SCOPE_ALL)>All Users</option>
                <option selected="selected" value="Friends" @selected($privacy->FollowMePrivacy === \App\Models\UserPrivacy::SCOPE_FRIENDS)>Friends</option>
                <option value="Noone" @selected($privacy->FollowMePrivacy === \App\Models\UserPrivacy::SCOPE_NOONE)>No One</option>
            </select>
            <div style="position: absolute; top: 0px; left: -5px; width: 2px; height: 23px; z-index: 1000; background-color: rgb(255, 255, 255); opacity: 0;"></div>
          </div>
          <div id="FriendSetting" class="SettingSubTitle">
            <span class="form-label priv-label">Who can send me friend requests:</span>
            <select class="accountPageChangeMonitor form-select" id="FriendList" name="FriendMePrivacy" style="">
                <option value="All" @selected($privacy->FollowMePrivacy === \App\Models\UserPrivacy::SCOPE_ALL)>All Users</option>
                <option value="Noone" @selected($privacy->FollowMePrivacy === \App\Models\UserPrivacy::SCOPE_NOONE)>No One</option>
            </select>
            <div style="position: absolute; top: 0px; left: -5px; width: 2px; height: 23px; z-index: 1000; background-color: rgb(255, 255, 255); opacity: 0;"></div>
          </div>    
          <div style="clear: both;">
            <a class="btn-medium btn-neutral updateSettingsBtn" id="UpdateSettingsBtn2">Update<span class="btn-text">Update</span></a>
          </div>
        </div>
      </div>
    </form>
    @if($user->discord_id)
      <form id="discordUnlinkForm" method="POST" action="{{ route('discord.unlink') }}">@csrf @method('DELETE')</form>
    @endif
  </div>
  <div id="AccountPageRight">
          <div id="UpgradeAccount" style="margin-left: 10px">
            <div id="AdvertisementRight">
              <div style="margin-top: 10px">
                <iframe allowtransparency="true" frameborder="0" height="270" scrolling="no" src="/userads/3" width="300" data-js-adtype="iframead"></iframe>
              </div>
            </div>
          </div>
          <div style="clear: both"></div>
        </div>
            </div>

          </div>
            </div>

<script type="text/javascript">
  $(function () {
      if (typeof Lunarix === "undefined") {
          Lunarix = {};
      }
      if (typeof Lunarix.ChangeUsername === "undefined") {
          Lunarix.ChangeUsername = {};
      }
      //<sl:translate>
      Lunarix.AccountResources = {
          addParentEmailText: "Add Parent Email",
          missingParentBodyText: "To update or add your parent\'s email address, please have your parent contact our Customer Service Department at info@lunarix.com.",
          okText: "OK",
          cancelText: "Cancel",
          facebookConnectText: "Facebook Connect",
          facebookConnectBodyText: "Your Facebook account has been disconnected."
      };
      Lunarix.SignupFormValidator.Resources = {
          doesntMatch: "Doesn't match",
          requiredField: "Required field",
          tooLong: "Too long",
          tooShort: "Too short",
          containsInvalidCharacters: "Contains invalid characters",
          needsFourLetters: "Needs 4 letters",
          needsTwoNumbers: "Needs 2 numbers",
          noSpaces: "No spaces allowed",
          weakKey: "Weak key combination.",
          invalidName: "Can't be your character name",
          alreadyTaken: "Already taken",
          cantBeUsed: "Can't be used",
          password: "password"
      };
      Lunarix.ChangeUsername.Resources = {
          insufficientFundsTitle: "Insufficient Funds",
          insufficientFundsText: "You need {0} more to change your username.",
          insufficientFundsAcceptText: "Get Bytes",
          insufficientFundsFooter: "or " + "<a href='/My/Money.aspx?tab=TradeCurrency' style='font-weight:bold'>Trade Currency</a>",
          emailVerifiedTitle: "Verified Email Required",
          emailVerifiedMessage: "You must verify your email before you can change your username.",
          verify: "Verify",
          changeUsernameTitle: "Change Username",
          proceedToBuyText: "Buy for B$ 1,000",
          confirmUsernameChangeText: 'Would you like to change your username to {0} for <span class="robux notranslate">1,000 Bytes</span>?',
          passwordRequiredText: "Please enter your current password.",
          unknownErrorText: "An unknown error occurred.",
          newUsernameFieldLabel: "Desired Username:",
          newUsernameHintText: "3-20 letters & numbers",
          passwordLabel: "Password:",
          warningText: "Username changes cost 1,000 Bytes.",
          processingText: "Processing...",
          processIndicatorImageUrl: "https://cdn.lunarix.lol/ec4e85b0c4396cf753a06fade0a8d8af.gif",
          confirmUsernameChangeFooterText: "Your balance after this transaction will be {0}.",
          confirmUsernameChangeAccept: "Buy Now",
          usernameChangedText: "Congratulations, {0}! Your username has been changed.",
          usernameChangeErrorTitle: "Username Change Error",
          usernameChangeErrorText: "There was an error changing your username: "
      };
  
      Lunarix.ChangeUsername.initializeStrings();
      Lunarix.ChangeUsername.initializeChangeUsernameButton();
      //</sl:translate>
          if ($("#FacebookDisconnectModal").length > 0) {
      
      Lunarix.GenericConfirmation.open({
              titleText: Lunarix.AccountResources.facebookConnectText,
              bodyContent: Lunarix.AccountResources.facebookConnectBodyText,
              acceptText: Lunarix.AccountResources.okText,
              declineColor: Lunarix.GenericConfirmation.none,
              dismissable: false
          });
  
      }
  });
</script>
      <div style="clear:both"></div>
    </div>
  </div>
</div>
@include('layout.footerlegacy')
@endsection
