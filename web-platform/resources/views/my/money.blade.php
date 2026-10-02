@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___7000c43d73500e63554d81258494fa21_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___454963b97fe545e3b3f2aaf85eef6d4a_m.css">
@endpush
@push('js')
<script type="text/javascript" src="https://js.lunarix.lol/3f3e6c117b7e1ff6c7644a1b4048a54c.js.gzip">
<script type="text/javascript">
$(function () {
    $('.SquareTabsContainer .SquareTabGray').on('click', function () {
        var contentId = $(this).attr('contentid');
        if (!contentId) return;
        $('.SquareTabsContainer .SquareTabGray').removeClass('selected');
        $(this).addClass('selected');
        $('.TabContent').removeClass('selected');
        $('#' + contentId).addClass('selected');
    });
});
</script>
@endpush
@section('content')
@include('layout.header')
<script type="text/javascript">
if (typeof(Lunarix) === "undefined") { Lunarix = {}; }
Lunarix.Endpoints = Lunarix.Endpoints || {};
Lunarix.Endpoints.Urls = Lunarix.Endpoints.Urls || {};
Lunarix.Endpoints.Urls['/authentication/is-logged-in'] = 'https://www.lunarix.lol/authentication/is-logged-in';
</script>

<script type="text/javascript">
    // IMPORTANT! If the user is logged in, set to user_id; else, set to ''
    var _user_id = '{{ $currentUser->id ?? '0' }}';

    // IMPORTANT! Set to a unique session ID for the visitor's current browsing session.
    var _session_id = '{{ $currentUser->id ?? '0' }}';

    var _sift = window._sift = window._sift || [];

    // IMPORTANT! Insert your JavaScript snippet key here!
    _sift.push(['_setAccount', '5238aa5d58']);

    _sift.push(['_setUserId', _user_id]);
    _sift.push(['_setSessionId', _session_id]);
    _sift.push(['_trackPageview']);

    (function () {
        function ls() {
            var e = document.createElement('script');
            e.type = 'text/javascript';
            e.async = true;
            e.src = ('https:' === document.location.protocol ? 'https://' : 'http://') + 'cdn.siftscience.com/s.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(e, s);
        }
        if (window.attachEvent) {
            window.attachEvent('onload', ls);
        } else {
            window.addEventListener('load', ls, false);
        }
    }());
</script>

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


            </div>
        
        
        @include('layout.body.alert')
        <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
        
            <div id="AdvertisingLeaderboard">
    <iframe allowtransparency="true"
            frameborder="0"
            height="110"
            scrolling="no"
            src="/userads/1"
            width="728"
            data-js-adtype="iframead"></iframe>
</div>
        
        
        <div id="BodyWrapper">
            
            <div id="RepositionBody">
                <div id="Body" style='width:970px;'>
                    
    
<style type="text/css">
    #Body {
        padding: 10px;
    }
