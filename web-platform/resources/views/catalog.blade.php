@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___23e1cfc4f7f34bdc2ff4f3c2d637a122_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___72bfd34566399e07045ed3a0ac82455f_m.css">
@endpush
@push('js')
<script type='text/javascript' src='http://js.lunarix.lol/453a3526187103f27673584103a84bc7.js'></script>
@endpush
@section('content')
@include('layout.header')
<script type='text/javascript'>Lunarix.config.externalResources = [];Lunarix.config.paths['Pages.Catalog'] = 'http://js.lunarix.lol/1612c57544c7977e19cd15c824f7ecc3.js';Lunarix.config.paths['Pages.CatalogShared'] = 'http://js.lunarix.lol/209f2b781ea84e8d0332648ddf547d57.js';Lunarix.config.paths['Pages.Messages'] = 'http://js.lunarix.lol/e8cbac58ab4f0d8d4c707700c9f97630.js';Lunarix.config.paths['Resources.Messages'] = 'http://js.lunarix.lol/fb9cb43a34372a004b06425a1c69c9c4.js';Lunarix.config.paths['Widgets.AvatarImage'] = 'http://js.lunarix.lol/bbaeb48f3312bad4626e00c90746ffc0.js';Lunarix.config.paths['Widgets.DropdownMenu'] = 'http://js.lunarix.lol/7b436bae917789c0b84f40fdebd25d97.js';Lunarix.config.paths['Widgets.GroupImage'] = 'http://js.lunarix.lol/33d82b98045d49ec5a1f635d14cc7010.js';Lunarix.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.lunarix.lol/fbb86cf0752d23f389f983419d3085b4.js';Lunarix.config.paths['Widgets.ItemImage'] = 'http://js.lunarix.lol/8babd891cf420dfe3999b3824a0154cb.js';Lunarix.config.paths['Widgets.PlaceImage'] = 'http://js.lunarix.lol/f2697119678d0851cfaa6c2270a727ed.js';Lunarix.config.paths['Widgets.SurveyModal'] = 'http://js.lunarix.lol/d6e979598c460090eafb6d38231159f6.js';</script><script type="text/javascript">
    $(function () {
        Lunarix.JSErrorTracker.initialize({ 'suppressConsoleError': true});
    });
</script><script type='text/javascript' src='http://js.lunarix.lol/b3bb47d913a29004bf50d9a896f46b4a.js'></script>
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
		
    <div id="AdvertisingLeaderboard"  class = "top-ad-728">
        

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
                    
    
<style type="text/css">
    #Body {
        padding: 5px;
    }
</style>



<div id="catalog" data-empty-search-enabled="true">
<div class="header" style="height:60px;">
        <div style="float:left;">
            <h1><a href="/catalog/" id="CatalogLink">Catalog</a></h1>
        </div>
    <div class="CatalogSearchBar">
        <input id="keywordTextbox" name="name" type="text" class="translate text-box text-box-small" />
        <div style="height:23px;border:1px solid #a7a7a7;padding:2px 2px 0px 2px;margin-right:6px;float:left;position:relative">
            <!--[if IE7]>
                <div style="height:19px;width:131px;position:absolute;top:2px;left:2px;border:1px solid white"></div>
                <div style="height:19px;width:15px;position:absolute;top:2px;right:2px;border:1px solid #aaa"></div>
            <![endif]-->
            <select id="categoriesForKeyword" style="">
                    <option value="1">All Categories</option>
                    <option value="0">Featured</option>
                    <option value="2">Collectibles</option>
                    <option value="3">Clothing</option>
                    <option value="4">Body Parts</option>
                    <option value="5">Gear</option>
            </select>
        </div>
        <a id="submitSearchButton" href="#" class="btn-control btn-control-large top-level">Search</a>
    </div>
</div>


    <div class="left-nav-menu divider-right">



    <div class="browseDropdownHeader"></div>

