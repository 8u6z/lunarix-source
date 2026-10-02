@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=leanbase___f9e2a82b042c4b4f945b16e30fb19e87_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___d2eeb5738db9c7a822adf9b46cf9784f_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___52c69b42777a376ab8c76204ed8e75e2_m.css">
@endpush
@section('content')
@include('layout.header')
    <div id="navContent" class="nav-content  ">
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
                                                            <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
                    @include('layout.body.alert')
                    <div id="BodyWrapper" class="">
                        <div id="RepositionBody">
                            <div id="Body" style="width:970px">
                                
       
<div id="BCPageContainer">
  <div id="UserDataInfo" data-auth="false" data-active-bc="false"></div>
  <div class="header">
    <span><h1>Upgrade to Lunarix Bloxxers Club</h1></span>
  </div>
  <div class="left-column">
    <table cellspacing="0" border="0">
      <thead class="product-title">
        <tr>
          <td class="center-bold">
            <h2 class="product-space">Free</h2>
            <img data-attribute="free" src="https://cdn.lunarix.lol/77add140640c3388e6c9603bc5983846.png" alt="free" />
          </td>
          <td class="center-bold">
            <h2 class="product-space">Classic</h2>
            <img data-attribute="classic" src="https://cdn.lunarix.lol/ba707f47bb20a1f4804da461fb5d3c31.png" alt=" bc" />
          </td>
          <td class="center-bold">
            <h2 class="product-space">Turbo</h2>
            <img data-attribute="turbo" src="https://cdn.lunarix.lol/d7eb3ed186e351d99ce8c11503675721.png" alt="tbc" />
          </td>
          <td class="center-bold">
            <h2 class="product-space">Outrageous</h2>
            <img data-attribute="outrageous" src="https://cdn.lunarix.lol/ca1d0aef06c5fc06a2d8b23aea5e20d2.png" alt="obc" />
          </td>
        </tr>
      </thead>
      
  <tbody class="product-summary summary-big">
      <tr>
        <td class="divider-top">
          <span class="product-description">Daily Bytes</span>
          <span class="nbc-product">B$5</span>
        </td>
        <td class="divider-top bc-product ">
          B$15
        </td>
        <td class="divider-top tbc-product     emphasis">
          B$35
        </td>
          <td class="divider-top obc-product     emphasis">
              B$60
          </td>
      </tr>
      <tr>
        <td class="divider-top">
          <span class="product-description">Create Groups</span>
          <span class="nbc-product">5</span>
        </td>
        <td class="divider-top bc-product ">
          15
        </td>
        <td class="divider-top tbc-product ">
          30
        </td>
          <td class="divider-top obc-product ">
              100!
          </td>
      </tr>
      <tr>
        <td class="divider-top">
          <span class="product-description">Signing Bonus*</span>
          <span class="nbc-product">No</span>
        </td>
        <td class="divider-top bc-product ">
          B$100
        </td>
        <td class="divider-top tbc-product ">
          B$350
        </td>
          <td class="divider-top obc-product ">
              B$1000
          </td>
      </tr>
      <tr>
        <td class="divider-top">
          <span class="product-description">Discount</span>
          <span class="nbc-product">No</span>
        </td>
        <td class="divider-top bc-product ">
          10%
        </td>
        <td class="divider-top tbc-product ">
          25%
        </td>
          <td class="divider-top obc-product ">
              35%
          </td>
      </tr>
                    <tr>
                <td colspan="4">* Lunarix Bloxxers Club is a free membership.</td>
            </tr>
  </tbody>

<tbody class="product-grid">
        <tr>  
            <td class="product-cell divider-left">
                <div class="product-nbc divider-bottom">

                </div>
            </td>
                <td class="product-cell divider-left">
                    <div class="product-cell">
                        <div class="product-text">
                        <h3><a href="/Upgrades/BCEligibility.aspx">Click here</a> if you are eligible.</h3>
                      </div>
                    </div>
                </td>
                <td class="product-cell divider-left">
                    <div class="product-cell">
                        <div class="product-text">
                        <h3>Boost our Discord server (eg: 1 Boost)</h3>
                      </div>
                    </div>
                </td>
                <td class="product-cell divider-left">
                    <div class="product-cell">
                        <div class="product-text">
                        <h3>Win an official giveaway (or event)</h3>
                      </div>
                    </div>
                </td>
        </tr>
        <tr>
            