</style>
<div class="MyMoneyPage text">
    <div class="WhiteSquareTabsContainer">
        <ul class="SquareTabsContainer">
            
            <li class="SquareTabGray selected" contentid="MyTransactions_tab">
                <span><a>My Transactions</a></span>
            </li>
            
            <li class="SquareTabGray " contentid="Summary_tab">
                <span><a>Summary</a></span>
            </li>
            
            <li class="SquareTabGray " contentid="TradeItems_tab">
               <span><a>Trade Items</a></span>
            </li>
            
            <li class="SquareTabGray" contentid="Promotion_tab">
                <span><a>Promotion (Beta)</a></span>
            </li>
            
        </ul>
    </div>
    <div class="StandardPanelContainer">
        <div id="TabsContentContainer" class="StandardPanelWhite">
        
            <div id="MyTransactions_tab" class="TabContent selected uninitialized">
                <div class="SortsAndFilters">
                    <div class="TransactionType">
                        <span class="form-label">Transaction Type:</span>
                        <select class="form-select" id="MyTransactions_TransactionTypeSelect">
                            <option value="purchase">Purchases</option>
                            <option value="sale">Sales</option>
                            <option value="affiliatesale">Commissions</option>
                            
                            <option value="grouppayout">Group Payouts</option>
                            
                        </select>
                    </div>
                    <div style="clear:both;float:none;"></div>
                </div>
                <div class="TransactionsContainer">
                    <table class="table" cellpadding="0" cellspacing="0" border="0">
                        <tr class="table-header">
                            <th class="Date first">Date</th>
                            <th class="Member">Member</th>
                            <th class="Description">Description</th>
                            <th class="Amount">Amount</th>
                        </tr>
                        <tr class="datarow" colspan="4">
                            <td class="loading"></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div id="Summary_tab" class="TabContent uninitialized">
                <div class="SortsAndFilters">
                    <span class="form-label">Time Period:</span>
                    <select class="form-select" id="TimePeriod">
                        <option value="day">Past Day</option>
                        <option value="week">Past Week</option>
                        <option value="month">Past Month</option>
                        <option value="year">Past Year</option>
                    </select>
                </div>
                <div class="ColumnsContainer">
                    <div class="RobuxColumn" style="width:770px;">
                        <div>
                            <h2 class="light">
                                    <span class="robux">&nbsp;</span>
                                    <span>Bytes</span>
                                    <img src="https://cdn.lunarix.lol/d3246f1ece35d773099f876a31a38e5a.png" class="tooltip" title="The principal currency of Lunarixia, which Bloxxers Club members receive a daily allowance of to live a comfortable life of leisure. For this and other benefits, join Bloxxers Club!" />
                            </h2>
                            <table class="table" cellpadding="0" cellspacing="0" border="0" >
                            <tr class="table-header">
                                <th class="Categories first">Categories</th>
                                <th class="Credit">Credit</th>
                            </tr>
                            <tr >
                                <td class="Categories">Sale of Goods</td>
                                <td class="Credit R_SaleOfGoods">&nbsp;</td>
                            </tr>
                            <tr >
                                <td class="Categories">Currency Purchase</td>
                                <td class="Credit CurrencyPurchase">&nbsp;</td>
                            </tr>
                            
                           
                            <tr >
                                <td class="Categories">Trade System Trades</td>
                                <td class="Credit R_TradeSystem">&nbsp;</td>
                            </tr> 
                           
                            
                            <tr>
                                <td class="Categories">Promoted Page Conversion Revenue</td>
                                <td class="Credit PromotedPageConversionRevenue">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="Categories">Game Page Conversion Revenue</td>
                                <td class="Credit GamePageConversionRevenue">&nbsp;</td>
                            </tr>
                            
                            <tr  >
                                <td class="Categories">Pending Sales <img src="https://cdn.lunarix.lol/d3246f1ece35d773099f876a31a38e5a.png" class="tooltip" title="As an anti fraud precaution, revenue from certain transactions, such as Game Pass sales, is held for a short period of time before being released to the seller." /></td>
                                <td class="Credit R_PendingSales">&nbsp;</td>
                            </tr> 
                            
                            <tr>
                                <td class="Categories">Group Payouts</td>
                                <td class="Credit R_GroupPayouts">&nbsp;</td>
                            </tr>

                            <tr >
                                <td class="Categories">Login Award</td>
                                <td class="Credit LoginAward">&nbsp;</td>
                            </tr>

                            <tr >
                                <td class="Categories">Place Traffic Award</td>
                                <td class="Credit PlaceTraffic">&nbsp;</td>
                            </tr>
                            
                            <tr class="total">
                                <td colspan="3"><h2 class="light">TOTAL&nbsp;</h2><span class="robux money">(xxx)</span></td>
                            </tr>
                            </table>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                </div>
            </div>

                <div id="TradeItems_tab" class="TabContent uninitialized">
                    <div class="status-confirm" style="display:none;"></div>   
                    <div class="SortsAndFilters">
                    <div class="TradeType">
                        <span class="form-label">Trade Type:</span>
                        <select class="form-select" id="TradeItems_TradeType">
                            <option value="inbound">Inbound</option>
                            <option value="outbound">Outbound</option>
                            <option value="completed">Completed</option>
                            <option value="inactive">Inactive</option>
                        </select>
						<a href="" target="_blank" id="trade-help-link" class="text-link">How do I send a trade?</a>
                        <span class="tool-tip" style="display:none;" data-js-trade-write-disabled ><img src="/images/UI/img-tail-left.png" class="left"/>Trading is currently disabled. Trades can be viewed, but they may not be changed. Please check back later.</span>
                    </div>
                    <div style="clear:both;float:none;"></div>
                </div>
                <div class="TradeItemsContainer">
                    <table class="table" cellpadding="0" cellspacing="0" border="0">
                        <tr class="table-header">
                            <th class="Date first">Date</th>
                            <th class="Expires">Expires</th>
                            <th class="TradePartner">Trade Partner</th>
                            <th class="Status">Status</th>
                            <th class="Action">Action</th>
                        </tr>
                        <tr class="datarow" colspan="4">
                            <td class="loading"></td>
                        </tr>
                    </table>
                </div>
                    <table class="template table">
                        <tr class="datarow">
                            <td class="Date" data-se="trade-date"></td>
                            <td class="Expires" data-se="trade-expires"></td>
                            <td class="TradePartner" data-se="trade-tradepartner"></td>
                            <td class="Status" data-se="trade-status"></td>
                            <td class="Action" data-se="trade-Action"></td>
                        </tr>
                    </table>
                </div>
                <div TradeUpdater></div>
            
                <div id="Promotion_tab" class="TabContent uninitialized">
                    