<div id="dropdown" class="splashdropdownsplashdropdown lunarix-hierarchicaldropdown">
    <ul id="dropdownUl" class="clearfix">

            <li class="subcategories" data-delay="never">
                <a href="#category=featured" class="assetTypeFilter" data-category="0">Featured</a>
                <ul class="slideOut" style="top:-1px;">
                    <li class="slideHeader"><span>Featured Types</span></li>
                        <li><a href="#category=featured" class="assetTypeFilter" data-types="0" data-category="0">All Featured Items</a></li>    
                        <li><a href="#category=featured" class="assetTypeFilter" data-types="9" data-category="0">Featured Hats</a></li>    
                        <li><a href="#category=featured" class="assetTypeFilter" data-types="5" data-category="0">Featured Gear</a></li>    
                        <li><a href="#category=featured" class="assetTypeFilter" data-types="10" data-category="0">Featured Faces</a></li>    
                        <li><a href="#category=featured" class="assetTypeFilter" data-types="11" data-category="0">Featured Packages</a></li>    
                </ul>
            </li>
        
            <li class="subcategories"><a href="#category=collectibles" class="assetTypeFilter collectiblesLink" data-category="2">Collectibles</a>
                <ul class="slideOut" style="top:-32px;">
                    <li class="slideHeader"><span>Collectible Types</span></li>
                        <li><a href="#category=collectibles" class="assetTypeFilter" data-types="2" data-category="2">All Collectibles</a></li>    
                        <li><a href="#category=collectibles" class="assetTypeFilter" data-types="10" data-category="2">Collectible Faces</a></li>    
                        <li><a href="#category=collectibles" class="assetTypeFilter" data-types="9" data-category="2">Collectible Hats</a></li>    
                        <li><a href="#category=collectibles" class="assetTypeFilter" data-types="5" data-category="2">Collectible Gear</a></li>    
                </ul>
            </li>

            <li class="slideHeader DropdownDivider divider-bottom" data-delay="ignore"></li>

            <li data-delay="always">
                <a href="#category=all" class="assetTypeFilter" data-category="1">All Categories</a>
            </li>
        
            <li class="subcategories">
                <a href="#category=clothing" class="assetTypeFilter" data-category="3">Clothing</a>
                <ul class="slideOut" style="top:-97px;">
                    <li class="slideHeader"><span>Clothing Types</span></li>
                        <li><a href="#" class="assetTypeFilter" data-types="3" data-category="3">All Clothing</a></li>    
                        <li><a href="#" class="assetTypeFilter" data-types="9" data-category="3">Hats</a></li>    
                        <li><a href="#" class="assetTypeFilter" data-types="12" data-category="3">Shirts</a></li>    
                        <li><a href="#" class="assetTypeFilter" data-types="13" data-category="3">T-Shirts</a></li>    
                        <li><a href="#" class="assetTypeFilter" data-types="14" data-category="3">Pants</a></li>    
                        <li><a href="#" class="assetTypeFilter" data-types="11" data-category="3">Packages</a></li>    
                </ul>
            </li>
        
            <li class="subcategories"><a href="#category=bodyparts" class="assetTypeFilter" data-category="4">Body Parts</a>
                <ul class="slideOut" style="top:-128px;">
                    <li class="slideHeader"><span>Body Part Types</span></li>
                        <li><a href="#category=bodyparts" class="assetTypeFilter" data-types="4" data-category="4">All Body Parts</a></li>    
                        <li><a href="#category=bodyparts" class="assetTypeFilter" data-types="15" data-category="4">Heads</a></li>    
                        <li><a href="#category=bodyparts" class="assetTypeFilter" data-types="10" data-category="4">Faces</a></li>    
                        <li><a href="#category=bodyparts" class="assetTypeFilter" data-types="11" data-category="4">Packages</a></li>    
                </ul>
            </li>
        
            <li class="subcategories"><a href="#category=gear" class="assetTypeFilter" data-category="5">Gear</a>
                <ul class="slideOut" style="top:-159px; width:auto;" style="border-right:0px;">
                    <div>
                        <li class="slideHeader"><span>Gear Categories</span></li>
                            <li><a href="#geartype=All Gear" class="gearFilter" data-category="5" data-types="All">All Gear</a></li>
                            <li><a href="#geartype=Melee Weapon" class="gearFilter" data-category="5" data-types="1">Melee Weapon</a></li>
                            <li><a href="#geartype=Ranged Weapon" class="gearFilter" data-category="5" data-types="2">Ranged Weapon</a></li>
                            <li><a href="#geartype=Explosive" class="gearFilter" data-category="5" data-types="3">Explosive</a></li>
                            <li><a href="#geartype=Power Up" class="gearFilter" data-category="5" data-types="4">Power Up</a></li>
                            <li><a href="#geartype=Navigation Enhancer" class="gearFilter" data-category="5" data-types="5">Navigation Enhancer</a></li>
                            <li><a href="#geartype=Musical Instrument" class="gearFilter" data-category="5" data-types="6">Musical Instrument</a></li>
                    </div>
                    <div id="gearSecondColumn">
                            <li><a href="#geartype=Social Item" class="gearFilter" data-category="5" data-types="7">Social Item</a></li>
                            <li><a href="#geartype=Building Tool" class="gearFilter" data-category="5" data-types="8">Building Tool</a></li>
                            <li><a href="#geartype=Personal Transport" class="gearFilter" data-category="5" data-types="9">Personal Transport</a></li>

                    </div>
                </ul>
            </li>
        
                            </ul>