</tbody>
  <tbody class="product-summary summary-small">
      <tr>
        <td class="divider-top">
          <span class="product-description">Sell Stuff</span>
          <span class="nbc-product">No</span>
        </td>
        <td class="divider-top bc-product     emphasis
">
          ✔
        </td>
        <td class="divider-top tbc-product     emphasis
">
          ✔
        </td>
          <td class="divider-top obc-product     emphasis
">
              ✔
          </td>
      </tr>
      <tr>
        <td class="divider-top">
          <span class="product-description">Virtual Hat</span>
          <span class="nbc-product">No</span>
        </td>
        <td class="divider-top bc-product     emphasis
">
          ✔
        </td>
        <td class="divider-top tbc-product     emphasis
">
          ✔
        </td>
          <td class="divider-top obc-product     emphasis
">
              ✔
          </td>
      </tr>
      <tr>
        <td class="divider-top">
          <span class="product-description">Bonus Gear</span>
          <span class="nbc-product">No</span>
        </td>
        <td class="divider-top bc-product     emphasis
">
          ✔
        </td>
        <td class="divider-top tbc-product     emphasis
">
          ✔
        </td>
          <td class="divider-top obc-product     emphasis
">
              ✔
          </td>
      </tr>
      <tr>
        <td class="divider-top">
          <span class="product-description">Beta Features</span>
          <span class="nbc-product">No</span>
        </td>
        <td class="divider-top bc-product     emphasis
" style="font-weight:bold;color:#d90000;width:3em;text-align:center;font-size:14px;">
          No
        </td>
        <td class="divider-top tbc-product     emphasis
">
          ✔
        </td>
          <td class="divider-top obc-product     emphasis
">
              ✔
          </td>
      </tr>
      <tr>
        <td class="divider-top">
          <span class="product-description">Personal Servers</span>
          <span class="nbc-product">No</span>
        </td>
        <td class="divider-top bc-product     emphasis
">
          ✔
        </td>
        <td class="divider-top tbc-product     emphasis
">
          ✔
        </td>
          <td class="divider-top obc-product     emphasis
">
              ✔
          </td>
      </tr>
      <tr>
        <td class="divider-top">
          <span class="product-description">Trade System</span>
          <span class="nbc-product">No</span>
        </td>
        <td class="divider-top bc-product     emphasis
">
          ✔
        </td>
        <td class="divider-top tbc-product     emphasis
">
          ✔
        </td>
          <td class="divider-top obc-product emphasis">
              ✔
          </td>
      </tr>
          </tbody>






    </table>
  </div>
  <div class="right-column">

<div id="RightColumnWrapper">
    <div class="cell cellDivider">
        For billing and payment questions: <span class="SL_swap" id="CsEmailLink"><a href="/discord">Join our Discord server.</a></span>
    </div>
    
    <div class="cell cellDivider">
        <h3>Bytes</h3>
        <p>Bytes is the free virtual currency for Lunarix used in many of our online games. You can also use Bytes for finding a great look for your character. Get cool gear to take into multiplayer battles. Buy Limited items to sell and trade. You’ll need Bytes to make it all happen. What are you waiting for?</p>
    </div>
        <div class="cell cellDivider">
            <h3>Gift Cards</h3><br />
            <a href="/upgrades/giftcards.aspx" class="giftCardImage"><img src="https://cdn.lunarix.lol/bf9f4b65f937ad01f07ae6714eaba723.png" alt="giftcard" /></a>
            <div>
                <div class="giftCardButton">
                    <a  href="/gamecard" class="lrx-btn-secondary-xs">Got a card? Redeem it!</a>
                </div>
              <div style="clear: both"></div>
            </div>
        </div>
    <div class="cell">
        <h3>Parents</h3>
        <p>Learn more about Bloxxers Club and how we help <a href="http://corp.lunarix.lol/parents" class="lunarix-interstitial">keep kids safe.</a></p>
        <h3>Cancellation</h3>
        <p>You can turn off membership auto renewal at any time before the renewal date and you will continue to receive Bloxxers Club privileges for the remainder of the currently paid period. To turn off membership auto renewal, please click the 'Cancel Membership Renewal button' on the <a href="/my/account?tab=billing" class="lunarix-interstitial">Billing</a> tab of the Settings page and confirm the cancellation.</p>
    </div>
</div>
  </div>
    <div id="dialog-confirmation" style="display: none;"></div>
</div>
      <div style="clear:both"></div>
    </div>
  </div>
</div>
@include('layout.footerlegacy')
@endsection