<div class="info">
    When you share a Lunarix promotion link and new players sign up from your link, both of you will earn 10 bytes.
</div>
<div>
    <div class="form-label">Your Promotion link:</div>
    <div id="LinkGeneratorOutput">https://www.lunarix.lol/?lnrxp={{ $currentUser->id ?? '0' }}</div>
</div>
<ul class="nav nav-pills">
    <li class="active" data-lrx-time="hourly"><a>Hourly</a></li>
    <li data-lrx-time="daily"><a>Daily</a></li>
    <li data-lrx-time="monthly"><a>Monthly</a></li>
</ul>
<div id="PromotionAcquisitionsContainer">
    <div class="separator-horizontal"></div>
    <h2>
        New Visitors
        <img src="https://cdn.lunarix.lol/d3246f1ece35d773099f876a31a38e5a.png" class="tooltip" title="Number of people who clicked on your links who have never been on Lunarix before." />
    </h2>
    <div class="separator-horizontal"></div>
    
    <div data-lrx-organic-acquisition-type="0" data-lrx-time="hourly" data-lrx-series-names='["Visitors"]' data-lrx-series-units='["Visitors"]'>
        <div id="new-visitors-hourly" class="stats-chart loading"></div>
        <div id="new-visitors-hourly-legend" class="stats-legend"></div>
    </div>

    <div style="display:none" data-lrx-organic-acquisition-type="0" data-lrx-time="daily" data-lrx-series-names='["Visitors"]' data-lrx-series-units='["Visitors"]'>
        <div id="new-visitors-daily" class="stats-chart loading"></div>
        <div id="new-visitors-daily-legend" class="stats-legend"></div>
    </div>

    <div style="display:none" data-lrx-organic-acquisition-type="0" data-lrx-time="monthly" data-lrx-series-names='["Visitors"]' data-lrx-series-units='["Visitors"]'>
        <div id="new-visitors-monthly" class="stats-chart loading"></div>
        <div id="new-visitors-monthly-legend" class="stats-legend"></div>
    </div>
</div>
<div id="PromotionConversionsContainer">
    <div class="separator-horizontal"></div>
    <h2>
        Signups
        <img src="https://cdn.lunarix.lol/d3246f1ece35d773099f876a31a38e5a.png" class="tooltip" title="Number of new visitors from your links who signed up." />
    </h2>
    <div class="separator-horizontal"></div>

    <div data-lrx-organic-acquisition-type="1" data-lrx-time="hourly" data-lrx-series-names='["Signups"]' data-lrx-series-units='["Signups"]'>
        <div id="signups-hourly" class="stats-chart loading"></div>
        <div id="signups-hourly-legend" class="stats-legend"></div>
    </div>

    <div style="display:none" data-lrx-organic-acquisition-type="1" data-lrx-time="daily" data-lrx-series-names='["Signups"]' data-lrx-series-units='["Signups"]'>
        <div id="signups-daily" class="stats-chart loading"></div>
        <div id="signups-daily-legend" class="stats-legend"></div>
    </div>

    <div style="display:none" data-lrx-organic-acquisition-type="1" data-lrx-time="monthly" data-lrx-series-names='["Signups"]' data-lrx-series-units='["Signups"]'>
        <div id="signups-monthly" class="stats-chart loading"></div>
        <div id="signups-monthly-legend" class="stats-legend"></div>
    </div>
