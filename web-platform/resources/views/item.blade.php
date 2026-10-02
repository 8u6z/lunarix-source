@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___23e1cfc4f7f34bdc2ff4f3c2d637a122_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___92cf6d5a914d222d52c7c42f39d8020f_m.css">
@endpush
@section('content')
@include('layout.header')
<script>String.format = function() {var s = arguments[0];for (var i = 0; i < arguments.length - 1; i++) {s = s.replace(new RegExp('\\{' + i + '\\}', 'gm'), arguments[i + 1]);} return s;};</script>
<script type="text/javascript" src="/gigya.js"></script>
<script src='http://js.lunarix.lol/50cb8c7590b75499925be4825ab1fb8f.js'></script>
<script src='http://js.lunarix.lol/db95b7bf9a4587f82d242e5a2fc3fc30.js'></script>
<script type='text/javascript'>Lunarix.config.externalResources = [];Lunarix.config.paths['Pages.Catalog'] = 'http://js.lunarix.lol/1612c57544c7977e19cd15c824f7ecc3.js';Lunarix.config.paths['Pages.CatalogShared'] = 'http://js.lunarix.lol/4eb48eec34ca711d5a7b08a4291ac753.js';Lunarix.config.paths['Pages.Messages'] = 'http://js.lunarix.lol/e8cbac58ab4f0d8d4c707700c9f97630.js';Lunarix.config.paths['Resources.Messages'] = 'http://js.lunarix.lol/fb9cb43a34372a004b06425a1c69c9c4.js';Lunarix.config.paths['Widgets.AvatarImage'] = 'http://js.lunarix.lol/bbaeb48f3312bad4626e00c90746ffc0.js';Lunarix.config.paths['Widgets.DropdownMenu'] = 'http://js.lunarix.lol/7b436bae917789c0b84f40fdebd25d97.js';Lunarix.config.paths['Widgets.GroupImage'] = 'http://js.lunarix.lol/33d82b98045d49ec5a1f635d14cc7010.js';Lunarix.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.lunarix.lol/fbb86cf0752d23f389f983419d3085b4.js';Lunarix.config.paths['Widgets.ItemImage'] = 'http://js.lunarix.lol/838ec9c8067ba6fd6793a8bdbdb48a5c.js';Lunarix.config.paths['Widgets.PlaceImage'] = 'http://js.lunarix.lol/f2697119678d0851cfaa6c2270a727ed.js';Lunarix.config.paths['Widgets.SurveyModal'] = 'http://js.lunarix.lol/d6e979598c460090eafb6d38231159f6.js';</script><script type="text/javascript">
    $(function () {
        Lunarix.JSErrorTracker.initialize({ 'suppressConsoleError': true});
    });
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



        <script type="text/javascript">Lunarix.FixedUI.gutterAdsEnabled=true;</script>

        

        <div id="Container">
            
            
        </div>
@include('layout.body.alert')
		
    <div id="AdvertisingLeaderboard"  class = " top-ad-728 ">
        

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
                <div id="Body" style='width:970px;'>
                    
    <div id="ItemContainer" class="text ">
        <div>
            @if(($asset->is_limited || $asset->is_limited_unique) ? $userOwnedCopies->isNotEmpty() : $userOwns)
            <div id="ctl00_cphLunarix_GearDropDown" class="SetList ItemOptions" data-isdropdownhidden="True" data-isitemlimited="{{ $asset->is_limited ? 'True' : 'False' }}" data-isitemresellable="{{ $asset->is_limited ? 'True' : 'False' }}">
                <a href="#" class="btn-dropdown">
                    <img src="https://cdn.lunarix.lol/ea51d75440715fc531fc3ad281c722f3.png" />
                </a>
                <div class="clear"></div>
                <div class="SetListDropDown">
                    <div class="SetListDropDownList invisible">
                        <div class="menu invisible">
                            <div id="ctl00_cphLunarix_ItemOwnershipPanel">
	@if(!$asset->is_limited && !$asset->is_limited_unique && $userOwns)
                                <a id="ctl00_cphLunarix_btnDelete" href="#">Delete from My Stuff</a>
                            @endif
@if(($asset->is_limited || $asset->is_limited_unique) && $asset->isSoldOut() && $userOwnedCopies->isNotEmpty())
<a id="ctl00_cphLunarix_btnSell" href="#" onclick="$('#SellItemModalContainer').modal({escClose:true, overlayClose:true, opacity:80, overlayCss:{backgroundColor:'#000'}}); return false;">Sell My Collectible</a>
@endif
</div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <h1 class="notranslate" data-se="item-name">
                {{ $asset->name }}
            </h1>
            <h3>
                @if($asset->is_limited)
                Lunarix {{ $asset->getTypeName() }} / Limited Edition
                @elseif($asset->is_limited_unique)
                Lunarix {{ $asset->getTypeName() }} / Collectible Item / Limited Edition
                @else
                Lunarix {{ $asset->getTypeName() }}
                @endif
            </h3>
        </div>
        <div id="Item">
            <div id="Details">
                
                        <div id="assetContainer">
                            <div id="Thumbnail">
                                
                                

<div id="AssetThumbnail" class="thumbnail-holder" data-reset-enabled-every-page data-url="/Thumbs/Asset.ashx?assetId={{ $asset->id }}" style="width:320px; height:320px;">
    <span class="thumbnail-span" data-3d-url="/asset-thumbnail-3d/json?assetId={{ $asset->id }}"  data-js-files='http://js.lunarix.lol/1b5ff54032ecaa6588a0c5f2ad7e1a4c.js' ><img  class='' src='/Thumbs/Asset.ashx?assetId={{ $asset->id }}' /></span>
</div>
                                @if($asset->is_limited_unique)
                                    <img src="/images/AssetIcons/overlay_limitedUnique_big.png" class="thumbnail-overlay" alt="Limited Unique" style="position:absolute;bottom:0;left:0;z-index:2;">
                                @elseif($asset->is_limited)
                                    <img src="/images/AssetIcons/overlay_limited_big.png" class="thumbnail-overlay" alt="Limited" style="position:absolute;bottom:0;left:0;z-index:2;">
                                @endif
                                
                                @if($asset->isNewArrival())
                                <img src="https://cdn.lunarix.lol/8a25ded7fa07d098dac7f234e7b34cfd.png" id="ctl00_cphLunarix_ItemNewOverlay" class="thumbnail-overlay" alt="New" style="position: absolute; top: 0px; right: 0px;" />
                                @endif
								
								
                                
                            </div>
                            <span id="ThumbnailText"></span>
                        </div>
                    
                <div id="Summary">
                    <div class="SummaryDetails">
                        <div id="Creator" class="Creator">
                            <div class="Avatar">
                                
                                <a id="ctl00_cphLunarix_AvatarImage" class=" notranslate" class=" notranslate" title="{{ $asset->creator->username }}" href="/User.aspx?ID={{ $asset->creator_id }}" style="display:inline-block;height:70px;width:70px;cursor:pointer;"><img src="/Thumbs/Avatar.ashx?userId={{ $asset->creator_id }}" height="70" width="70" border="0" onerror="return Lunarix.Controls.Image.OnError(this)" alt="{{ $asset->creator->username }}" class=" notranslate" />@if($creatorBcOverlay) <img src="{{ $creatorBcOverlay }}" class="bcOverlay" align="left" style="position:relative;top:-19px;" /> @endif</a>
                            </div>
                        </div>
                        <div class="item-detail">
                            <span class="stat-label notranslate">Creator:</span>
                            <a id="ctl00_cphLunarix_CreatorHyperLink" class="stat notranslate" href="User.aspx?ID={{ $asset->creator_id }}">{{ $asset->creator->username }}</a>
                            
                            <div>
                                <span class="stat-label">Created:</span>
                                <span class="stat">
                                    {{ $asset->created_at->format('n/j/Y') }}
                                </span>
                            </div>
                            <div id="LastUpdate">
                                <span class="stat-label">Updated:</span>
                                <span class="stat">
                                    {{ $asset->updated_at->diffForHumans() }}
                                </span>
                                </div>
                                
                                 
                        </div>
                        <div id="ctl00_cphLunarix_DescriptionPanel" class="DescriptionPanel notranslate">
	
                            <pre class="Description Full text"> {{ $asset->description }} </pre>
                            <pre class="Description body text"><span class="description-content">{{ $asset->description }}</span><span class="description-more-container"></span></pre>
                        