</div>
<div id="legend" class="">
    <div class="header expanded" id="legendheader">
        <h3>Legend</h3>
    </div>
    <div id="legendcontent" style="overflow: hidden; ">
        <img src="https://cdn.lunarix.lol/4fc3a98692c7ea4d17207f1630885f68.png" style="margin-left: -13px" />
        <div class="legendText"><b>Bloxxers Club Only</b><br/>
        Only purchasable by Bloxxers Club members.</div>

        <img src="https://cdn.lunarix.lol/793dc1fd7562307165231ca2b960b19a.png" style="margin-left: -13px" />
        <div class="legendText"><b>Limited Items</b><br/>
        Owners of these discontinued items can re-sell them to other users at any price.</div>
        
        <img src="https://cdn.lunarix.lol/d649b9c54a08dcfa76131d123e7d8acc.png" style="margin-left: -13px" />
        <div class="legendText"><b>Limited Unique Items</b><br/>
        A limited supply originally sold by Lunarix. Each unit is labeled with a serial number. Once sold out, owners can re-sell them to other users.
        </div>
    </div>
</div>                           
    </div>
    <div class="right-content divider-left">
        <h2>Featured Items on Lunarix</h2>
        <div style="clear:both;"></div>
        
        


@foreach($assets as $asset)
@php $big = $loop->index < 4; @endphp
<div class="CatalogItemOuter {{ $big ? 'BigOuter' : 'SmallOuter' }}">
<div class="SmallCatalogItemView {{ $big ? 'BigView' : 'SmallView' }}">
<div class="CatalogItemInner {{ $big ? 'BigInner' : 'SmallInner' }}">    
        <div class="lunarix-item-image {{ $big ? 'image-large' : 'image-small' }}" data-item-id="{{ $asset->id }}" data-image-size="{{ $big ? 'large' : 'small' }}" >
            <div class="item-image-wrapper">
                <a href="/{{ $asset->getSlug() }}-item?id={{ $asset->id }}">
                    <img title="{{ $asset->name }}" alt="{{ $asset->name }}" class="original-image " width="110" src="/Thumbs/Asset.ashx?assetId={{ $asset->id }}"/>
                                            @if($asset->is_limited_unique)
                                            <img src="https://cdn.lunarix.lol/38db481d8e9c04ce960b4f49cbf94af2.png" alt="Limited Unique" class="limited-overlay">
                                            @elseif($asset->is_limited)
                                            <img src="https://cdn.lunarix.lol/793dc1fd7562307165231ca2b960b19a.png" alt="Limited" class="limited-overlay">
                                            @endif
                                            @if($asset->isNewArrival())
                                            <img src="https://cdn.lunarix.lol/b84cdb8c0e7c6cbe58e91397f91b8be8.png" alt="New" />
                                            @endif
                </a>
            </div>
        </div>
        
    <div id="textDisplay">
    <div class="CatalogItemName notranslate"><a class="name notranslate" href="/{{ $asset->getSlug() }}-item?id={{ $asset->id }}" title="{{ $asset->getSlug() }}">{{ $asset->name }}</a></div>
               {{-- <div class="robux-price"><span class="SalesText">was </span><span class="robux notranslate">500</span></div>
            <div id="PrivateSales"><span class="SalesText">now </span><span class="robux notranslate">700</span></div> --}}
            <div class="robux-price">
                @if ($asset->robux == 0)
                <div><span class="NotAPrice">Free</span></div>
                @else
                <span class="robux notranslate">{{ number_format($asset->robux) }}</span>
                @endif
            </div>
    </div>
        <div class="CatalogHoverContent">
            <div><span class="CatalogItemInfoLabel">Creator:</span> <span class="HoverInfo notranslate"><a href="/User.aspx?ID={{ $asset->creator->id }}">{{ $asset->creator->username ?? 'idk' }}</a></span></div>
            <div><span class="CatalogItemInfoLabel">Updated:</span> <span class="HoverInfo">{{ $asset->updated_at->diffForHumans() }}</span></div>
            <div><span class="CatalogItemInfoLabel">Sales:</span> <span class="HoverInfo notranslate">{{ number_format($asset->sales_count) }}</span></div>
            <div><span class="CatalogItemInfoLabel">Favorited:</span> <span class="HoverInfo">{{ number_format($asset->favourites) }} times</span></div>
        </div>