</div>
<div id="PromotionRevenueContainer">
    <div class="separator-horizontal"></div>
    <h2>
        Promotional Revenue
        <img src="https://cdn.lunarix.lol/d3246f1ece35d773099f876a31a38e5a.png" class="tooltip" title="Bytes earned through your promotional links." />
    </h2>
    <div class="separator-horizontal"></div>

    <div data-lrx-organic-acquisition-type="3" data-lrx-time="hourly" data-lrx-series-names='["Revenue"]' data-lrx-series-units='["R$"]'>
        <div id="revenue-hourly" class="stats-chart loading"></div>
        <div id="revenue-hourly-legend" class="stats-legend"></div>
    </div>

    <div style="display:none" data-lrx-organic-acquisition-type="3" data-lrx-time="daily" data-lrx-series-names='["Revenue"]' data-lrx-series-units='["R$"]'>
        <div id="revenue-daily" class="stats-chart loading"></div>
        <div id="revenue-daily-legend" class="stats-legend"></div>
    </div>

    <div style="display:none" data-lrx-organic-acquisition-type="3" data-lrx-time="monthly" data-lrx-series-names='["Revenue"]' data-lrx-series-units='["R$"]'>
        <div id="revenue-monthly" class="stats-chart loading"></div>
        <div id="revenue-monthly-legend" class="stats-legend"></div>
    </div>
</div>
<div class="separator-horizontal"></div>

<table class="table" id="promotion-data-table">
    <tr class="table-header">
        <th class="first">Time</th>
        <th class="acquisitions" data-lrx-organic-acquisition-type="0">New Visitors</th>
        <th class="conversions" data-lrx-organic-acquisition-type="1">Signups</th>
        <th class="revenue" data-lrx-organic-acquisition-type="3">Promotional Revenue (B$)</th>
    </tr>
</table>
                </div>
            
            <div id="AdContainer" class="Ads_WideSkyscraper">
    <iframe allowtransparency="true"
            frameborder="0"
            height="612"
            scrolling="no"
            src="/userads/2"
            width="160"
            data-js-adtype="iframead"></iframe>
</div>


            </div>
            <div style="clear: both;"></div>
        </div>
    </div>

</div>
<div id="TradeRequest" class="modalPopup unifiedModal smallModal TraderSystemRobux" UserID="{{ $currentUser->id ?? '0' }}" style="display:none;">
	
    <div style="height:38px;padding-top:2px;">
        <span>Trade Request</span>
    </div>
    <div class="simplemodal-close">
        <a class="ImageButton closeBtnCircle_20h" data-se="trade-close"></a>
    </div>
    <div class="unifiedModalContent" style="min-height:385px;width:584px; padding:5px;margin: 0 auto;" >
        <div class="GenericModalErrorMessage status-error" style="display:none;"></div>
        <div class="LeftContentContainer" >
            <div class="lunarix-avatar-image" data-user-id="" data-image-size="medium" data-se="trade-partner-avatar"></div>
            <p class="TradeRequestText"></p>
            <p class="TradeExpiration">Expires <span id="TradeRequestExpiration" data-se="trade-expire"></span></p>
        </div>
        <div style="padding-left: 5px; float:left;display:inline;">
            <div class="OfferContainer" >
                <div class="OfferList"  list-id="OfferList0">
		            <div class="OfferHeaderWrapper">
			            <h3 class="OfferHeader">ITEMS YOU WILL GIVE</h3>
                        <div class="OfferValueContainer">
                            Value: <img class="RBXImg" width="18" height="12" src="/images/Icons/img-robux.png" alt="RBX" /><span class="OfferValue" data-se="trade-give-value">0</span>
		                </div>
		            </div>                   
                    <div class="OfferItems"></div>
                </div>
                    <img src="/images/trade_divider2.jpg" style="margin-left:-5px;" alt="" /> 
                <div class="OfferList"  list-id="OfferList1">
		            <div class="OfferHeaderWrapper">
			            <h3 class="OfferHeader">ITEMS YOU WILL RECEIVE</h3>
                        <div class="OfferValueContainer">
                            Value: <img class="RBXImg" width="18" height="12" src="/images/Icons/img-robux.png" alt="RBX" /><span class="OfferValue" data-se="trade-receive-value">0</span>
		                </div>
		            </div>
                    <div class="OfferItems"></div>  
                    <div class="FeeNoteContainer"><div class="FeeNote" data-js="feenote" style="display:none;"><span class="Asterisk" >*</span> A  30% fee was taken from the amount.</div></div>
		        </div> 
	        </div> 
            <div style="clear:both;"></div>
        </div>  
        <div style="clear:both;"></div>
        <div class="ActionButtonContainer"  style="height:50px;display:none">
            <div id="ButtonAcceptTrade" class="btn-large btn-neutral" data-se="trade-accept">Accept</div>
            <div id="ButtonCounterTrade" class="btn-large btn-neutral" data-se="trade-counter">Counter</div>
            <div id="ButtonDeclineTrade" class="btn-large btn-negative" data-se="trade-decline">Decline</div>
            <div style="clear:both;"></div>
        </div>
        <div class="ReviewButtonContainer" style="height:50px;display:none">
            <div lunarix-ok class="btn-large btn-neutral" data-se="trade-ok">OK</div>
            <div id="ButtonCancelTrade" class="btn-large btn-negative" data-se="trade-cancel">Cancel</div>
            <div style="clear:both;"></div>
        </div>
        <div class="ViewButtonContainer" style="height:50px;display:none">
            <div lunarix-ok class="btn-large btn-neutral" data-se="trade-ok">OK</div>
            <div style="clear:both;"></div>
        </div>
        <div style="clear:both;"></div>
    </div>
    <script type="text/javascript">
        $(function () {
         Lunarix.Trade.TradeRequestModal.initialize(4, true, 0.3);
        });
    </script>