</div>
                        <div class="ReportAbuse">
                            <div id="ctl00_cphLunarix_AbuseReportButton1_AbuseReportPanel" class="ReportAbuse">
	
    <span class="AbuseIcon"><a id="ctl00_cphLunarix_AbuseReportButton1_ReportAbuseIconHyperLink" href="abusereport/asset?id={{ $asset->id }}&amp;RedirectUrl=item.aspx%3fseoname%3dThrowing-Knife-Pen%26id%3d{{ $asset->id }}"><img src="images/abuse.PNG?v=2" alt="Report Abuse" style="border-width:0px;" /></a></span>
    <span class="AbuseButton"><a id="ctl00_cphLunarix_AbuseReportButton1_ReportAbuseTextHyperLink" href="abusereport/asset?id={{ $asset->id }}&amp;RedirectUrl=item.aspx%3fseoname%3dThrowing-Knife-Pen%26id%3d{{ $asset->id }}">Report Abuse</a></span>

</div>
                        </div>
                        
                        
                        
                        
                        
                        @if((int) $asset->type === \App\Models\Asset::TYPE_GEAR)
                        <div class="GearGenreContainer divider-top">
                            <div id="GenresDiv">
                                <div id="ctl00_cphLunarix_Genres">
	
                                    <div class="stat-label">
                                        Genres:</div>
                                    <div class="GenreInfo stat">
                                        

<div>
    
            
        
            
        
            
        
            
        
            
        
            
        
            
        
            
        
            
        
            
        
            
        
            
        
            
        
            <div id="ctl00_cphLunarix_GenresDisplayTest_AssetGenreRepeater_ctl13_AssetGenreRepeaterPanel" class="AssetGenreRepeater_Container">
		
                <div class="GamesInfoIcon Ninja"></div>
                <div><a href="/fighting-catalog">Fighting</a></div>
            
	</div>
        
            
        
    <div style="clear:both;"></div>
</div>
                                    </div>
                                
</div>
                            </div>
                            <div id="ctl00_cphLunarix_GearAttributes" class="GearDiv">
	
                                    <div class="stat-label">
                                        Gear Attributes:</div>
                                    <div class="stat">
                                        


<div>
    
            
        
            
        
            <div id="ctl00_cphLunarix_GearOptionsDisplay_AllowedGearRepeater_ctl02_AllowGearRepeaterPanel" class="AllowedGearRepeater_Container">
		
                <div class="GamesInfoIcon Ranged"></div>
                <div>Ranged Weapon</div>
            
	</div>
        
            
        
            
        
            
        
            
        
            
        
            
        
            
        
    <div style="clear:both;"></div>
</div>
                                        <div class="clear"></div>
                                    </div>
                            