</div>
</div>	
</div>
@if($loop->index === 3)
        <div style="clear:both"></div>
@endif
@endforeach


        <div style="clear:both;padding-top: 50px;text-align:center;font-weight: bold;">
                <a href="#featured=all" class="assetTypeFilter" data-category="Featured">See all featured items</a>            
        </div>
    </div>
    <div style="clear:both" style="padding-top:20px"></div>
</div>

<script type="text/javascript">
    $(function () {
        Lunarix.require('Pages.Catalog', function (catalog) {
            var pagestate = { "Category": 1, "CurrencyType": 0, "SortType": 0, "SortAggregation": 3, "SortCurrency": 0, "AssetTypes": null, "Gears": null, "Genres": null, "Keyword": null, "PageNumber": 1, "Creator": null, "PxMin": 0, "PxMax": 0 };
            catalog.init(pagestate, 1);
        });

            Lunarix.CatalogValues = Lunarix.CatalogValues || {};
            Lunarix.CatalogValues.CatalogContext = 1;

        
    });

</script>
<!--[if IE]>
    <script type="text/javascript">
        $(function () {
            $('.BigInner').live('mouseenter', function () {                
                $(this).parents('.BigView').css('z-index', '6');
                $('.SmallView').css('z-index', '1');
            });
            $('.BigInner').live('mouseleave', function () {                
                $(this).parents('.BigView').css('z-index', '1');
                $('.SmallView').css('z-index', '6');
            });
            $('.SmallInner').live('mouseenter', function () {
                $('.SmallView').css('z-index', '1');
                $(this).parents('.SmallCatalogItemView').css('z-index', '6');
            });
            $('.SmallInner').live('mouseleave', function () {
                $('.SmallView').css('z-index', '1');
                $(this).parents('.SmallCatalogItemView').css('z-index', '1');
            });
        });
    </script>
<![endif]-->

   
                    <div style="clear:both"></div>
                </div>
            </div>
        </div> 
        </div>
@include('layout.footerlegacy')
@endsection
