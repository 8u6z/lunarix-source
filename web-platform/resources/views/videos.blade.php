@extends('layout.root')

@push('css')
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=leanbase___f9e2a82b042c4b4f945b16e30fb19e87_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___452br4cbc7337a5afeba9cc2bd101d17_m.css">
@endpush

@push('js')
    <script src="http://js.lunarix.lol/sr9ca0ffd8430e3fhk9a7830e527d67e.js"></script>
@endpush

@section('content')
<div id="fb-root"></div>
<div class="wrap no-gutter-ads {{ auth()->check() ? 'logged-in' : 'logged-out' }}"
     data-gutter-ads-enabled="false">
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

                                    




<div id="ResponsiveWrapper" class="videos-responsive-wrapper "
     data-videossearchonpage="true"
     data-adsinvideosearchresultsenabled="true">

   
    
    <div id="VideosPageRightColumn" class="videos-page-right">
        <div id="VideosPageRightColumnSidebar" class="sidebar-no-ad videos-page-right-sidebar">
                    <div id="VideoPageAdDiv1" class="ads-container">


    <iframe allowtransparency="true"
            frameborder="0"
            height="270"
            scrolling="no"
            src="/userads/3"
            width="300"
            data-js-adtype="iframead"></iframe>


                    </div>
                        <div id="VideoPageAdDiv2" class="ads-container">


    <iframe allowtransparency="true"
            frameborder="0"
            height="270"
            scrolling="no"
            src="/userads/3"
            width="300"
            data-js-adtype="iframead"></iframe>


                        </div>

        </div>
    </div>

    <div id="VideosPageLeftColumn" class="videos-page-left ">

        <!-- New Filters and sort -->
        
           

<div class="col-xs-12 videos-page-filters loading" id="FiltersAndSort"
     data-defaulttoppaidtoweekly="true"
     data-defaultweeklyratings="true"
    >
    
        <div class="input-group-btn lrx-input-group-btn" id="SortFilter">
            <button type="button" class="lrx-input-dropdown-btn" data-toggle="dropdown">
                <span class="lrx-selection-label" data-bind="label" data-value="default" data-default="default">Filter by</span>
                <span class="lrx-icon-down-16x16"></span>
            </button>
            <ul data-toggle="dropdown-menu" class="lrx-dropdown-menu" role="menu">
                <li data-hidetimefilter data-value="default"><a href="#">Default</a></li>
                        <li data-hidetimefilter
                            
                            data-value="1">
                            <a href="#">Popular</a>
                        </li>
                        <li data-hidetimefilter
                            
                            data-value="16">
                            <a href="#">Roulette</a>
                        </li>

            </ul>

        </div>

    <div class="input-group-btn lrx-input-group-btn" id="TimeFilter">
        <button type="button" class="lrx-input-dropdown-btn" data-toggle="dropdown">
            <span class="lrx-selection-label" data-bind="label" data-value="0" data-default="0">Time</span>
            <span class="lrx-icon-down-16x16"></span>
        </button>
        <ul data-toggle="dropdown-menu" class="lrx-dropdown-menu" role="menu">
            <li data-value="0" class="hidden"><a href="#">Now</a></li>
            <li data-value="1"><a href="#">Past Day</a></li>
            <li data-value="2"><a href="#">Past Week</a></li>
            <li data-value="4"><a href="#">All Time</a></li>
        </ul>
    </div>

</div>

        <div id="VideosPageSearch" class="hidden" data-keyword="{{ request('Keyword') }}">
            <a name="CancelSearch" class="cancel-search">Cancel</a>
            <input data-default="{{ request('Keyword') }}" id="searchbox" class="translate" type="text" name="search" />
            <div class="SearchIconButton" title="Search"></div>
        </div>

        <div id="VideosListsContainer" class="videos-page-lists-container">