</div>
<div id="InventoryItemTemplate" style="display:none;">
    

<div class="InventoryItemContainerOuter"  data-se="trade-item" >
    <div fieldname="InventoryItemSize">
		<div templateid="DefaultContent" class="InventoryItemContainerInner">
            <div class="HeaderButtonPlaceHolder"></div>
            <div class="InventoryNameWrapper">
			    <a class="InventoryItemLink" href="#" target="_blank"><div class="InventoryItemName"></div></a>
            </div>
			<div class="ItemLinkDiv">
				<img class="ItemImg" alt="Item Image" />
			</div>
			<div class="HoverContent">
				<div><span class="ItemInfoLabel">Avg. Price:</span><img class="RBXImg" width="14" height="9" src="/images/cssspecific/lrx2/head_bux.png" alt="RBX" /><span class="ItemInfoData InventoryItemAveragePrice"></span></div>
				<div><span class="ItemInfoLabel">Orig. Price:</span><img class="RBXImg" width="14" height="9" src="/images/cssspecific/lrx2/head_bux.png" alt="RBX"/><span class="ItemInfoData InventoryItemOriginalPrice"></span></div>
				<div><span class="ItemInfoLabel">Serial # :&nbsp;</span><span class="InventoryItemSerial"></span><span class="ItemInfoLabel" style="margin:0 2px 0 2px;">/</span><span class="SerialNumberTotal"></span></div>
				<div class="FooterButtonPlaceHolder"></div>
            </div>
            <img class="BloxxersClubOverlay">
		</div>
	</div>	
</div>

</div>
<div id="BlankTemplate" style="display:none;">
    <div class="BlankItem LargeInventoryItem"  style="padding-right:4px;">
    </div>
</div>
<div id="RobuxTemplate" style="display:none;">
    <div class="RobuxTradeRequestItem" >
        <div class="RobuxAmountWrapper" style="">
			<div><span class="RobuxAmount" ></span><span class="RobuxItemAsterisk" >*</span> </div>
            <div>Robux</div>
        </div>
		<div style="margin:auto; width:51px;">
			<img class="ItemImg"src="/images/ROBUX.jpg" />
        </div>
    </div>
</div>
<div missing-user-asset-template style="display:none;">
    <div class="LargeInventoryItem MissingItemContainer">
        <div class="MissingItem " style="padding-right:4px;"></div>
    </div>
</div>
<div deleted-user-asset-template style="display:none;">
    <div class="LargeInventoryItem MissingItemContainer">
        <div class="MissingItem Deleted" style="padding-right:4px;"></div>
    </div>
</div>


    
    


                    <div style="clear:both"></div>
                </div>
            </div>
        </div> 
        </div>
@include('layout.footerlegacy')
@endsection