</div>
                            <div class="clear"></div>
                        </div>
                        @endif
                        <div class="PluginMessageContainer" style="display: none;">
                            <p>
                                <span class="status-confirm">A newer version is available.</span>
                            </p>
                        </div>
                    </div>
                    <div class="BuyPriceBoxContainer">
                        <div class="BuyPriceBox">
                            
                            
                            
                            
                            @if(!$asset->isSoldOut() || !$asset->is_limited)
                            <div id="ctl00_cphLunarix_RobuxPurchasePanel">
                                <div id="RobuxPurchase">
                                @if($asset->is_limited || $asset->isSoldOut())
                                <div class="urgent-text">{{ number_format($asset->remainingQuantity()) }} remaining</div>
                                @endif
                                    <div class="calloutParent">
                                        Price: <span class="robux {{ $asset->robux == 0 ? '' : '' }}" data-se="item-priceinrobux">
                                            {{ $asset->robux == 0 ? 'FREE' : $asset->robux }}
                                        </span>

                                    </div>
                                    <div id="BuyWithRobux">
                                    @if($userOwns)
                                    <a class="btn-primary lunarix-buy-now btn-medium btn-disabled-primary" original-title="You already own this item." href="javascript: return false;">Buy Now <span class="btn-text">Buy Now</span></a>
                                    @elseif(!$asset->onsale || $asset->isSoldOut())
                                    <a class="btn-primary lunarix-buy-now btn-medium btn-disabled-primary" original-title="This item is no longer for sale." href="javascript: return false;">Buy Now <span class="btn-text">Buy Now</span></a>
                                    @else
                                        <div data-expected-currency="1" data-asset-type="{{ $asset->getTypeName() }}" class="btn-primary btn-medium PurchaseButton " data-se="item-buyforrobux" data-item-name="{{ $asset->name }}" data-item-id="{{ $asset->id }}" data-expected-price="{{ $asset->robux }}" data-product-id="{{ $asset->id }}" data-expected-seller-id="{{ $asset->creator_id }}" data-bc-requirement="0" data-seller-name="{{ $asset->creator->username }}">
                                             {{ $asset->robux == 0 ? 'Take Now' : 'Buy with B$' }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            @else
                            @if($privateSales->isEmpty())
                            <div id="ctl00_cphLunarix_PrivateSalesPurchasePanel" class="PrivateSalesPurchasePanel">
                                <span class='Price invisible'>
                                    Best Price: <span class="robux " data-se="item-privatesale-price">0</span>
                                </span>
                                
                                <br />
                                <a href="#UserSalesTab" class='invisible'>See all private sellers (0)</a>
                                <span class=''>No one is currently selling this item.</span>
                            </div>
                            @else
                            <div id="ctl00_cphLunarix_PrivateSalesPurchasePanel" class="PrivateSalesPurchasePanel">
                                @php $bestSale = $bestPrivateSale; @endphp
                                @if($bestSale)
                                <span class='Price '>
                                    Best Price: <span class="robux " data-se="item-privatesale-price">{{ $bestSale->price }}</span>
                                </span>
                                <div data-expected-currency="1" data-asset-type="{{ $asset->getTypeName() }}" class="lunarix-buy-now btn-primary btn-medium PurchaseButton " data-se="item-privatesale-buyforbestprice" data-item-name="{{ $asset->name }}" data-item-id="{{ $asset->id }}" data-expected-price="{{ $bestSale->price }}" data-product-id="{{ $asset->id }}" data-expected-seller-id="{{ $bestSale->user_id }}" data-userasset-id="{{ $bestSale->guid }}" data-bc-requirement="0" data-seller-name="{{ $bestSale->seller->username }}">
                                        Buy Now
                                </div>
                                <br />
                                <a href="#UserSalesTab" class=''>See all private sellers</a>
                                @else
                                <span class='invisible'>No one is currently selling this item.</span>
                                @endif
                            </div>
                            <div class="clear">
                            </div>
                            @endif
                            @endif                            
                            
                            
                            <div class="clear">
                            </div>
                            <div class="footnote">
	                            
                                
                                <div id="ctl00_cphLunarix_Sold">
                                    (<span data-se="item-numbersold">{{ $asset->sales_count }}</span> 
                                    Sold)
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <span>
                                <span class="FavoriteStar" data-se="item-numberfavorited">
                                    {{ $asset->favourites }} 
                                </span>
                                
                        </span>
                        
                        <div class="SocialMediaBar divider-top">
                               <p class="catchy-title ">
                                    <span>Share with your friends</span>
                                    <span class="info-tool-tip tooltip" title="Share Lunarix with your friends and earn ROBUX every time they make a purchase.">&nbsp;</span>
                               </p>
                                <div id="social-media-bar-target"></div>
                            <script>
                                var ua = new gigya.socialize.UserAction();
                                ua.setLinkBack("https://{{ config('app.base_url_nohttp') }}/{{ $asset->getSlug() }}-item.aspx?id={{ $asset->id }}");
                                ua.setTitle("Lunarix: {{ $asset->name }}");

                                var twitter_ua = new gigya.socialize.UserAction();
                                twitter_ua.setLinkBack("https://{{ config('app.base_url_nohttp') }}/{{ $asset->getSlug() }}-item.aspx?id={{ $asset->id }}");
                                twitter_ua.setTitle("{{ $asset->name }} via @LunarixRev");

                                var shareButtons = [
                                    {
                                        'provider': "Twitter",
                                        'enableCount': "true",
                                        'iconImgUp': "https://cdn.lunarix.lol/d75e7a07fd4db793d79060cc5976cb29.png",
                                        'userAction': twitter_ua
                                    }
                                ];

                                var params = {
                                    userAction: ua,
                                    shareButtons: shareButtons,
                                    containerID: "social-media-bar-target",
                                    deviceType: "auto",
                                    iconsOnly: "true",
                                    buttonWithCountTemplate: "<div class='social-button-template'><img src='$iconImg' class='social-button-icon-img' onclick='$onClick'><div class='social-button-counter'>$count</div></div>",
                                    buttonTemplate: "<div class='social-button-template'><img src='$iconImg' class='social-button-icon-img' onclick='$onClick'><div class='social-button-counter'>-</div></div>",
                                    showEmailButton: false,
                                    countURL: "https://{{ config('app.base_url_nohttp') }}/{{ $asset->getSlug() }}-item.aspx?id={{ $asset->id }}"
                                }
                                gigya.socialize.showShareBarUI(params);
                            </script>
                                <input class="social-media-bar-copy-to-clipboard text-box text-box-large" type="text" value="https://{{ config('app.base_url_nohttp') }}/{{ $asset->getSlug() }}-item.aspx?id={{ $asset->id }}" readonly="true" />
                                <script>
                                    $(function () {
                                        $(".social-media-bar-copy-to-clipboard")
                                            .on("click", function () {
                                                $(".social-media-bar-copy-to-clipboard").select();
                                            });
                                    });
                                </script>
                        </div>
                        
                    </div>
                    <div class="clear"></div>
                    <div class="SocialMediaContainer">
                        
                    </div>
                </div>
                
                
                <div class="clear"></div>
            </div>
            @if($asset->is_limited && $asset->isSoldOut())
            <div class="PrivateSales divider-top " >
                <h2>Private Sales</h2>
                <div id="UserSalesTab" >
                    @if($privateSales->isEmpty())
                    <div class="empty">Sorry, no one is privately selling this item at the moment.</div>
                    @else
                            <table class="ItemSalesTable">
                            @foreach($privateSales as $index => $sale)
                                <tr Visible='True'>
                                    <td>
                                        <a id="ctl00_cphLunarix_lstItemsForResale_ctrl{{ $index }}_AvatarImage2" class=" notranslate" title="{{ $sale->seller->username }}" href="/users/{{ $sale->seller->id }}/profile" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
                                            <img src="/Thumbs/Avatar.ashx?userId={{ $sale->seller->id }}" height="48" width="48" border="0" onerror="return Lunarix.Controls.Image.OnError(this)" alt="{{ $sale->seller->username }}" class=" notranslate" />
                                        </a>
                                    </td>
                                    <td class="SellerNameAndSerial">
                                        <p class="SellerName">
                                            <a href="/users/{{ $sale->seller->id }}/profile">
                                                {{ $sale->seller->username }}
                                            </a>
                                        </p>
                                        <span class="robux " original-title='{{ $sale->price }} B$' >
                                            {{ $sale->price }}
                                        </span>
                                        @if($sale->serial)
                                        <p class="SerialNum ">
                                            Serial #{{ $sale->serial }} of {{ $asset->limited_quantity }}
                                        </p>
                                        @endif
                                    </td>
                                    <td id="ctl00_cphLunarix_lstItemsForResale_ctrl{{ $index }}_Td1" class="PriceBuyContainer">
                                        @if(auth()->check() && auth()->id() === $sale->user_id)
                                        <div class="btn-small btn-negative" onclick="Lunarix.Item.openTakeOffSale('{{ $sale->guid }}'); return false;">Take off</div>
                                        @else
                                        <div class=" lunarix-buy-now btn-primary btn-small PurchaseButton "
                                         data-item-id="{{ $asset->id }}"
                                         data-item-name="{{ $asset->name }}"
                                         data-userasset-id="{{ $sale->guid }}"
                                         data-product-id="{{ $asset->id }}"
                                         data-expected-price="{{ $sale->price }}"
                                         data-asset-type="{{ $asset->getTypeName() }}"
                                         data-expected-currency="1"
                                         data-expected-seller-id="{{ $sale->user_id }}"
                                         data-bc-requirement="0"
                                         data-seller-name="{{ $sale->seller->username }}" >Buy Now</div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </table>
                    @endif
                  <div class="pgItemsForResale">
                      <span id="ctl00_cphLunarix_pgItemsForResale">
                          @if($privateSales->onFirstPage())
                          <a disabled="disabled">First</a>&nbsp;<a disabled="disabled">Previous</a>&nbsp;
                          @else
                          <a href="?id={{ $asset->id }}&page=1">First</a>&nbsp;<a href="?id={{ $asset->id }}&page={{ $privateSales->currentPage() - 1 }}">Previous</a>&nbsp;
                          @endif
                          @php
                          $current = $privateSales->currentPage();
                          $last = $privateSales->lastPage();
                          $window = 2;
                          @endphp
                          @for($p = 1; $p <= $last; $p++)
                              @if($p == 1 || $p == $last || ($p >= $current - $window && $p <= $current + $window))
                                  @if($p == $current)
                                  <span>{{ $p }}</span>&nbsp;
                                  @else
                                  <a href="?id={{ $asset->id }}&page={{ $p }}">{{ $p }}</a>&nbsp;
                                  @endif
                              @elseif($p == $current - $window - 1 || $p == $current + $window + 1)
                              <a href="?id={{ $asset->id }}&page={{ $p }}">...</a>&nbsp;
                              @endif
                          @endfor
                          @if($privateSales->hasMorePages())
                          <a href="?id={{ $asset->id }}&page={{ $privateSales->currentPage() + 1 }}">Next</a>&nbsp;<a href="?id={{ $asset->id }}&page={{ $last }}">Last</a>&nbsp;
                          @else
                          <a disabled="disabled">Next</a>&nbsp;<a disabled="disabled">Last</a>&nbsp;
                          @endif
                      </span>
                  </div>
                </div>
                <div id="ctl00_cphLunarix_PriceGraph" class="PriceGraph divider-left ">
                    
    @if($hasRapData)
    <div style="margin-left: 10px;">

    <p class="header text">
        Recent Average Price: <span class="robux-text">B$ {{ number_format($currentRap) }}</span>
    </p>

    <p class="Options">
        <span id="days30" class="selected-text">30 Days</span>&nbsp;|&nbsp;
        <span id="days90">90 Days</span>&nbsp;|&nbsp;
        <span id="days180">180 Days</span>
    </p>

    <div id="placeholder" style="width:370px;height:300px;"></div>
    <div id="volumegraph"  style="width:370px;height:60px;"></div>
    
    <div style="margin-left: 20px;">
        <p class="pricestats">
            <span class="days30 selected-text">30 Day Avg Price: <span class="robux-text">{{ number_format($currentRap) }} B$
                 (<font color="{{ $percentChange30 >= 0 ? '#008000' : '#c00000' }}">{{ $percentChange30 >= 0 ? '+' : '' }}{{ $percentChange30 }}%</font>)</span> &nbsp;&nbsp; Volume: <b>{{ number_format($volume30) }}</b>
            </span>
            <span class="days90">90 Day Avg Price: <span class="robux-text">{{ number_format($currentRap) }} B$
                 (<font color="{{ $percentChange90 >= 0 ? '#008000' : '#c00000' }}">{{ $percentChange90 >= 0 ? '+' : '' }}{{ $percentChange90 }}%</font>)</span> &nbsp;&nbsp; Volume: <b>{{ number_format($volume90) }}</b>
            </span>
            <span class="days180">180 Day Avg Price: <span class="robux-text">{{ number_format($currentRap) }} B$
                 (<font color="{{ $percentChange180 >= 0 ? '#008000' : '#c00000' }}">{{ $percentChange180 >= 0 ? '+' : '' }}{{ $percentChange180 }}%</font>)</span> &nbsp;&nbsp; Volume: <b>{{ number_format($volume180) }}</b>
            </span>
        </p>
    </div>
    
    <script id="source" type="text/javascript"> 
    $(function () {
        
        var d1 = @json($priceGraphData); var d2 = @json($volumeGraphData);
        
        function numberWithCommas(x) {
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }

        function formatGraphTicks(v, axis) {
            var result;
            if(v > 1000000000) {
                result = (v/1000000000).toFixed(axis.tickDecimals)+"B B$";
            }else if(v > 1000000) {
                result = (v/1000000).toFixed(axis.tickDecimals)+"M B$";
            }
            else {
                result = v.toFixed(axis.tickDecimals);
            }

            return numberWithCommas(result) + " B$";
        }

        $.plot($("#placeholder"), [ 
                                    {data: d1, label: "Avg Sales Price (B$)", color: "#000000", lines: {lineWidth: 3}}

                                    ],
                                {
                                    xaxis: { mode: 'time',timeformat: "%m/%d", min: 1446421002459 },
                                    legend: {position: 'nw' },
                                    yaxis: {labelWidth: 40, tickFormatter: formatGraphTicks}
                                });

        $.plot($("#volumegraph"), [ 
                                    {data: d2, label: "Volume", yaxis: 1, color: "#A4A4C8", bars: { show: true }}
                                    ],
                                {
                                    xaxis: { mode: 'time', ticks: [],  min: 1446421002459 },
                                    legend: {position: 'nw' },
                                    yaxis: {labelWidth: 40, minTickSize: 1, tickDecimals: 0, ticks: []}
                                });


        $("#days180").click(function (event) {
            $.plot($("#placeholder"),
                [{data: d1, label: "Avg Sales Price (B$)", color: "#000000", lines: {lineWidth: 3}}],
                {
                    xaxis: { mode: 'time' ,timeformat: "%m/%d", min: 1433461002459 },
                    legend: {position: 'nw' },
                    yaxis: {labelWidth: 40, tickFormatter: formatGraphTicks}
                });
            $.plot($("#volumegraph"),
                [{data: d2, label: "Volume", yaxis: 1, color: "#A4A4C8", bars: { show: true }}],
                {
                    xaxis: { mode: 'time', ticks: [],  min: 1433461002459 },
                    legend: {position: 'nw' },
                    yaxis: {labelWidth: 40, minTickSize: 1, tickDecimals: 0, ticks: []}
                });
            
            $('.Options span,.pricestats span').removeClass('selected-text');
            $(event.target).addClass('selected-text');
            $('.pricestats .days180').addClass('selected-text');
        });
        
        $("#days30").click(function (event) {
            
            $.plot($("#placeholder"), [ 
                                    {data: d1, label: "Avg Sales Price (B$)", color: "#000000", lines: {lineWidth: 3}}

                                    ],
                                {
                                    xaxis: { mode: 'time' ,timeformat: "%m/%d", min: 1446421002459 },
                                    legend: {position: 'nw' },
                                    yaxis: {labelWidth: 40, tickFormatter: formatGraphTicks }
                                });

            $.plot($("#volumegraph"), [ 
                                    {data: d2, label: "Volume", yaxis: 1, color: "#A4A4C8", bars: { show: true }}
                                    ],
                                {
                                    xaxis: { mode: 'time', ticks: [], min: 1446421002459 },
                                    legend: {position: 'nw' },
                                    yaxis: {labelWidth: 40, minTickSize: 1, tickDecimals: 0, ticks: []}
                                });
            $('.Options span,.pricestats span').removeClass('selected-text');
            $(event.target).addClass('selected-text');
            $('.pricestats .days30').addClass('selected-text');
        });
     
        $("#days90").click(function (event) {
            
            $.plot($("#placeholder"), [ 
                                    {data: d1, label: "Avg Sales Price (B$)", color: "#000000", lines: {lineWidth: 3}}

                                    ],
                                {
                                    xaxis: { mode: 'time' ,timeformat: "%m/%d", min: 1441237002459 },
                                    legend: {position: 'nw' },
                                    yaxis: {labelWidth: 40, tickFormatter: formatGraphTicks }
                                });

            $.plot($("#volumegraph"), [ 
                                    {data: d2, label: "Volume", yaxis: 1, color: "#A4A4C8", bars: { show: true }}
                                    ],
                                {
                                    xaxis: { mode: 'time', ticks: [], min: 1441237002459 },
                                    legend: {position: 'nw' },
                                    yaxis: {labelWidth: 40, minTickSize: 1, tickDecimals: 0, ticks: []}
                                });
            $('.Options span,.pricestats span').removeClass('selected-text');
            $(event.target).addClass('selected-text');
            $('.pricestats .days90').addClass('selected-text');
        });

    });

    </script>
    </div>
    @else
    Historical Data Not Available for this Item
    @endif
    


                </div>
                
                <div class="clear"></div>
            </div>
            @else
            <div class="PrivateSales divider-top invisible" >
                <h2>Private Sales</h2>
                <div id="UserSalesTab" >
                    
                    
                            <div class="empty">
                                Sorry, no one is privately selling this item at the moment.
                            </div>
                        
                    <div class="pgItemsForResale">
                        <span id="ctl00_cphLunarix_pgItemsForResale"><a disabled="disabled">First</a>&nbsp;<a disabled="disabled">Previous</a>&nbsp;<a disabled="disabled">Next</a>&nbsp;<a disabled="disabled">Last</a>&nbsp;</span>
                    </div>
                </div>
                
                
                <div class="clear"></div>
            </div>
            @endif
            <div id="Tabs">
                <ul id="TabHeader" class="WhiteSquareTabsContainer">
                      
                            <li id="RecommendationsTabHeader" contentid="RecommendationsTab" class="SquareTabGray ItemTabs selected">
                                                <span><a id="RecommendationsLink" href="#RecommendationsTab">
                                                    Recommendations</a></span></li>
                      
                      <li id="CommentaryTabHeader" contentid="CommentaryTab" class="SquareTabGray ItemTabs ">
                                                <span><a id="CommentaryLink" href="#CommentaryTab">
                                                    Commentary</a></span></li>
                </ul>
                <div class="StandardPanelContainer">
                    <div id="RecommendationsTab" class="StandardPanelWhite TabContent selected">
                        

    <div class="AssetRecommenderContainer">
    <table id="ctl00_cphLunarix_AssetRec_dlAssets" cellspacing="0" align="Center" border="0" style="height:175px;width:800px;border-collapse:collapse;">
	<tr>
        @foreach($recommendations->take(5) as $index => $rec)
		<td>
            <div class="PortraitDiv" style="width: 140px;overflow: hidden;margin:auto;" visible="True" data-se="recommended-items-{{ $index }}">
                <div class="AssetThumbnail">
                    <a id="ctl00_cphLunarix_AssetRec_dlAssets_ctl00_AssetThumbnailHyperLink" class=" notranslate" title="{{ $rec->name }}" class=" notranslate" href="/{{ $rec->getSlug() }}-item?id={{ $rec->id }}" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="/Thumbs/Asset.ashx?assetId={{ $rec->id }}" height="110" width="110" border="0" onerror="return Lunarix.Controls.Image.OnError(this)" alt="{{ $rec->name }}" class=" notranslate" /></a>
                </div>
                <div class="AssetDetails">
                    <div class="AssetName noTranslate">
                        <a id="ctl00_cphLunarix_AssetRec_dlAssets_ctl00_AssetNameHyperLinkPortrait" href="/{{ $rec->getSlug() }}-item?id={{ $rec->id }}">{{ $rec->name }}</a>
                    </div>
                    <div class="AssetCreator">
                        <span class="stat-label">Creator:</span> <span class="Detail stat"><a id="ctl00_cphLunarix_AssetRec_dlAssets_ctl00_CreatorHyperLinkPortrait" class="notranslate" href="User.aspx?ID={{ $rec->creator_id }}">{{ $rec->creator->username }}</a></span>
                    </div>
                </div>
            </div>
        </td>
        @endforeach
	</tr>
</table>
    
</div>

<script type="text/javascript">
    $(function () {
        var itemNames = $('.PortraitDiv .AssetDetails .AssetName a');
        $.each(itemNames, function (index) {
            var elem = $(itemNames[index]);
            elem.html(fitStringToWidthSafe(elem.html(), 200));
        });
        var userNames = $('.PortraitDiv .AssetDetails .AssetCreator .Detail a');
        $.each(userNames, function (index) {
            var elem = $(userNames[index]);
            elem.html(fitStringToWidthSafe(elem.html(), 70));
        });
    });
</script>

                    </div>
                    <div id="CommentaryTab" class="StandardPanelWhite TabContent " >
                        <div id="ctl00_cphLunarix_CommentsPane_CommentsUpdatePanel">
	
        <div id="AjaxCommentsPaneData"></div>

        <div class="AjaxCommentsContainer">
            
            <div class="Comments" data-asset-id="{{ $asset->id }}"></div>
            
            <div class="CommentsItemTemplate">
                    <div class="Comment text">
                        <div class="Commenter">
                            <div class="Avatar" data-user-id="%CommentAuthorID" data-image-size="small">
                            </div>
                        </div>
                        <div class="PostContainer">
                            <div class="Post">
                                <div class="Audit">
                                    <span class="ByLine footnote"><div class="UserOwnsAsset" title="User has this item" alt="User has this item" style="display:none;"></div>Posted %CommentCreated ago by <a href="/user.aspx?id=%CommentAuthorID">%CommentAuthor</a></span>
                                    <div class="ReportAbuse">
                                        <span class="AbuseButton">
                                            <a href="/abusereport/comment?id=%CommentID&amp;redirectUrl=%PageURL">Report Abuse</a>
                                        </span>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div class="Content">
                                    %CommentContent
                                </div>
                                <div id="Actions" class="Actions" >
                                    <a data-comment-id="%CommentID" class="DeleteCommentButton">Delete Comment</a>
                                </div>
                            </div>
                            <div class="PostBottom"></div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
        </div>

</div>

<script type="text/javascript">
    Lunarix.CommentsPane.Resources = {
        //<sl:translate>
        defaultMessage:         'Write a comment!',
        noCommentsFound:		'No comments found.',
        moreComments:			'More comments',
        sorrySomethingWentWrong:'Sorry, something went wrong.',
        charactersRemaining:	' characters remaining',
        emailVerifiedABTitle:	'Verify Your Email',
        emailVerifiedABMessage: "You must verify your email before you can comment. You can verify your email on the <a href='/my/account?confirmemail=1'>Account</a> page.",
        linksNotAllowedTitle:   'Links Not Allowed',
        linksNotAllowedMessage: 'Comments should be about the item or place on which you are commenting. Links are not permitted.',
        accept:					'Verify',
        decline:				'Cancel',
        tooManyCharacters:		'Too many characters!',
        tooManyNewlines:		'Too many newlines!'
        //</sl:translate>
       };

       Lunarix.CommentsPane.Limits =
       [	{ limit: '10'
            , character: "\n"
            , message: Lunarix.CommentsPane.Resources.tooManyNewlines
            }
       ,	{ limit: '200'
            , character: undefined
            , message: Lunarix.CommentsPane.Resources.tooManyCharacters
            }
       ];

       Lunarix.CommentsPane.FilterIsEnabled = true;
       Lunarix.CommentsPane.FilterRegex = "(([a-zA-Z0-9-]+\\.[a-zA-Z]{2,4}[:\\#/\?]+)|([a-zA-Z0-9]\\.[a-zA-Z0-9-]+\\.[a-zA-Z]{2,4}))";
       Lunarix.CommentsPane.FilterCleanExistingComments = false;

    Lunarix.CommentsPane.initialize();
</script>

                    </div>
                </div>
            </div>
            
            <div id="FreeGames">
                <div class='SEOLinksContainer'><span><b>Other free games and items:</b></span><ul class='freegames'>@foreach($freeItems as $freeItem) <li><a class='notranslate' href='/{{ $freeItem->getSlug() }}-item?id={{ $freeItem->id }}' title='Free Games: {{ $freeItem->name }}'>{{ $freeItem->name }}</a></li> @endforeach</ul></div></div>
        </div>
        <div class="Ads_WideSkyscraper">
            

    <iframe allowtransparency="true"
            frameborder="0"
            height="612"
            scrolling="no"
            src="/userads/2"
            width="160"
            data-js-adtype="iframead"></iframe>

        </div>
        <div class="clear">
        </div>
    </div>
    
    
    

<div id="ItemPurchaseAjaxData"
        data-authenticateduser-isnull="{{ auth()->check() ? 'False' : 'True' }}"
        data-user-balance-robux="{{ auth()->check() ? auth()->user()->moons : '?' }}"
        data-user-balance-tickets="?"
        data-user-bc="{{ auth()->check() ? (int) auth()->user()->membership : '0' }}"
        data-continueshopping-url="/catalog"
        data-imageurl="/Thumbs/Asset.ashx?assetId={{ $asset->id }}" 
        data-alerturl="https://cdn.lunarix.lol/cbb24e0c0f1fb97381a065bd1e056fcb.png"
        data-bloxxerscluburl="https://cdn.lunarix.lol/ae345c0d59b00329758518edc104d573.png"
        data-has-currency-service-error="False"
        data-currency-service-error-message=""></div>

    <div id="ProcessingView" style="display:none">
        <div class="ProcessingModalBody">
            <p style="margin:0px"><img src='https://cdn.lunarix.lol/ec4e85b0c4396cf753a06fade0a8d8af.gif' alt="Processing..." /></p>
            <p style="margin:7px 0px">Processing Transaction</p>
        </div>
    </div>
    
    <script type="text/javascript">
        //<sl:translate>
        Lunarix.ItemPurchase.strings = {
            insufficientFundsTitle : "Insufficient Funds",
            insufficientFundsText : "You need {0} more to purchase this item.",
            cancelText : "Cancel",
            okText : "OK",
            buyText : "Buy",
            buyTextLower : "buy",
            tradeCurrencyText : "Trade Currency",
            priceChangeTitle : "Item Price Has Changed",
            priceChangeText : "While you were shopping, the price of this item changed from {0} to {1}.",
            buyNowText : "Buy Now",
            buyAccessText: "Buy Access",
            buildersClubOnlyTitle : "{0} Only",
            buildersClubOnlyText : "You need {0} to buy this item!",
            buyItemTitle : "Buy Item",
            buyItemText : "Would you like to {0} {5}the {1} {2} from {3} for {4}?",
            balanceText : "Your balance after this transaction will be {0}",
            freeText : "Free",
            purchaseCompleteTitle : "Purchase Complete!",
            purchaseCompleteText : "You have successfully {0} {5}the {1} {2} from {3} for {4}.",
            continueShoppingText : "Continue Shopping",
            customizeCharacterText : "Customize Character",
            orText : "or",
            rentText : "rent",
            accessText: "access to "
        }
        //</sl:translate>
    </script>

    @if($asset->is_limited || $asset->is_limited_unique && $asset->isSoldOut())
@if(auth()->check() && (int) auth()->user()->membership > 0)
<div id="SellItemModalContainer" class="PurchaseModal" style="display:none;">
    <div class="titleBar">
        Sell Your Collectible Item
    </div>
    <div id="ResalePanel" class="PurchaseModalBody">
        <div class="PurchaseModalMessage">
            <div class="PurchaseModalMessageImage">
                <a disabled="disabled" title="{{ $asset->name }}" onclick="return false" style="display:inline-block;height:110px;width:110px;"><img src="/Thumbs/Asset.ashx?assetId={{ $asset->id }}" height="110" width="110" border="0" alt="{{ $asset->name }}" /></a>
            </div>
            <div class="PurchaseModalMessageText">
                <script type="text/javascript">
                    Lunarix.Item.setMarketPlaceFee(0.3);
                </script>
                <div>
                    @if(($asset->is_limited || $asset->is_limited_unique) && $userOwnedCopies->count() > 1)
                    <div style="margin-bottom:8px;">
                        Which copy: <select id="SerialSelect" style="width:150px;">
                            @foreach($userOwnedCopies as $copy)
                            <option value="{{ $copy->guid }}">
                                @if($asset->is_limited_unique)
                                    Serial #{{ $copy->serial_number }}
                                @else
                                    GUID {{ strtoupper(substr($copy->guid, 0, 8)) }}
                                @endif
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @elseif(($asset->is_limited || $asset->is_limited_unique) && $userOwnedCopies->count() === 1)
                    <input type="hidden" id="SerialSelect" value="{{ $userOwnedCopies->first()->guid }}">
                    @endif
                    Price (minimum 1): <span class="robux notranslate"></span><input type="text" id="PriceInput" name="price" value="" style="width: 75px;" onkeyup="Lunarix.Item.validateResellInput()">
                    <br />
                    Marketplace fee at 30%: <span class="lblCommision"></span>
                    <br />
                    You get: <span class="lblLeftover"></span>
                    <br />
                    <span class="error-message" style="display:none;color:#c00000;"></span>
                    <br />
                </div>
            </div>
        </div>
        <div class="PurchaseModalButtonContainer">
            <div class="btn-medium btn-primary" onclick="Lunarix.Item.confirmSell({{ $asset->id }})">
                Sell Now
            </div>
            <div class="btn-medium btn-negative" onclick="ModalClose('SellItemModalContainer')">
                Cancel
            </div>
        </div>
        <div class="PurchaseModalFooter footnote"></div>
    </div>
</div>
@else
<div id="SellItemModalContainer" class="PurchaseModal" style="display:none;">
    <div class="titleBar">
        Sell Your Collectible Item
    </div>
    <div id="ResalePanel" class="PurchaseModalBody">
        <div class="PurchaseModalMessage">
            <div class="PurchaseModalMessageImage">
                <a disabled="disabled" title="{{ $asset->name }}" onclick="return false" style="display:inline-block;height:110px;width:110px;"><img src="/Thumbs/Asset.ashx?assetId={{ $asset->id }}" height="110" width="110" border="0" alt="{{ $asset->name }}" /></a>
            </div>
            <div class="PurchaseModalMessageText">
                <script type="text/javascript">
                    Lunarix.Item.setMarketPlaceFee(0.3);
                </script>
                <div>
                    Only Bloxxers Club members
                    <br />
                    may re-sell collectible items for B$
                    <br />
                </div>
            </div>
        </div>
        <div class="PurchaseModalButtonContainer">
            <a href="/premium/membership" class="btn-medium btn-primary">Get BC Today</a>
            <div class="btn-medium btn-negative" onclick="ModalClose('SellItemModalContainer')">
                Cancel
            </div>
        </div>
        <div class="PurchaseModalFooter footnote"></div>
    </div>
</div>
@endif

<div id="TakeOffSaleModalContainer" class="PurchaseModal" style="display:none;">
    <div class="titleBar">
        Take Off Sale
    </div>
    <div id="TakeOffSalePanel" class="PurchaseModalBody">
        <div class="PurchaseModalMessage">
            <div class="PurchaseModalMessageImage">
                <a disabled="disabled" title="{{ $asset->name }}" onclick="return false" style="display:inline-block;height:110px;width:110px;"><img src="/Thumbs/Asset.ashx?assetId={{ $asset->id }}" height="110" width="110" border="0" alt="{{ $asset->name }}" /></a>
            </div>
            <div class="PurchaseModalMessageText">
                <div>
                    <span>
                        Are you sure you want to take the Item off sale?
                    </span>
                </div>
            </div>
        </div>
        <div class="PurchaseModalButtonContainer">
            <div class="btn-medium btn-primary" onclick="Lunarix.Item.confirmTakeOffSale()">
                Confirm
            </div>
            <div class="btn-medium btn-negative" onclick="ModalClose('TakeOffSaleModalContainer')">
                Cancel
            </div>
        </div>
        <div class="PurchaseModalFooter footnote"></div>
    </div>
</div>
@endif
    

    <div id="ctl00_cphLunarix_CreateSetPanelDiv" class="createSetPanelPopup">
	
        
    
</div>
    
     

<div class="GenericModal modalPopup unifiedModal smallModal" style="display:none;">
    <div class="Title"></div>
    <div class="GenericModalBody">
        <div>
            <div class="ImageContainer lunarix-item-image"  data-image-size="small" data-no-overlays data-no-click>
                <img class="GenericModalImage" alt="generic image" />
            </div>
            <div class="Message"></div>  
            <div style="clear:both"></div>
        </div>
        <div class="GenericModalButtonContainer">
            <a class="ImageButton btn-neutral btn-large lunarix-ok">OK</a> 
        </div>  
    </div>
</div>

    

<div id="BCOnlyModal" class="modalPopup unifiedModal smallModal" style="display:none;">
 	<div style="margin:4px 0px;">
        <span>Bloxxers Club Only</span>
    </div>
    <div class="simplemodal-close">
        <a class="ImageButton closeBtnCircle_20h" style="margin-left:400px;"></a>
    </div>
    <div class="unifiedModalContent" style="padding-top:5px; margin-bottom: 3px; margin-left: 3px; margin-right: 3px">
        <div class="ImageContainer" >
            <img class="GenericModalImage BCModalImage" alt="Builder's Club" src="https://cdn.lunarix.lol/ae345c0d59b00329758518edc104d573.png" />
            <div id="BCMessageDiv" class="BCMessage Message">
                You need  to buy this item!
            </div>
        </div>
        <div style="clear:both;"></div>
        <div style="clear:both;"></div>
        <div class="GenericModalButtonContainer" style="padding-bottom: 13px">
            <div style="text-align:center">
                <a id="BClink" href="/Upgrades/BloxxersClubMemberships.aspx" class="btn-primary btn-large">Upgrade Now</a>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div style="clear:both;"></div>
    </div>
</div>

<script type="text/javascript">
    function showBCOnlyModal(modalId) {
        var modalProperties = { overlayClose: true, escClose: true, opacity: 80, overlayCss: { backgroundColor: "#000" } };
        if (typeof modalId === "undefined")
            $("#BCOnlyModal").modal(modalProperties);
        else
            $("#" + modalId).modal(modalProperties);
    }
    $(document).ready(function () {
        $('#NULL').click(function () {
            showBCOnlyModal("BCOnlyModal");
            return false;
        });
    });
</script>
 

<div class="GenericModal modalPopup unifiedModal smallModal" style="display:none;">
    <div class="Title"></div>
    <div class="GenericModalBody">
        <div>
            <div class="ImageContainer lunarix-item-image"  data-image-size="small" data-no-overlays data-no-click>
                <img class="GenericModalImage" alt="generic image" />
            </div>
            <div class="Message"></div>  
            <div style="clear:both"></div>
        </div>
        <div class="GenericModalButtonContainer">
            <a class="ImageButton btn-neutral btn-large lunarix-ok">OK</a> 
        </div>  
    </div>
</div>


    <div id="InstallingPluginView" class="processing-view" style="display:none">
        <div class="ProcessingModalBody">
            <p style="margin:0px"><img src='https://cdn.lunarix.lol/ec4e85b0c4396cf753a06fade0a8d8af.gif' alt="Installing Plugin..." /></p>
            <p class="processing-text" style="margin:7px 0px">Installing Plugin...</p>
        </div>
    </div>
    <div id="UpdatingPluginView" class="processing-view" style="display:none">
        <div class="ProcessingModalBody">
            <p style="margin:0px"><img src='https://cdn.lunarix.lol/ec4e85b0c4396cf753a06fade0a8d8af.gif' alt="Updating Plugin..." /></p>
            <p class="processing-text" style="margin:7px 0px">Updating Plugin...</p>
        </div>
    </div>
    
    <script type="text/javascript">
    Lunarix.Item = Lunarix.Item || {};

    Lunarix.Item.Resources = {
        //<sl:translate>
        DisableBadgeTitle: 'Disable Badge'
        , DisableBadgeMessage: 'Are you sure you want to disable this Badge?'
        , assetGrantedModalTitle: "This item is now yours"
        , assetGrantedModalMessage: "You just got this item courtesy of our sponsor."
        //</sl:translate>
    };
</script>
<script type="text/javascript">
    Lunarix.Plugins = Lunarix.Plugins || {};

    Lunarix.Plugins.Resources = {
        //<sl:translate>
        errorTitle: "Error Installing Plugin",
        errorBody: "There was a problem installing this plugin. Please try again later.",
        successTitle: "Plugin Installed",
        successBody: " has been successfully installed! Please open a new window to begin using this plugin.",
        ok: "OK",
        reinstall: "Reinstall",
        updateErrorTitle: "Error Updating Plugin",
        updateErrorBody: "There was a problem updating this plugin. Please try again later.",
        updateSuccessTitle: "Plugin Update",
        updateSuccessBody: " has been successfully updated! Please open a new window for the changes to take effect.",
        updateText: "Update",
        //</sl:translate>
        alertImageUrl: '/images/Icons/img-alert.png'
    };
</script>

<script type="text/javascript">
    Lunarix.Item = Lunarix.Item || {};
    (function () {
        var marketplaceFee = 0.3;
        var pendingTakeOffGuid = null;

        Lunarix.Item.setMarketPlaceFee = function (fee) {
            marketplaceFee = fee;
        };
        Lunarix.Item.validateResellInput = function () {
            var priceVal = $("#SellItemModalContainer input[name=price]").val();
            var errEl = $("#SellItemModalContainer .error-message");
            if (isNaN(parseInt(priceVal)) || priceVal != parseInt(priceVal) + "" || priceVal <= 0) {
                errEl.text("Price must be a positive integer.").show();
                $("#SellItemModalContainer .lblCommision").text("");
                $("#SellItemModalContainer .lblLeftover").text("");
                return;
            }
            errEl.hide();
            var price = parseInt(priceVal);
            var commission = Math.round(price * marketplaceFee);
            commission = commission > 1 ? commission : 1;
            var leftover = price - commission;
            $("#SellItemModalContainer .lblCommision").text(commission > 0 ? commission : "");
            $("#SellItemModalContainer .lblLeftover").text(leftover >= 0 ? leftover : "");
        };
        Lunarix.Item.confirmSell = function (assetId) {
            var priceVal = $("#SellItemModalContainer input[name=price]").val();
            var price = parseInt(priceVal);
            var guid = $("#SerialSelect").val();
            var errEl = $("#SellItemModalContainer .error-message");
            errEl.hide();
            if (isNaN(price) || priceVal != price + "" || price <= 0) {
                errEl.text("Price must be a positive integer.").show();
                return;
            }
            if ($("#SerialSelect").length && !guid) {
                errEl.text("Please select which item to sell.").show();
                return;
            }
            $.ajax({
                type: "POST",
                url: "/collectible/sell",
                data: { assetId: assetId, price: price, guid: guid },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    ModalClose('SellItemModalContainer');
                    window.location.reload();
                },
                error: function (xhr) {
                    var msg = "Sorry, something went wrong.";
                    try {
                        var parsed = JSON.parse(xhr.responseText);
                        msg = parsed.message || parsed.errorMsg || msg;
                    } catch (e) {}
                    errEl.text(msg).show();
                }
            });
        };
        Lunarix.Item.openTakeOffSale = function (guid) {
            pendingTakeOffGuid = guid;
            $("#TakeOffSaleModalContainer").modal({
                escClose: true,
                overlayClose: true,
                opacity: 80,
                overlayCss: { backgroundColor: "#000" }
            });
        };
        Lunarix.Item.confirmTakeOffSale = function () {
            if (!pendingTakeOffGuid) {
                return;
            }
            $.ajax({
                type: "POST",
                url: "/collectible/take-off-sale",
                data: { guid: pendingTakeOffGuid },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    ModalClose('TakeOffSaleModalContainer');
                    window.location.reload();
                },
                error: function (xhr) {
                    var msg = "Sorry, something went wrong.";
                    try {
                        var parsed = JSON.parse(xhr.responseText);
                        msg = parsed.message || parsed.errorMsg || msg;
                    } catch (e) {}
                    ModalClose('TakeOffSaleModalContainer');
                    Lunarix.GenericModal.open("Error", "/images/Icons/img-alert.png", msg, null, false);
                }
            });
        };
    })();