<div class="videos-list-container hidden container-0" id="VideosListContainer1"
     data-sortfilter="1"
     data-videofilter="1"
     data-minbclevel="0">
    <div class="videos-list-header videos-filter-changer">
            <h3>Popular</h3>

    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button videos-filter-changer btn-medium btn-neutral lrx-btn-secondary-xs btn-more">
            See All
        </div>
    </div>

    <div class="videos-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
                    <ul class="hlist videos"></ul>
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                        <span class="lrx-icon-videos-carousel-left"></span>
                    
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                        <span class="lrx-icon-videos-carousel-right"></span>
                </div>
            </div>
        </div>

        <ul class="hlist videos">            
            <div class="abp-spacer "></div>
        </ul>
    </div>
</div>

<div class="videos-list-container hidden container-5" id="VideosListContainer2"
     data-sortfilter="11"
     data-videofilter="1"
     data-minbclevel="0">
    <div class="videos-list-header videos-filter-changer">
            <h3>Top Favorite</h3>

    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button videos-filter-changer btn-medium btn-neutral lrx-btn-secondary-xs btn-more">
            See All
        </div>
    </div>

    <div class="videos-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
                    <ul class="hlist videos"></ul>
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                        <span class="lrx-icon-videos-carousel-left"></span>
                    
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                        <span class="lrx-icon-videos-carousel-right"></span>
                </div>
            </div>
        </div>

        <ul class="hlist videos">            
            <div class="abp-spacer "></div>
        </ul>
    </div>
</div>

<div class="videos-list-container hidden container-3" id="VideosListContainer16"
     data-sortfilter="16"
     data-videofilter="1"
     data-minbclevel="0">
    <div class="videos-list-header videos-filter-changer">
            <h3>Roulette</h3>

    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button videos-filter-changer btn-medium btn-neutral lrx-btn-secondary-xs btn-more">
            See All
        </div>
    </div>

    <div class="videos-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
                    <ul class="hlist videos"></ul>
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                        <span class="lrx-icon-videos-carousel-left"></span>
                    
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                        <span class="lrx-icon-videos-carousel-right"></span>
                </div>
            </div>
        </div>

        <ul class="hlist videos">            
            <div class="abp-spacer "></div>
        </ul>
    </div>
</div>

            <!-- on page search results container-->
            <div class="videos-list-container hidden search-results-container" id="SearchResultsContainer">
                <div class="videos-list-header">
                    <h3>Results for <span class="search-query-text"></span></h3>
                </div>
                <div class="videos-list">
                    <ul class="list-item videos"></ul>
                    <div class="abp-spacer "></div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {

        Lunarix.SearchBox = {};
        Lunarix.SearchBox.Resources = {
            //<sl:translate>
            search: "Search",
            zeroResults: "No Search Results Found"
            //</sl:translate>
        };
        Lunarix.VideosPageContainerBehavior.Resources = {
            //<sl:translate>
            pageTitle: "Lunarix Videos - Browse our selection of videos uploaded by our users!"
            //</sl:translate>
        };

        var defaultVideosListsCsv = "1,8,11,16,3";
        Lunarix.VideosPageContainerBehavior.FilterValueToVideosListsIdSuffixMapping = {"default": defaultVideosListsCsv.split(',')};

        Lunarix.VideosPageContainerBehavior.IsUserLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
        Lunarix.VideosPageContainerBehavior.adRefreshRateMilliSeconds = 3000;
        Lunarix.VideosPageContainerBehavior.DeviceTypeId = 1;
        Lunarix.VideosPageContainerBehavior.isCreateNewAd = true;
        Lunarix.VideosPageContainerBehavior.setIntervalId = null;
        Lunarix.VideosListBehavior.RefreshAdsInVideosPageEnabled = true;
        Lunarix.VideosListBehavior.isUserEligibleForMultirowFirstSort = false;

    })

</script>

            
        </div>
            </div>


<div id="fb-root"></div>
@include('layout.footer')
@endsection
