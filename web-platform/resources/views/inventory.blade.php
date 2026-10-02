@extends('layout.root')

@push('css')
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=leanbase___f9e2a82b042c4b4f945b16e30fb19e87_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___775166e336ea1267d5b2fe066340251f_m.css">
@endpush

@push('js')
    <script src="https://js.lunarix.lol/aa490490f6ad512989da8d22ff4063bd.js"></script>
    <script src="https://js.lunarix.lol/a6884ac8be9e22d9c093544abd554144.js.gzip"></script>
@endpush

@section('content')
@include('layout.header')
    <div class="container-main    ">
            <script type="text/javascript">
                if (top.location != self.location) {
                    top.location = self.location.href;
                }
            </script>
        <noscript><div class="SystemAlert"><div class="lrx-alert-info" role="alert">Please enable Javascript to use all the features on this site.</div></div></noscript>
        @include('layout.body.alert')
        <div class="content  ">

                                    


<script type="text/javascript">
    var Lunarix = Lunarix || {};
    Lunarix.uiBootstrap = {
        tabTemplateLink: "/viewapp/common/template/tabs/tab.html",
        tabsetTemplateLink: "/viewapp/common/template/tabs/tabset.html"
    };
</script>

<div id="state-properties"
     data-userid="{{ $vieweduser->id }}"
     data-headsid="17"
     data-facesid="18"
     data-gearid="19"
     data-hatsid="8"
     data-t-shirtsid="2"
     data-shirtsid="11"
     data-pantsid="12"
     data-decalsid="13"
     data-modelsid="10"
     data-pluginsid="38"
     data-animationsid="24"
     data-placesid="9"
     data-game-passesid="34"
     data-audioid="3"
     data-badgesid="21"
     data-left-armsid="29"
     data-right-armsid="28"
     data-left-legsid="30"
     data-right-legsid="31"
     data-torsosid="27"
     data-packagesid="32"
     data-isuser="{{ $user && $user->id === $vieweduser->id ? 'true' : 'false' }}"
     data-absolute-library-url="/develop/library"
     data-absolute-catalog-url="/catalog"
     >
</div>

    <div class="row page-content" ng-modules="lunarixApp, ui.bootstrap, assetsExplorer, recommendations, lunarixApp.helpers">
<h1>
    @if($user && $user->id === $vieweduser->id)
        My Inventory
    @else
        {{ $vieweduser->username }}'s Inventory
    @endif
</h1>
    <div class=" col-xs-12 lrx-tabs-vertical assets-explorer-main-content ng-cloak" ng-controller="assetsExplorerController">
    <div class="category-dropdown">
        <h3 class="h3">Category</h3>
        <div class="input-group-btn lrx-input-group-btn" dropdown="">
            <button type="button" dropdown-toggle="" class="lrx-input-dropdown-btn" ng-disabled="disabled" aria-haspopup="true" aria-expanded="false">
                <span class="lrx-selection-label" style="text-transform: capitalize;">@{{ currentStatus.stateLabel }}</span>
                <span class="lrx-icon-down-16x16"></span>
            </button>
            <ul class="lrx-dropdown-menu" role="menu">
                    <li ng-repeat="tab in assetsTabs" ui-sref="@{{ tab.name }}">
                    <a>@{{tab.label}}</a>
                </li>
            </ul>
        </div>
    </div>
    <ul class="nav nav-tabs nav-stacked" ng-init="currentStatus.activeTab">
        <h3 class="h3">Category</h3>
            <li class="lrx-tab" ng-repeat="tab in assetsTabs | orderBy: 'name'" ng-class="{'active': currentStatus.activeTab == tab.name}" ui-sref="@{{ tab.name }}">
        <a class="lrx-tab-heading">
            <span class="lrx-lead">@{{ tab.label }}</span>
        </a>
        </li>
    </ul>