</script>
    <script type="text/javascript">
    Lunarix.Item = Lunarix.Item || {};

    Lunarix.Item.ShowAssetGrantedModal = false;
    Lunarix.Item.ForwardToUrl = "";
        $(function() {
            var commentsLoaded = false;

            //Tabs
            function SwitchTabs(nextTabElem) {
                $('.WhiteSquareTabsContainer .selected,  .TabContent.selected').removeClass('selected');
                nextTabElem.addClass('selected');
                $('#' + nextTabElem.attr('contentid')).addClass('selected');

                var label = $.trim(nextTabElem.attr('contentid'));
                if(label == "CommentaryTab" && !commentsLoaded) {
                    Lunarix.CommentsPane.getComments(0);
                    commentsLoaded = true;
                    if(Lunarix.SuperSafePrivacyMode != undefined) {
                        Lunarix.SuperSafePrivacyMode.initModals();
                    }
                    return false;
                }
            }
            
            $('.WhiteSquareTabsContainer li').bind('click', function (event) {
                event.preventDefault();
                SwitchTabs($(this));
            });
                  
            function confirmDelete() {
                Lunarix.GenericConfirmation.open({
                    titleText: "Delete Item",
                    bodyContent: "Are you sure you want to permanently DELETE this item from your inventory?",
                    onAccept: function () {
                        $.ajax({
                            url: '/API/DeleteAsset.ashx',
                            type: 'POST',
                            data: { assetId: Lunarix.Item.AssetId },
                            success: function (response) {
                                window.location.reload();
                            },
                            error: function (xhr) {
                                {{-- Lunarix.GenericModal.open(Lunarix.GenericModal.Resources.ErrorText, "/images/Icons/img-alert.png", Lunarix.GenericModal.Resources.ErrorMessage, null, false); --}}
                                Lunarix.GenericModal.open(Lunarix.GenericModal.Resources.ErrorText, "/images/Icons/img-alert.png", "This feature is still being worked on", null, false);
                            }
                        });
                    },
                    acceptColor: Lunarix.GenericModal.blue,
                    acceptText: "OK"
                });
            }

            function confirmSubmit() {
                Lunarix.GenericConfirmation.open({
                    //<sl:translate>
                    titleText: "Create New Badge Giver",
                    bodyContent: "This will add a new badge giver model to your inventory. Are you sure you want to do this?",
                    //</sl:translate>
                    onAccept: function () {
                        window.location.href = $('#ctl00_cphLunarix_btnSubmit').attr('href');
                    },
                    acceptColor: Lunarix.GenericConfirmation.blue,
                    //<sl:translate>
                    acceptText: "OK"
                    //</sl:translate>
                });
            }

            $(document).on('click', '#ctl00_cphLunarix_btnDelete', function (event) {
                event.preventDefault();
                event.stopPropagation();
                confirmDelete();
                return false;
            });

            $('div.Ownership input').click(function() {
                confirmSubmit();
                return false;
            });

            modalProperties = { escClose: true, opacity: 80, overlayCss: { backgroundColor: "#000"} };
        
            // Code for Modal Popups and Plugin initialization
            
            $(".btn-disabled-primary").removeClass("Button").tipsy({ gravity: 's' }).attr("href", "javascript: return false;");
        });
        function ModalClose(popup) {
            $.modal.close('.' + popup);
        }
    </script>

                    <div style="clear:both"></div>
                </div>
            </div>
        </div> 
        </div>
@include('layout.footerlegacy')
@endsection