<script type="text/ng-template" id="assets-list.html">
    <div class="current-items" ng-class="{'hide-items': !currentData.templateVisible}">
        <div class="container-header" ng-class="{'place-header': currentData.activeTab == 'places' && currentData.checkPage == 'true'}">
            <div class="assets-explorer-title">
                <h3>@{{ currentData.stateLabel }}</h3>
                <span class="lrx-font-sm">
                    Showing @{{ numItems | number }} - @{{ assetsListContent.assetItems.data.Data.End +1 | number }} of @{{ assetsListContent.assetItems.data.Data.TotalItems | number }} results
                </span>
            </div>
            <div class="header-content"
                 ng-hide="currentData.activeTab == 'places' || currentData.activeTab == 'badges' || currentData.activeTab == 'game-passes' ">
                <a ng-href="@{{ currentData.assetTypeUrl }}" class="btn btn-more lrx-btn-primary-sm">Get More</a>
                <div class="lrx-font-sm get-more">Explore the @{{ currentData.itemSection }} to find more @{{ currentData.stateLabel }}!</div>
            </div>
            <div class="header-content"
                 ng-show="currentData.activeTab == 'places' && currentData.checkPage == 'true' && assetsListContent.assetItems.data.Data.PageType !== 'favorites'"
                 ng-class="{'places-dropdown': currentData.activeTab == 'places' && currentData.checkPage == 'true'}">
                <div class="input-group-btn lrx-input-group-btn" dropdown="">
                    <button type="button" dropdown-toggle="" class="lrx-input-dropdown-btn" ng-disabled="disabled" aria-haspopup="true" aria-expanded="false">
                        <span class="lrx-selection-label">@{{ currentData.selectedItem }}</span>
                        <span class="lrx-icon-down-16x16"></span>
                    </button>
                    <ul class="lrx-dropdown-menu" role="menu">
                        <li ng-repeat="item in listItems" ng-click="placeSelect(item)">
                            <a>@{{item.label}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div ng-show="assetsListContent.assetItems.data.Data.TotalItems == 0" class="assets-explorer-items">
            <div class="section">
                <span class="lrx-text-danger">
                    <span ng-hide="currentData.checkPage == 'true'">This user has</span>
                    <span ng-show="currentData.checkPage == 'true'">You have</span>
                    <span ng-show="assetsListContent.assetItems.data.Data.PageType === 'favorites'">not favorited any @{{ currentData.stateLabel }}.</span>
                    <span ng-hide="assetsListContent.assetItems.data.Data.PageType === 'favorites'">no @{{ currentData.stateLabel }}.</span>
                    <span ng-hide="assetsListContent.assetItems.data.Data.PageType === 'favorites' || currentData.stateLabel == 'badges' || currentData.stateLabel == 'game passes' || currentData.stateLabel == 'places'">Try using the <a class="lrx-link" ng-href="@{{ currentData.assetTypeUrl }}">@{{ currentData.itemSection }}</a> to find new items.</span>
                </span>
            </div>
        </div>
        <ul id="assetsItems" class="hlist assets-explorer-items">
            <li ng-repeat="item in assetsListContent.assetItems.data.Data.Items" class="list-item assets-explorer-item"
                ng-class="{'place-item': currentData.activeTab == 'places'}">
                <a ng-href="@{{item.Item.AbsoluteUrl}}" class="assets-explorer-item-link">
                    <span class="item-thumb" style="position:relative;">
                        <div ng-hide="item.Product.SerialNumber == null"
                             class="item-serial-number lrx-font-xs"
                             style="position:absolute;top:5px;right:6px;z-index:3;color:#fff;text-shadow:0 1px 2px rgba(0,0,0,.8);font-weight:bold;">
                            #@{{item.Product.SerialNumber}}
                        </div>
                        <img ng-src="@{{item.Thumbnail.Url}}" thumbnail='item.Thumbnail' image-retry />
                        <div class="item-overlay item-expire-time-label lrx-font-xs" ng-hide="item.Product.ExpireTime == null">Exp: @{{item.Product.ExpireTime}}</div>
                        <img ng-if="item.Product.IsLimitedUnique == true"
                             src="/images/AssetIcons/limitedunique.png"
                             alt="Limited Unique"
                             width="87"
                             height="13"
                             style="position:absolute;left:4px;bottom:4px;z-index:2;width:87px;height:13px;max-width:calc(100% - 8px);object-fit:contain;object-position:left bottom;">
                        <img ng-if="item.Product.IsLimited == true && item.Product.IsLimitedUnique != true"
                             src="/images/AssetIcons/limited.png"
                             alt="Limited"
                             width="66"
                             height="13"
                             style="position:absolute;left:4px;bottom:4px;z-index:2;width:66px;height:13px;max-width:calc(100% - 8px);object-fit:contain;object-position:left bottom;">
                    </span>
                    <span class="lrx-font-xs lrx-text-overflow assets-explorer-name">@{{ item.Item.Name }}</span>
                    <span class="lrx-font-xs lrx-text-overflow assets-explorer-creator"><span class="assets-explorer-creator-by" ng-hide="currentData.stateLabel == 'places'">By:</span><span class="assets-explorer-creator-by" ng-show="currentData.stateLabel == 'places'">Owner:</span> <span ng-hide="currentData.stateLabel == 'places' && (currentData.selectedItem == 'My VIP Servers' || currentData.selectedItem == 'Other VIP Servers') && currentData.checkPage == 'true'">@{{ item.Creator.Name }}</span> <span ng-show="currentData.selectedItem == 'My VIP Servers' || currentData.selectedItem == 'Other VIP Servers'">@{{ item.PrivateServer.OwnerName }}</span></span>
                    <span class="lrx-font-xs assets-explorer-cost" ng-class="{'assets-explorer-hide': item.Product.PriceInRobux == null}"><span class="lrx-icon-robux"></span><span class="assets-explorer-cost-text">@{{item.Product.PriceInRobux | abbreviate }}</span></span>
                </a>

            </li>
        </ul>
        <div class="pager-holder">
            <ul class="pager lrx-pager" ng-show="currentData.totalPages > 1">
                <li class="lrx-pager-prev">
                    <a ng-click="newPage((currentData.currentPage - 1))"><i class="lrx-icon-left"></i></a>
                </li>
                <li>
                    <span>Page</span>
                </li>
                <li class="lrx-pager-cur">
                    <input type="text" value="@{{currentData.currentPage }}" ng-model="page" ng-keyup="$event.keyCode == 13 && newPage(page)">
                </li>
                <li class="lrx-pager-total">
                    <span>of</span>
                    <span>@{{ currentData.totalPages | number }}</span>
                </li>
                <li class="lrx-pager-next">
                    <a ng-click="newPage((currentData.currentPage + 1))"><i class="lrx-icon-right"></i></a>
                </li>
            </ul>
        </div>
    </div>
</script>
        <div class="tab-content lrx-tab-content" ng-controller="inventoryContentController" ng-include src="'assets-list.html'"></div>
        
<div ng-controller="recommendationsController" class="current-items" ng-class="{'hide-items': !appData.templateVisible}">
    <div class="recommendations-container" ng-show="appData.recommendedVisible" ng-assetid="@{{ appData.assetTypeId }}" data-asset-id="2">
        <div class="container-header recommendations-header" ng-hide="appData.recommendedItems.data.Data.Items.length == 0">
            <h3>Recommended @{{ appData.stateLabel }}</h3>
        </div>
        <ul class="hlist recommended-items" ng-class="{'place-items': appData.currentTab == 'places'}">
            <li ng-repeat="item in appData.recommendedItems.data.Data.Items" class="list-item recommended-item" ng-class="{'place-item': appData.currentTab == 'places'}">
                <a ng-href="@{{item.Item.AbsoluteUrl}}" class="recommended-item-link">
                    <span class="recommended-thumb"> 
                        <img ng-src="@{{item.Thumbnail.Url}}"
                             thumbnail='item.Thumbnail' image-retry />
                    </span>
                    <span class="recommended-name lrx-font-xs lrx-text-overflow">@{{ item.Item.Name }}</span>
                    <span class="recommended-creator lrx-font-xs lrx-text-overflow"><span class="recommended-creator-by">By:</span> @{{ item.Creator.Name }} </span>
                </a>

            </li>
        </ul>
            <a class="btn lrx-btn-control-xs assets-explorer-join-btn" ng-href="@{{ appData.assetTypeUrl }}" ng-hide="appData.recommendedItems.data.Data.Items.length == 0">See All</a>
    </div>
</div>
    </div>
</div>

            
        </div>
            </div> 
@include('layout.footer')
@endsection
