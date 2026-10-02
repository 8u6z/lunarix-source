@extends('layout.root')
@push('css')
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=leanbase___f9e2a82b042c4b4f945b16e30fb19e87_m.css">
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___a280135812a16a583499b62a7a2baaf2_m.css">
@endpush
@push('js')
<script type='text/javascript' src='https://js.lunarix.lol/741440986fa916e8a036aae7f8b7fd31.js'></script>
@endpush
@section('content')
<div id="fb-root"></div>
<div class="wrap no-gutter-ads {{ auth()->check() ? 'logged-in' : 'logged-out' }}"
     data-gutter-ads-enabled="false">
@include('layout.header')
<div id="navContent" class="nav-content  nav-no-left" style="margin-left: 0px; width: 100%;">
        <div class="nav-content-inner">
            <div class="container-main    ">
            <script type="text/javascript">
                if (top.location != self.location) {
                    top.location = self.location.href;
                }
            </script>
        <noscript><div class="SystemAlert"><div class="lrx-alert-info" role="alert">Please enable Javascript to use all the features on this site.</div></div></noscript>
        @include('layout.body.alert')
        <div class="content  ">

                                        <div id="Leaderboard-Abp" class="abp leaderboard-abp">
                    

    <iframe allowtransparency="true"
            frameborder="0"
            height="110"
            scrolling="no"
            src="/userads/1"
            width="728"
            data-js-adtype="iframead"></iframe>


                </div>
            
<div class="row page-content  ">
    <div class="col-xs-12 section game-main-content">
        <div class="game-thumb-container">
            <script>
    var Lunarix = Lunarix || {};
    Lunarix.Carousel = function () {
        var carouselId = "#lrx-carousel";
        var checkedForVideo = false;
        var isMobile = false;

        var initialize = function () {
            // acquire isMobile setting from DOM
            isMobile = $('#lrx-carousel').data('is-mobile');

            // set up carousel
            if(!isMobile) {
                $(carouselId).carousel({
                    interval: 5000,
                    pause: "hover"
                });
            } else {
                // do not cycle automatically on mobile because user might be playing video
                $(carouselId).carousel({
                    interval: false,
                    pause: "hover"
                });
            }


            // bindings
            $(carouselId)
                .on("slide.bs.carousel", function () {
                    // pause ALL the videos
                    Lunarix.Carousel.pauseAllVideos();
                    // restart the carousel sliding
                    $(carouselId).carousel('cycle');
                })
                .hover(
                    function () {
                        $(this).addClass("hover");
                    },
                    function () {
                        $(this).removeClass("hover");
                    }
                );

            // hide controls when there's only one slide
            if ($(carouselId+ " .carousel-indicators li").length < 2) {
                $(carouselId).find(".carousel-control, .carousel-indicators").css("display", "none");
            }

            $(document).on("playButton:gamePlayIntent", function () {
                // we pressed the play button - stop playing the video
                Lunarix.Carousel.pauseAllVideos();
            });

            Lunarix.Carousel.setUpYouTubeAPI();

            // retry thumbnails in carousel
            $(function () {
                $("#lrx-carousel .item span").loadLunarixThumbnails();
            });
        }

        var setUpYouTubeAPI = function () {
            var tag = document.createElement('script');

            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


        }

        var toggleVideo = function (state) {
            var div = $('.flex-video');
            if(div.length > 0){
                var iframe = div.find('iframe')[0].contentWindow;
                var func = state == 'hide' ? 'pauseVideo' : 'playVideo';
                iframe.postMessage('{"event":"command","func":"' + func + '","args":""}', '*');
            }
        }

        var pauseVideoAtIndex = function (idx) {
            if (lrxplayer && lrxplayer.length > 0 && !isMobile) {
                try {
                    lrxplayer[idx].pauseVideo();
                } catch (e) {
                    // tried to pause before player was ready
                }
                
            } else {
                return false;
            }
        }

        var playVideoAtIndex = function (idx) {
            if(lrxplayer && lrxplayer.length > 0 && lrxplayer[idx] && !isMobile) {
                lrxplayer[idx].playVideo();
                return true;
            } else {
                return false;
            }
        }

        var pauseAllVideos = function () {
            // pause ALL the videos
            if (lrxplayer && lrxplayer.length > 0) {
                var lrxplayerlen = lrxplayer.length;
                for (var i = 0; i < lrxplayerlen; i++) {
                    Lunarix.Carousel.pauseVideoAtIndex(i);
                }
            }
        }

        var checkForVideo = function () {
            if(checkedForVideo) {
                return false;
            }
            var carousel = $(carouselId);
            carousel.find('.item').each(function (idx, val) {
                if ($(val).find('.flex-video').length > 0) {
                    carousel.carousel(idx);
                    carousel.carousel("pause");
                    var successfulPlay = Lunarix.Carousel.playVideoAtIndex(0);
                    checkedForVideo = successfulPlay;
                    return false; // stop
                } else {
                    return true; // keep going
                }
            });
        }
        var onPlayerReady = function () {
            // This first moment get the video and auto-play it
            var autoplay = $('#lrx-carousel').data('is-video-autoplayed-on-ready');
            if (autoplay && !isMobile) {
                Lunarix.Carousel.checkForVideo();
            }
        }
        var onPlayerPlaying = function () {
            // We are playing the video. Stop the carousel.
            var carousel = $(carouselId);
            carousel.carousel("pause");
        }


        return {
            initialize: initialize,
            toggleVideo: toggleVideo,
            checkForVideo: checkForVideo,
            setUpYouTubeAPI: setUpYouTubeAPI,
            onPlayerReady: onPlayerReady,
            onPlayerPlaying: onPlayerPlaying,
            pauseVideoAtIndex: pauseVideoAtIndex,
            playVideoAtIndex: playVideoAtIndex,
            pauseAllVideos: pauseAllVideos
        }

    }();
    
    window.isAndroidApp = @json(request()->isAndroidApp());
    // For YouTube API. Must be global.

    var lrxplayer = [];
    function onYouTubeIframeAPIReady() {
        var carouselId = "#lrx-carousel";
        $(carouselId).find(".flex-video").each(function (idx, el) {
            youTubeId = $(el).find("iframe").attr("id");
            lrxplayer[lrxplayer.length] = new YT.Player(youTubeId, {});
        });

        // listen for postMessage from YouTube
        $(window).on("message", function (e) {
            var originalData = e.originalEvent.data;

            // data is not JSON
            if (originalData.charAt(0) != "{") {
                return ; 
            }
            var data = $.parseJSON(originalData);
            
            if (data.event == "onReady") {
                Lunarix.Carousel.onPlayerReady();
            }
            if(data.event == "infoDelivery" && data.info.playerState && data.info.playerState == 1) {
                Lunarix.Carousel.onPlayerPlaying();
            }
        });
    }

 
    $(document).ready(function () {
        Lunarix.Carousel.initialize();
    });
</script>



<div id="lrx-carousel" class="lrx-carousel carousel slide" data-ride="carousel" 
     data-is-video-autoplayed-on-ready="true"
     data-is-mobile="false">
    <!-- Indicators -->
    <ol class="carousel-indicators">

            <li data-target="#lrx-carousel" data-slide-to="0" class="active"></li>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">


            <div class="item active">
<span ><img  class='CarouselThumb' src="/Thumbs/Asset.ashx?assetId={{ $game['id'] }}" /></span>                    <div class="carousel-caption">
                    </div>


            </div>


    </div>
    <!-- Controls -->
    <a class="left carousel-control" href="#lrx-carousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left lrx-icon-carousel-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#lrx-carousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right lrx-icon-carousel-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</div>


        </div>
        <div class="game-calls-to-action">


<div id="game-context-menu">
    <a class="lrx-menu-item" data-toggle="popover" data-bind="game-context-menu" data-original-title="" title="" data-viewport=".game-calls-to-action">
        <i class="lrx-icon-more"></i>
    </a>
    <div class="lrx-popover-content" data-toggle="game-context-menu">
        <ul class="lrx-dropdown-menu" role="menu">
                <li>
                    <div class="VisitButton VisitButtonEdit" placeid="{{ $game['id'] }}" data-universeid="13058" data-allowupload="true">
                        <a>Edit</a>
                    </div>
                </li>
        </ul>
    </div>
</div>

<script>
    $(function() {
        $("#game-context-menu ").on("click", ".lrx-context-menu-shutdown-all", function (evt) {
            evt.preventDefault();
            var placeId = $(this).data("place-id");
            $("#game-context-menu").find(".lrx-menu-item").popover('hide'); 

            Lunarix.GenericConfirmation.open({
                titleText: "Shut Down Game",
                bodyContent: "Are you sure you want to shut down this game?",
                onAccept: function () {
                    $.post("/Games/shutdown-all-instances", {
                        placeId:placeId
                    }, function(data) {
                        // throw away
                    });
                },
                acceptColor: Lunarix.GenericConfirmation.blue,
                acceptText: "Yes",
                declineText: "No",
                allowHtmlContentInBody: true
            });
        });        
        $("#game-context-menu").on("click", ".VisitButtonBuildPH", function (evt) {
            $("#game-context-menu").find(".lrx-menu-item").popover('hide'); 
            var el = $(this);
            var placeId = el.attr("placeid");
            var universeId = el.data("universeid");
            var allowUpload = el.data("allowupload") ? true : false;
            Lunarix.GameLauncher.buildGameInStudio(placeId, universeId, allowUpload);
        });
        $("#game-context-menu").on("click", ".VisitButtonEditPH", function (evt) {
            $("#game-context-menu").find(".lrx-menu-item").popover('hide'); 
            var el = $(this);
            var placeId = el.attr("placeid");
            var universeId = el.data("universeid");
            var allowUpload = el.data("allowupload") ? true : false;
            Lunarix.GameLauncher.editGameInStudio(placeId, universeId, allowUpload);
        });
    });
</script>


            <h1 class="lrx-para-overflow game-name" title="{{ $game['name'] }}">{{ $game['name'] }}</h1>
            <h4 class="game-creator"><span>By</span> <a class="lrx-link" href="/User.aspx?ID={{ $game['creator_id'] }}">{{ $game['creator_name'] }}</a></h4>
            <div class="game-play-buttons" data-autoplay="false">
                           @if(!request()->isAndroidApp())
                           <div id="MultiplayerVisitButton" class="VisitButton VisitButtonPlay" placeid="{{ $game['id'] }}" data-action="play" data-is-membership-level-ok="true">
                                <a class="lrx-btn-primary-lg">Play</a>
                           </div>
                           @else
                           <a class="lrx-btn-primary-lg" href="/games/start?placeid={{ $game['id'] }}&userid={{ $currentUser->id }}&gameid={{ $game['id'] }}">Play</a>
                           @endif
                            



<script type="text/javascript">
    Lunarix = Lunarix || {};

    Lunarix.BCUpsellModal = function () {
        var resources = {
            //<sl:translate>
            title: "Bloxxers Club Only",
            body: "This is a premium feature only available to our Bloxxers Club members.",
            accept: "Upgrade Now"
            //</sl:translate>
        };

        var open = function () {
            var options = {
                titleText: Lunarix.BCUpsellModal.Resources.title,
                bodyContent: Lunarix.BCUpsellModal.Resources.body,
                footerText: "",
                acceptText: Lunarix.BCUpsellModal.Resources.accept,
                declineText: Lunarix.Resources.GenericConfirmation.No,
                acceptColor: Lunarix.GenericConfirmation.green,
                onAccept: function () { window.location.href = '/Upgrades/BloxxersClubMemberships.aspx?ctx=bc-only-game'; },
                imageUrl: 'https://cdn.lunarix.lol/43ac54175f3f3cd403536fedd9170c10.png'
            };

            Lunarix.GenericConfirmation.open(
                options
            );
        };

        return {
            open: open,
            Resources:resources
        };
    } ();
</script>
@auth
<script type="text/javascript">
    var play_placeId = {{ $game['id'] }};
    function fireEventAction(action) {
        LunarixEventManager.triggerEvent('lrx_evt_popup_action', { action: action });
    }
  
    $(function () { $('.VisitButtonPlay').click(function () {play_placeId=$(this).attr('placeid');Lunarix.GameLauncher.joinMultiplayerGame(play_placeId, true);return false;});$('#game-context-menu').on('click touchstart','.VisitButtonBuild', function () {LunarixLaunch._GoogleAnalyticsCallback = function() { var isInsideLunarixIDE = 'website'; if (Lunarix && Lunarix.Client && Lunarix.Client.isIDE && Lunarix.Client.isIDE()) { isInsideLunarixIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Plugin Location', 'Launch Attempt', isInsideLunarixIDE]);GoogleAnalyticsEvents.FireEvent(['Plugin', 'Launch Attempt', 'Build']);EventTracker.fireEvent('GameLaunchAttempt_Unknown', 'GameLaunchAttempt_Unknown_Plugin'); if (typeof Lunarix.GamePlayEvents != 'undefined') { Lunarix.GamePlayEvents.SendClientStartAttempt(null, play_placeId); }  }; play_placeId = (typeof $(this).attr('placeid') === 'undefined') ? play_placeId : $(this).attr('placeid'); Lunarix.Client.WaitForLunarix(function() { window.location = '/Login/Default.aspx?ReturnUrl={{ urlencode(route('games.view', ['id' => $game['id'], 'slug' => $game['slug']])) }}' }); return false;});$('#game-context-menu').on('click touchstart','.VisitButtonEdit', function () {LunarixLaunch._GoogleAnalyticsCallback = function() { var isInsideLunarixIDE = 'website'; if (Lunarix && Lunarix.Client && Lunarix.Client.isIDE && Lunarix.Client.isIDE()) { isInsideLunarixIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Plugin Location', 'Launch Attempt', isInsideLunarixIDE]);GoogleAnalyticsEvents.FireEvent(['Plugin', 'Launch Attempt', 'Edit']);EventTracker.fireEvent('GameLaunchAttempt_Unknown', 'GameLaunchAttempt_Unknown_Plugin'); if (typeof Lunarix.GamePlayEvents != 'undefined') { Lunarix.GamePlayEvents.SendClientStartAttempt(null, play_placeId); }  }; play_placeId = (typeof $(this).attr('placeid') === 'undefined') ? play_placeId : $(this).attr('placeid'); Lunarix.Client.WaitForLunarix(function() { LunarixLaunch.StartGame('http://www.lunarix.com//Game/edit.ashx?PlaceID='+play_placeId+'&upload=', 'edit.ashx', 'https://www.lunarix.com//Login/Negotiate.ashx', 'FETCH', true) }); return false;});$('.VisitButtonPersonalServer').click(function () {play_placeId=$(this).attr('placeid');Lunarix.CharacterSelect.placeid = play_placeId;Lunarix.CharacterSelect.show();});$(document).on('CharacterSelectLaunch', function (event, genderTypeID) { if (genderTypeID == 3) { var isInsideLunarixIDE = 'website'; if (Lunarix && Lunarix.Client && Lunarix.Client.isIDE && Lunarix.Client.isIDE()) { isInsideLunarixIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Plugin Location', 'Launch Attempt', isInsideLunarixIDE]);GoogleAnalyticsEvents.FireEvent(['Plugin', 'Launch Attempt', 'Play']);EventTracker.fireEvent("GameLaunchAttempt_Unknown", "GameLaunchAttempt_Unknown_Plugin"); if (typeof Lunarix.GamePlayEvents != 'undefined') { Lunarix.GamePlayEvents.SendClientStartAttempt(null, play_placeId); } } else { var isInsideLunarixIDE = 'website'; if (Lunarix && Lunarix.Client && Lunarix.Client.isIDE && Lunarix.Client.isIDE()) { isInsideLunarixIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Plugin Location', 'Launch Attempt', isInsideLunarixIDE]);GoogleAnalyticsEvents.FireEvent(['Plugin', 'Launch Attempt', 'Play']);EventTracker.fireEvent("GameLaunchAttempt_Unknown", "GameLaunchAttempt_Unknown_Plugin"); if (typeof Lunarix.GamePlayEvents != 'undefined') { Lunarix.GamePlayEvents.SendClientStartAttempt(null, play_placeId); } }play_placeId = (typeof $(this).attr('placeid') === 'undefined') ? play_placeId : $(this).attr('placeid'); Lunarix.Client.WaitForLunarix(function() { LunarixLaunch.RequestGame('PlaceLauncherStatusPanel', play_placeId, genderTypeID); }); return false;});}());;

</script>
@else
<script type="text/javascript">
    var play_placeId = {{ $game['id'] }};
    function fireEventAction(action) {
        LunarixEventManager.triggerEvent('lrx_evt_popup_action', { action: action });
    }
  
    $(function () { $('.VisitButtonPlay').click(function () {play_placeId=$(this).attr('placeid');Lunarix.CharacterSelect.placeid = play_placeId;Lunarix.CharacterSelect.show();});$('#game-context-menu').on('click touchstart','.VisitButtonBuild', function () {LunarixLaunch._GoogleAnalyticsCallback = function() { var isInsideLunarixIDE = 'website'; if (Lunarix && Lunarix.Client && Lunarix.Client.isIDE && Lunarix.Client.isIDE()) { isInsideLunarixIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Plugin Location', 'Launch Attempt', isInsideLunarixIDE]);GoogleAnalyticsEvents.FireEvent(['Plugin', 'Launch Attempt', 'Build']);EventTracker.fireEvent('GameLaunchAttempt_Unknown', 'GameLaunchAttempt_Unknown_Plugin'); if (typeof Lunarix.GamePlayEvents != 'undefined') { Lunarix.GamePlayEvents.SendClientStartAttempt(null, play_placeId); }  }; play_placeId = (typeof $(this).attr('placeid') === 'undefined') ? play_placeId : $(this).attr('placeid'); Lunarix.Client.WaitForLunarix(function() { window.location = '/Login/Default.aspx?ReturnUrl={{ urlencode(route('games.view', ['id' => $game['id'], 'slug' => $game['slug']])) }}' }); return false;});$('#game-context-menu').on('click touchstart','.VisitButtonEdit', function () {LunarixLaunch._GoogleAnalyticsCallback = function() { var isInsideLunarixIDE = 'website'; if (Lunarix && Lunarix.Client && Lunarix.Client.isIDE && Lunarix.Client.isIDE()) { isInsideLunarixIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Plugin Location', 'Launch Attempt', isInsideLunarixIDE]);GoogleAnalyticsEvents.FireEvent(['Plugin', 'Launch Attempt', 'Edit']);EventTracker.fireEvent('GameLaunchAttempt_Unknown', 'GameLaunchAttempt_Unknown_Plugin'); if (typeof Lunarix.GamePlayEvents != 'undefined') { Lunarix.GamePlayEvents.SendClientStartAttempt(null, play_placeId); }  }; play_placeId = (typeof $(this).attr('placeid') === 'undefined') ? play_placeId : $(this).attr('placeid'); Lunarix.Client.WaitForLunarix(function() { LunarixLaunch.StartGame('http://www.lunarix.com//Game/edit.ashx?PlaceID='+play_placeId+'&upload=', 'edit.ashx', 'https://www.lunarix.com//Login/Negotiate.ashx', 'FETCH', true) }); return false;});$('.VisitButtonPersonalServer').click(function () {play_placeId=$(this).attr('placeid');Lunarix.CharacterSelect.placeid = play_placeId;Lunarix.CharacterSelect.show();});$(document).on('CharacterSelectLaunch', function (event, genderTypeID) { if (genderTypeID == 3) { var isInsideLunarixIDE = 'website'; if (Lunarix && Lunarix.Client && Lunarix.Client.isIDE && Lunarix.Client.isIDE()) { isInsideLunarixIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Plugin Location', 'Launch Attempt', isInsideLunarixIDE]);GoogleAnalyticsEvents.FireEvent(['Plugin', 'Launch Attempt', 'Play']);EventTracker.fireEvent("GameLaunchAttempt_Unknown", "GameLaunchAttempt_Unknown_Plugin"); if (typeof Lunarix.GamePlayEvents != 'undefined') { Lunarix.GamePlayEvents.SendClientStartAttempt(null, play_placeId); } } else { var isInsideLunarixIDE = 'website'; if (Lunarix && Lunarix.Client && Lunarix.Client.isIDE && Lunarix.Client.isIDE()) { isInsideLunarixIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Plugin Location', 'Launch Attempt', isInsideLunarixIDE]);GoogleAnalyticsEvents.FireEvent(['Plugin', 'Launch Attempt', 'Play']);EventTracker.fireEvent("GameLaunchAttempt_Unknown", "GameLaunchAttempt_Unknown_Plugin"); if (typeof Lunarix.GamePlayEvents != 'undefined') { Lunarix.GamePlayEvents.SendClientStartAttempt(null, play_placeId); } }play_placeId = (typeof $(this).attr('placeid') === 'undefined') ? play_placeId : $(this).attr('placeid'); Lunarix.Client.WaitForLunarix(function() { LunarixLaunch.RequestGame('PlaceLauncherStatusPanel', play_placeId, genderTypeID); }); return false;});}());;

</script>
@endauth
{{-- <script type="text/javascript">
var play_placeId = {{ $game['id'] }};
function fireEventAction(action) {
    LunarixEventManager.triggerEvent('lrx_evt_popup_action', { action: action });
}
$(function () {
    $('.VisitButtonPlay').click(function () {
        play_placeId = $(this).attr('placeid');
        $('#downloadInstallerIFrame').attr('src', '/games/start?placeId=' + play_placeId);
        $('#ProtocolHandlerStartingDialog').modal({overlayClose: false, escClose: false, opacity: 80, overlayCss: { backgroundColor: "#000" }});
        setTimeout(function () {
            $.modal.close();
            $('#ProtocolHandlerAreYouInstalled').modal({overlayClose: true, escClose: true, opacity: 80, overlayCss: { backgroundColor: "#000" }});
        }, 10000);
    });
    $('#ProtocolHandlerInstallButton').on('click', function () {
        $('#downloadInstallerIFrame').attr('src', 'https://setup.lunarix.lol/LunarixPlayerLauncher.exe');
        $.modal.close();
        $('#InstallationInstructions').modal({overlayClose: false, escClose: false, opacity: 80, overlayCss: { backgroundColor: "#000" }, modalWidth: 970});
        setTimeout(function () { $('.VisitButtonContinuePH a').removeClass('disabled'); }, 15000);
    });
    $(document).on('click', '.VisitButtonContinuePH a:not(.disabled)', function () {
        $('#downloadInstallerIFrame').attr('src', '/games/start?placeId=' + play_placeId);
        $.modal.close();
    });
});
</script>
<script type="text/javascript">
    $(function() {
        Lunarix.PlaceItemPurchase = new Lunarix.ItemPurchase(function (obj) {
            $(".PurchaseButton[data-item-id="+ obj.AssetID +"]").each(function (index, htmlElem) {
                $("#lrx-place-purchase-required").hide();
                $("#MultiplayerVisitButton").show();
            });
        });

        if("False".toLowerCase() == "true") {
            $(function () {
                $("#lrx-place-purchase-required").on("click", function(e) {
                    Lunarix.PlaceItemPurchase.openPurchaseVerificationView(this);
                    return false;
                });
            });
        }
    });
</script> --}}
            </div>


            <ul class="share-rate-favorite">
                

        <li class="favorite-button-container lrx-tooltip" data-toggle="tooltip" title="" data-original-title="Add this game to favorites">
            <a>
                
                <span class="lrx-icon-favorite {{ $game['is_favorited'] ? 'selected' : '' }}" data-toggle-url="{{ route('games.favorite.toggle') }}" data-assetid="{{ $game['id'] }}" data-isguest="{{ auth()->check() ? 'False' : 'True' }}">
                    
                </span>
                <span id="favorite-count" title="{{ number_format($game['favorite_count']) }}">{{ formatnum($game['favorite_count']) }}</span>
            </a>

        </li>



<script type="text/javascript">
    //<sl:translate>
    Lunarix = Lunarix || {};
    Lunarix.Resources = Lunarix.Resources || {};

    Lunarix.Resources.FavoriteButton = {
        AddToFavorites: "Add to favorites",
        RemoveFromFavorites: "Remove from favorites"
    };
    //</sl:translate>

    Lunarix.Favorites.Initialize();
    Lunarix.FavoriteButton = Lunarix.FavoriteButton || {};
    var isCurrentlyFavorited = @json($game['is_favorited']);
    Lunarix.FavoriteButton.initialTooltip = isCurrentlyFavorited ? Lunarix.Resources.FavoriteButton.RemoveFromFavorites : Lunarix.Resources.FavoriteButton.AddToFavorites;
</script>
                
        <li class="voting-panel body"
             data-asset-id="{{ $game['id'] }}"
             data-total-up-votes="{{ $game['likes'] }}"
             data-total-down-votes="{{ $game['dislikes'] }}"
             data-vote-modal=""
             data-user-authenticated="{{ auth()->check() ? 'True' : 'False' }}">
            <div class="loading"></div>
                <div class="vote-summary">
                    <div class="voting-details">
                        <div class="users-vote ">
                            <div class="upvote">
                                <span class="lrx-icon-like {{ (int) $game['user_vote'] === 1 ? 'selected' : '' }}"></span>
                                <span id="vote-up-text" title="{{ number_format($game['likes']) }}" class="vote-text">{{ formatnum($game['likes']) }}</span>
                            </div>
                            <div class="downvote">
                                <span id="vote-down-text" title="{{ number_format($game['dislikes']) }}" class="vote-text">{{ formatnum($game['dislikes']) }}</span>
                                <span class="lrx-icon-dislike {{ (int) $game['user_vote'] === 2 ? 'selected' : '' }}"></span>
                                
                            </div>
                        </div>
                    </div>
                    <div class="visual-container">
                        <div class="background"></div>
                        <div class="percent"></div>
                    </div>
                </div>
        </li>




<script>
    $(function () {
        Lunarix.Voting.Initialize();

        Lunarix.Voting.Resources = {
            //<sl:translate>
            emailVerifiedTitle: "Verify Your Email",
            emailVerifiedMessage: "You must verify your email before you can vote. You can verify your email on the <a href='/my/account?confirmemail=1'>Account</a> page.",

            playGameTitle: "Play Game",
            playGameMessage: "You must play the game before you can vote on it.",

            useModelTitle: "Use Model",
            useModelMessage: "You must use this model before you can vote on it.",

            installPluginTitle: "Install Plugin",
            installPluginMessage: "You must install this plugin before you can vote on it.",

            buyGamePassTitle: "Buy Game Pass",
            buyGamePassMessage: "You must own this game pass before you can vote on it.",

            floodCheckThresholdMetTitle: "Slow Down",
            floodCheckThresholdMetMessage: "You're voting too quickly. Come back later and try again.",

            unknownProblemTitle: "Something Broke",
            unknownProblemMessage: "There was an unknown problem voting. Please try again.",

            guestUserTitle: "Login to Vote",
            guestUserMessage: "<div>You must login to vote.</div> <div>Please <a href='/'>login or register</a> to continue.</div>",

            accountUnderOneDayTitle: "Voter Feedback",
            accountUnderOneDayMessage: "You will be able to vote on Games and Studio Models later, after you've had a chance to experience Lunarix a bit more. Come back to this page in a couple days.",

            accept: "Verify",
            decline: "Cancel",
            login: "Login"
            //<sl:translate>
        };
    });
</script>

{{-- <script>
(() => {
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
    const compact = value => new Intl.NumberFormat('en', { notation: 'compact', maximumFractionDigits: 0 }).format(value);
    const post = async (url, payload) => {
        const response = await fetch(url, {
            method: 'POST',
            credentials: 'same-origin',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf },
            body: JSON.stringify(payload)
        });
        if (response.status === 401 || response.status === 419) {
            alert('Please log in to continue.');
            throw new Error('Authentication required');
        }
        if (!response.ok) throw new Error('Request failed');
        return response.json();
    };

    document.addEventListener('click', async event => {
        const favorite = event.target.closest('.lrx-icon-favorite');
        const upvote = event.target.closest('.upvote');
        const downvote = event.target.closest('.downvote');
        if (!favorite && !upvote && !downvote) return;
        event.preventDefault();
        event.stopImmediatePropagation();
        if (!@json(auth()->check())) {
            alert('Please log in to continue.');
            return;
        }

        try {
            if (favorite) {
                const result = await post(@json(route('games.favorite.toggle')), { asset_id: {{ $game['id'] }} });
                favorite.classList.toggle('selected', result.favorited);
                const count = document.getElementById('favorite-count');
                count.textContent = compact(result.count);
                count.title = Number(result.count).toLocaleString();
                return;
            }

            const result = await post(@json(route('games.vote')), { asset_id: {{ $game['id'] }}, vote: upvote ? 1 : 2 });
            document.querySelector('.upvote')?.classList.toggle('selected', result.vote === 1);
            document.querySelector('.downvote')?.classList.toggle('selected', result.vote === 2);
            const likes = document.getElementById('vote-up-text');
            const dislikes = document.getElementById('vote-down-text');
            likes.textContent = compact(result.likes);
            likes.title = Number(result.likes).toLocaleString();
            dislikes.textContent = compact(result.dislikes);
            dislikes.title = Number(result.dislikes).toLocaleString();
        } catch (error) {
            if (error.message !== 'Authentication required') alert('That action could not be completed. Please try again.');
        }
    }, true);
})();
</script> --}}

                <li class="social-media-share">
                            <span class="lrx-icon-share" id="lrx-share-btn" data-viewport=".page-content" data-bind="lrx-share-btn-regular-size-content"></span>

<div id="lrx-share-container" data-toggle="lrx-share-btn-regular-size-content">
    <div class="share-container-inner">
        <p class="catchy-title">
            Share with your friends
            <span class="lrx-icon-moreinfo"></span>
        </p>
        <div id="gigya-target"></div>
        <input class="copy-to-clipboard form-control lrx-input-field" type="text" value="{{ route('games.view', ['id' => $game['id'], 'slug' => $game['slug']]) }}" readonly="true" />
        <div class="catchy-title-tooltip-hover">Share Lunarix with your friends.</div>
    </div>
</div>
                            <script>
                                //TODO we will get rid of this when Facebook fixes their problem
                                var facebookScraped = false;

                                function facebookScrapeBugWorkaround(url) {
                                    if (!facebookScraped) {
                                        $.getJSON("https://graph.facebook.com/",
                                        {
                                            id: url,
                                            scrape: true
                                        }, function(data) { facebookScraped = true; });
                                    }
                                }

                                $("#lrx-share-btn").on("click", function() {
                                    facebookScrapeBugWorkaround(@json(route('games.view', ['id' => $game['id'], 'slug' => $game['slug']])));
                                    socialShareButtons = [
                                        {
                                            'provider': "Facebook",
                                            'enableCount': "true",
                                            'iconImgUp': "https://cdn.lunarix.lol/4799659a1367d6c6e235b5986cb9b6b9.png"
                                        },
                                        {
                                            'provider': "Twitter",
                                            'enableCount': "true",
                                            'iconImgUp': "https://cdn.lunarix.lol/d75e7a07fd4db793d79060cc5976cb29.png"
                                        },
                                        {
                                            'provider': "Googleplus",
                                            'enableCount': "true",
                                            'iconImgUp': "https://cdn.lunarix.lol/ee4b20b19bbaac5eb7c5e2c46a750c5c.png"
                                        }
                                    ];
                                    Lunarix.Social.presentShareDialog(@json($game['name']), @json(route('games.view', ['id' => $game['id'], 'slug' => $game['slug']])), @json(route('games.view', ['id' => $game['id'], 'slug' => $game['slug']])));
                                });
                            </script>

                </li><!-- .social-media-share -->
            </ul><!-- .share-rate-favorite-->
        </div>
    </div>

    <div class="col-xs-12 lrx-tabs-horizontal"
         data-place-id="{{ $game['id'] }}">
        <ul id="horizontal-tabs" class="nav nav-tabs" role="tablist">
            <li id="tab-about" class="lrx-tab tab-about active">
                <a class="lrx-tab-heading" href="#about">
                    <span class="lrx-lead">About</span>
                </a>
            </li>
            <li id="tab-store" class="lrx-tab tab-store">
                <a class="lrx-tab-heading" href="#store">
                    <span class="lrx-lead">Store</span>
                </a>
            </li>
                <li id="tab-leaderboards" class="lrx-tab tab-leaderboards">
                    <a class="lrx-tab-heading" href="#leaderboards">
                        <span class="lrx-lead">Leaderboards</span>
                    </a>
                </li>

            <li id="tab-game-instances" class="lrx-tab tab-game-instances">
                <a class="lrx-tab-heading" href="#game-instances">
                    <span class="lrx-lead">Servers</span>
                </a>
            </li>
        </ul>
        <div class="tab-content lrx-tab-content">
            <div class="tab-pane active" id="about">
                <div class="section game-about-container">
                    <h3>Description</h3>
                    <p class="game-description linkify">{{ $game['description'] }}</p>

                    <ul class="game-stats-container">
                        <li class="game-stat">
                            <p class="stat-title">Visits</p>
                            <p class="lrx-lead" title="{{ number_format($game['visits']) }}">{{ formatnum($game['visits']) }}</p>
                        </li>
                        <li class="game-stat">
                            <p class="stat-title">Created</p>
                            <p class="lrx-lead">{{ $game['created_at']?->format('n/j/Y') ?? 'Unknown' }}</p>
                        </li>
                        <li class="game-stat">
                            <p class="stat-title">Updated</p>
                            <p class="lrx-lead">{{ $game['updated_at']?->format('n/j/Y') ?? 'Unknown' }}</p>
                        </li>
                        <li class="game-stat">
                            <p class="stat-title">Max Players</p>
                            <p class="lrx-lead">{{ number_format($game['max_players']) }}</p>
                        </li>
                        <li class="game-stat">
                            <p class="stat-title">Genre</p>
                                <p>
                                    <span class="lrx-lead">{{ count($game['genres']) ? implode(', ', $game['genres']) : 'All' }}</span>
                                </p>
                        </li>
                        <li class="game-stat">
                            <p class="stat-title">Allowed Gear types</p>
                            <p class="lrx-lead stat-gears">
        @if(count($game['gear_types']))
            {{ implode(', ', $game['gear_types']) }}
        @else
            <span class="lrx-icon-nogear" data-toggle="tooltip" data-original-title="No Gear Allowed"></span>
        @endif


                            </p>
                        </li>
                    </ul>
                    <div class="game-stat-footer">

                        <span class="game-report-abuse"><a class="lrx-text-danger" href="/abusereport/asset?id={{ $game['id'] }}&amp;RedirectUrl={{ urlencode(route('games.view', ['id' => $game['id'], 'slug' => $game['slug']], false)) }}">Report Abuse</a></span>
                    </div>
                </div>

    <div id="lrx-vip-servers" class="container-list">
        <div class="container-header">
            <h3>VIP Servers</h3>
        </div>
        <div class="lrx-vip-server-item-container">
            <p><strong><a href="http://wiki.lunarix.com/index.php?title=VIP_server">VIP Servers</a> are currently not available as of this moment.</strong></p>
        </div>
    </div>

<script>
    var Lunarix = Lunarix || {};

    Lunarix.PrivateServers = Lunarix.PrivateServers || {};
    //<sl:translate>
    Lunarix.PrivateServers.RenewRecurringTitle = "Renew Private Server";
    Lunarix.PrivateServers.RenewRecurringBody = "Are you sure you want to enable future payments for your private VIP version of "
    + @json($game['name'].' by '.$game['creator_name'].'?<br><br>This VIP Server will start renewing every month at ')
    + "<span class=\"currency CurrencyColor1\">0</span> until you cancel.";
    Lunarix.PrivateServers.RenewRecurringAcceptText = "Renew Private Server";
    Lunarix.PrivateServers.RenewRecurringDeclineText = "Back";
    //<sl:translate>
</script>




                
<div class="section">
    <div id="AjaxCommentsContainer" class="comments-container"
         data-asset-id="{{ $game['id'] }}"
         data-total-collection-size=""
         data-is-user-authenticated="True">
        <h3>Comments</h3>
        <div class="AddAComment">
            <div class="comment-form">
                <div class="Avatar lunarix-avatar-image" data-user-id="-1" data-image-size="small"></div>

                <form class="lrx-form-horizontal ng-pristine ng-valid" role="form">
                    <div class="lrx-form-group">
                        <textarea class="form-control lrx-input-field lrx-comment-input blur" placeholder="Write a comment!" rows="1"></textarea>
                        <div class="lrx-comment-msgs">
                            <span class="lrx-comment-error lrx-text-danger"></span>
                            <span class="lrx-comment-count lrx-text-notes"></span>
                        </div>
                    </div>
                    <button type="button" class="lrx-btn-secondary-sm lrx-post-comment">Post Comment</button>
                </form>
            </div>
            <div class="comments vlist">

            </div>
            <div class="comments-item-template">
                <div class="comment-item list-item">
                    <div class="comment-user list-header">
                        <div class="Avatar" data-user-id="comment-author-id" data-image-size="small"></div>
                    </div>
                    <div class="comment-body list-body">
                        <strong>username</strong>
                        <p class="comment-content list-content"> text </p>
                        <span class="lrx-text-notes">4 hours ago</span>
                    </div>
                    <div class="comment-controls">
                        <a class="lrx-comment-report-link" href="/abusereport/comment?id=%CommentID&amp;redirectUrl=%PageURL" title="Report Abuse"><span class="lrx-icon-flag"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="AjaxCommentsMoreButtonContainer">
        <button type="button" class="lrx-btn-control-sm lrx-comments-see-more hidden">See More</button>
    </div>
</div>
<script>
    $(document).ready(function () {
        Lunarix.Comments.Resources = {
            //<sl:translate>
            defaultMessage: 'Write a comment!',
            noCommentsFound: 'No comments found.',
            moreComments: 'More comments',
            sorrySomethingWentWrong: 'Sorry, something went wrong.',
            charactersRemaining: ' characters remaining',
            emailVerifiedABTitle: 'Verify Your Email',
            emailVerifiedABMessage: "You must verify your email before you can comment. You can verify your email on the <a href='/my/account?confirmemail=1'>Account</a> page.",
            linksNotAllowedTitle: 'Links Not Allowed',
            linksNotAllowedMessage: 'Comments should be about the item or place on which you are commenting. Links are not permitted.',
            accept: 'Verify',
            decline: 'Cancel',
            tooManyCharacters: 'Too many characters!',
            tooManyNewlines: 'Too many newlines!'
            //</sl:translate>
        };
    
        Lunarix.Comments.Limits =
        [
            {
                limit: '10',
                character: "\n",
                message: Lunarix.Comments.Resources.tooManyNewlines
            },
            {
                limit: '200',
                character: undefined,
                message: Lunarix.Comments.Resources.tooManyCharacters
            }
        ];

        Lunarix.Comments.FilterIsEnabled = true;
        Lunarix.Comments.FilterRegex = "(([a-zA-Z0-9-]+\\.[a-zA-Z]{2,4}[:\\#/\?]+)|([a-zA-Z0-9]\\.[a-zA-Z0-9-]+\\.[a-zA-Z]{2,4}))";
        Lunarix.Comments.FilterCleanExistingComments = false ;


    
    Lunarix.Comments.initialize();
    });
</script>

                
                    <div id="my-recommended-games" class="col-xs-12 container-list games-detail">
                        
                    </div> 
            </div>
            <div class="tab-pane store" id="store">
                        <p>
                            <strong>This game does not sell any virtual items or power-ups.</strong>
                        </p>


                


<script>
    $(function () {
        Lunarix.GamePassJSData = { };
        Lunarix.GamePassJSData.PlaceID = {{ $game['id'] }};

        var purchaseConfirmationCallback = function (obj) {
            var originalContainer = $('.PurchaseButton[data-item-id=' + obj.AssetID + ']').parent('.lrx-caption');
            originalContainer.find('.lrx-purchased').hide();
            originalContainer.find('.lrx-item-buy').show();

        };
        Lunarix.GamePassItemPurchase = new Lunarix.ItemPurchase(purchaseConfirmationCallback);

        $("#store #lrx-game-passes").on("click", ".PurchaseButton", function (e) {
            Lunarix.PlaceProductPromotionItemPurchase.openPurchaseVerificationView($(this), 'game-pass');
        });

        $("#store #lrx-game-passes .btn-more").on("click", function (e) {
            $("#lrx-game-passes #lrx-passes-container").toggleClass("collapsed");
        });
    });
</script>


                


<input name="__RequestVerificationToken" type="hidden" value="4NZKs1yIvKnkpBikXYi5-exV-n_SwiMReAHiGOuu8roogPwFsq_rp7G6aVL_asxJPUuDLeJqf-zxGoRiJAJbCzgPluM1" />

<script>
    // From DisplayProductPromotions
    $(function() {
        Lunarix.PlaceProductPromotion.Resources = {
            //<sl:translate>
            anErrorOccurred: 'An error occurred, please try again.'
            , youhaveAdded: "You have added "
            , toYourGame: " to your game, "
            , youhaveRemoved: "You have removed "
            , fromYourGame: " from your game."
            , ok: "OK"
            , success: "Success!"
            , error: "Error"
            , sorryWeCouldnt: "Sorry, we couldn't remove the item from your game. Please try again."
            , notForSale: "This item is not for sale."
            , rent: "Rent"
            //<sl:translate>
        };

        var purchaseConfirmationCallback = function (obj) {
            var originalContainer = $('.PurchaseButton[data-item-id=' + obj.AssetID + ']').parent('.lrx-caption');
            originalContainer.find('.lrx-purchased').hide();
            originalContainer.find('.lrx-item-buy').show();
            
        };
        Lunarix.PlaceProductPromotionItemPurchase = new Lunarix.ItemPurchase(purchaseConfirmationCallback);
        Lunarix.PlaceProductPromotion.PlaceID = {{ $game['id'] }};

        $("#store").on("click", ".lrx-icon-delete", function(e) {
            var promoId = $(this).data('delete-promotion-id');
            Lunarix.PlaceProductPromotion.DeleteGear(promoId);
        });

        $("#store #lrx-game-gear").on("click", ".PurchaseButton", function (e) {
            Lunarix.PlaceProductPromotionItemPurchase.openPurchaseVerificationView($(this), 'game-gear');
        });

        $("#store #lrx-game-gear .btn-more").on("click", function (e) {
            $("#lrx-game-gear .lrx-gear-container").toggleClass("collapsed");
        });

    });

</script>

<div id="DeleteProductPromotionModal" class="PurchaseModal">
    <div id="simplemodal-close" class="simplemodal-close">
        <a></a>
    </div>
    <div class="titleBar" style="text-align: center">
    </div>
    <div class="PurchaseModalBody">
        <div class="PurchaseModalMessage">
            <div class="PurchaseModalMessageImage">
                <div class="thumbs-up-green">
                </div>
            </div>
            <div class="PurchaseModalMessageText">
            </div>
        </div>
        <div class="PurchaseModalButtonContainer">
            <div class="ImageButton btn-blue-ok-sharp simplemodal-close"></div>
        </div>
        <div class="PurchaseModalFooter"></div>
    </div>
</div>




            </div>

            <div class="tab-pane" id="leaderboards">
                
                    <div class="col-md-6">
                        

<div id="lrx-leaderboard-container-player" class="section lrx-leaderboard-container lrx-leaderboard-player" data-associated-leaderboard-more="lrx-leaderboard-btn-player">
    <div class="lrx-leaderboard-data"
         data-distributor-target-id="13058"
         data-max="20"
         data-rank-max="4"
         data-target-type="0"
         data-time-filter="1"
         data-player-id="5"
         data-clan-id="-1"></div>
    <div class="lrx-leaderboard-item-template hidden">
        <div class="lrx-leaderboard-item">
            <div class="rank"></div>
            <div class="avatar"></div>
            <div class="name-and-group"></div>
            <div class="points"></div>
        </div>
    </div>
    <div class="lrx-popover-content" data-toggle="popover-leaderboard-player">
        <ul class="lrx-dropdown-menu" role="menu">
            <li>
                <a data-time-filter="0">Today</a>
            </li>
            <li>
                <a data-time-filter="1">Past Week</a>
            </li>
            <li>
                <a data-time-filter="2">Past Month</a>
            </li>
            <li>
                <a data-time-filter="3">All Time</a>
            </li>
        </ul>
    </div>
    <div class="lrx-leaderboard-header">
        <h3>Players</h3>
        <div class="lrx-leaderboard-controls">
            <div class="lrx-leaderboard-filter">
                <span class="lrx-leaderboard-filtername">Past Week</span>
                <a class="lrx-menu-item" data-toggle="popover" data-bind="popover-leaderboard-player"
                   data-original-title="" title=""
                   data-viewport=".lrx-leaderboard-player"
                   data-placement="left"><span class="lrx-icon-sorting" id="lrx-leaderboard-popover-player"></span></a>
            </div>
        </div>

    </div>
    <div class="lrx-leaderboard-my"></div>
    <div class="lrx-leaderboard-items"></div>

</div>

<div class="lrx-leaderboard-more-container lrx-leaderboard-btn-player" data-associated-leaderboard="lrx-leaderboard-player">
    <button type=" button" class="lrx-btn-control-sm lrx-leaderboard-see-more hidden">
    See More</button>
</div>
    <script>
        var Lunarix = Lunarix || {};
        Lunarix.Leaderboard = Lunarix.Leaderboard || {};
        Lunarix.Leaderboard.Resources = {};
        //<sl:translate>
        Lunarix.Leaderboard.Resources.ErrorLoading = "Error loading rows.";
        Lunarix.Leaderboard.Resources.Loading = "Loading...";
        Lunarix.Leaderboard.Resources.GoGetPoints = "You are not yet ranked for this time period. Go earn some Points!";
        //</sl:translate>
    </script>

                    </div>
                    <div class="col-md-6">
                        

<div id="lrx-leaderboard-container-clan" class="section lrx-leaderboard-container lrx-leaderboard-clan" data-associated-leaderboard-more="lrx-leaderboard-btn-clan">
    <div class="lrx-leaderboard-data"
         data-distributor-target-id="13058"
         data-max="20"
         data-rank-max="4"
         data-target-type="1"
         data-time-filter="1"
         data-player-id="5"
         data-clan-id="-1"></div>
    <div class="lrx-leaderboard-item-template hidden">
        <div class="lrx-leaderboard-item">
            <div class="rank"></div>
            <div class="avatar"></div>
            <div class="name-and-group"></div>
            <div class="points"></div>
        </div>
    </div>
    <div class="lrx-popover-content" data-toggle="popover-leaderboard-clan">
        <ul class="lrx-dropdown-menu" role="menu">
            <li>
                <a data-time-filter="0">Today</a>
            </li>
            <li>
                <a data-time-filter="1">Past Week</a>
            </li>
            <li>
                <a data-time-filter="2">Past Month</a>
            </li>
            <li>
                <a data-time-filter="3">All Time</a>
            </li>
        </ul>
    </div>
    <div class="lrx-leaderboard-header">
        <h3>Clans</h3>
        <div class="lrx-leaderboard-controls">
            <div class="lrx-leaderboard-filter">
                <span class="lrx-leaderboard-filtername">Past Week</span>
                <a class="lrx-menu-item" data-toggle="popover" data-bind="popover-leaderboard-clan"
                   data-original-title="" title=""
                   data-viewport=".lrx-leaderboard-clan"
                   data-placement="left"><span class="lrx-icon-sorting" id="lrx-leaderboard-popover-clan"></span></a>
            </div>
        </div>

    </div>
    <div class="lrx-leaderboard-my"></div>
    <div class="lrx-leaderboard-items"></div>

</div>

<div class="lrx-leaderboard-more-container lrx-leaderboard-btn-clan" data-associated-leaderboard="lrx-leaderboard-clan">
    <button type=" button" class="lrx-btn-control-sm lrx-leaderboard-see-more hidden">
    See More</button>
</div>
    <script>
        var Lunarix = Lunarix || {};
        Lunarix.Leaderboard = Lunarix.Leaderboard || {};
        Lunarix.Leaderboard.Resources = {};
        //<sl:translate>
        Lunarix.Leaderboard.Resources.ErrorLoading = "Error loading rows.";
        Lunarix.Leaderboard.Resources.Loading = "Loading...";
        Lunarix.Leaderboard.Resources.GoGetPoints = "You are not yet ranked for this time period. Go earn some Points!";
        //</sl:translate>
    </script>

                    </div>

                <script>

                    // lazy load
                    $(".lrx-tab a[href='#leaderboards']").on('shown.bs.tab', function(e) {
                        // e.target newly activated tab
                        // e.relatedTarget previous active tab
                        Lunarix.Leaderboard.init();
                    });
                </script>
            </div>

            <div class="tab-pane game-instances" id="game-instances">
                


    
    <div id="lrx-running-games" class="container-list" data-placeid="{{ $game['id'] }}" data-showshutdown>
        <div class="container-header">
            <h3>Running Games</h3>
            <span class="lrx-btn-secondary-xs btn-more lrx-running-games-refresh">Refresh</span>
        </div>
        <ul id="lrx-game-server-item-container" class="lrx-game-server-item-container">
            
        </ul>
        <div class="lrx-running-games-footer">
                <button type="button" class="lrx-btn-control-xs btn-full-width lrx-running-games-load-more hidden">Load More</button>

        </div>
        <div class="lrx-game-server-template">
            <li class="section lrx-game-server-item">
                <div class="section-header">
                    <div class="link-menu lrx-game-server-menu"></div>
                </div>
                <div class="section-left lrx-game-server-details">
                    <div class="lrx-game-status lrx-game-server-status">x of y players max</div>
                    <div class="lrx-game-server-alert">
                        <span class="lrx-icon-remove"></span>Slow Game
                    </div>
                    <a class="btn-full-width lrx-btn-control-xs lrx-game-server-join"
                       href="#"
                       data-placeid>Join</a>

                </div>
                <div class="section-right lrx-game-server-players">
                </div>
            </li>
        </div>
    </div>



            </div>
        </div>
    </div>
</div>



<div class="GenericModal modalPopup unifiedModal smallModal" style="display:none;">
    <div class="Title"></div>
    <div class="GenericModalBody">
        <div>
            <div class="ImageContainer">
                <img class="GenericModalImage" alt="generic image"/>
            </div>
            <div class="Message"></div>
        </div>
        <div class="clear"></div>
        <div id="GenericModalButtonContainer" class="GenericModalButtonContainer">
            <a class="ImageButton btn-neutral btn-large lunarix-ok">OK</a>
        </div>
    </div>
</div>



<div id="ItemPurchaseAjaxData"
     data-has-currency-service-error="False"
     data-currency-service-error-message=""
     data-authenticateduser-isnull="False"
     data-user-balance-robux="0"
     data-user-balance-tickets="0"
     data-user-bc="0"
     data-continueshopping-url="{{ route('games.view', ['id' => $game['id'], 'slug' => $game['slug']], false) }}"
     data-imageurl ="http://t2.lrxcdn.com/6893a74f94ec60b4d8f5318ead65faeb"
     data-alerturl ="https://cdn.lunarix.lol/cbb24e0c0f1fb97381a065bd1e056fcb.png"
     data-bloxxerscluburl ="https://cdn.lunarix.lol/ae345c0d59b00329758518edc104d573.png"
     >
    
</div>


<div id="ProcessingView" style="display:none">
    <div class="ProcessingModalBody">
        <p style="margin:0px"><img src='https://cdn.lunarix.lol/116db03ed7027c242f773e70a4ed2e68.png' alt="Processing..." /></p>
        <p style="margin:7px 0px">Processing Transaction</p>
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
        <div class="ImageContainer">
            <img class="GenericModalImage BCModalImage" alt="Builder's Club" src="https://cdn.lunarix.lol/ae345c0d59b00329758518edc104d573.png" />
            <div id="BCMessageDiv" class="BCMessage Message">
                Bloxxers Club membership is required to play in this place.
            </div>
        </div>
        <div style="clear:both;"></div>
        <div style="clear:both;"></div>
        <div class="GenericModalButtonContainer" style="padding-bottom: 13px">
            <div style="text-align:center">
                <a id="BClink" href="/Upgrades/BloxxersClubMemberships.aspx?ctx=bc-only-item" class="btn-primary btn-large">Upgrade Now</a>
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
        $('#VOID').click(function () {
            showBCOnlyModal("BCOnlyModal");
            return false;
        });
    });
</script>


<div class="modal faded signup-or-log-in-modal">
        <h3 class="title">Sign up or log in to play</h3>
    <div class="close-button">&times;</div>
    


<style type="text/css">
    .male {
        background-image: url('https://cdn.lunarix.lol/856241927a2ac609e3033feada3ef9f9.png');
        background-repeat: no-repeat;
    }
    .female {
        background-image: url('https://cdn.lunarix.lol/a0afd0556163477e1023c5aa55d1b9f6.png');
        background-repeat: no-repeat;
    }
</style>

<div class="signup-or-log-in" ng-modules="SignupOrLogin"
     data-metadata-params="{&quot;isEligibleForHideAdsAbTest&quot;:&quot;False&quot;}">

    
    <div class="signup-container" ng-controller="SignupController" ng-show="isSectionShown">
        <div class="signup-input-area" ng-form name="signupForm" lrx-form-context context="PlayButton">
             

<img src="/timg/lrx" style="position: absolute"/>
            <div class="lrx-form-group" ng-class="{'has-error' : (badSubmit || signupForm.username.$dirty) && signupForm.username.$invalid, 'has-success': (signupForm.username.$dirty && signupForm.username.$valid) }">
                <input id="Username" ng-trim="false" name="username" class="form-control lrx-input-field" type="text" tabindex="1" lrx-valid-username lrx-form-interaction lrx-form-validation placeholder="Username (3-20 characters, no spaces)" ng-model="signup.username"/>
                <p id="UsernameInputValidation" class="lrx-control-label input-validation lrx-text-danger" ng-bind="(badSubmit || signupForm.username.$dirty) ? signupForm.username.$validationMessage : ''"></p>
            </div>
            <div class="lrx-form-group" ng-class="{'has-error' : (badSubmit || signupForm.password.$dirty) && signupForm.password.$invalid, 'has-success': (signupForm.password.$dirty && signupForm.password.$valid) }">
                <input id="Password" ng-trim="false" name="password" class="form-control lrx-input-field" type="password" tabindex="2" lrx-valid-password lrx-form-interaction lrx-form-validation lrx-form-validation-redact-input placeholder="Password (4 letters, 2 numbers minimum)" ng-model="signup.password">
                <p id="PasswordInputValidation" class="lrx-control-label input-validation lrx-text-danger" ng-bind="(badSubmit || signupForm.password.$dirty) ? signupForm.password.$validationMessage : ''"></p>
            </div>
            <div class="lrx-form-group" ng-class="{'has-error' : (badSubmit || signupForm.passwordConfirm.$dirty) && signupForm.passwordConfirm.$invalid, 'has-success': (signupForm.passwordConfirm.$dirty && signupForm.passwordConfirm.$valid) }">
                <input id="PasswordConfirm" ng-trim="false" name="passwordConfirm" class="form-control lrx-input-field" match="signup.password" lrx-valid-password-confirm lrx-form-interaction lrx-form-validation lrx-form-validation-redact-input type="password" tabindex="3" placeholder="Confirm Password" ng-model="signup.passwordConfirm"/>
                <p id="PasswordConfirmInputValidation" class="lrx-control-label input-validation lrx-text-danger" ng-bind="(badSubmit || signupForm.passwordConfirm.$dirty) ? signupForm.passwordConfirm.$validationMessage : ''"></p>
            </div>
            <div class="birthday-container">
                <div class="lrx-form-group" ng-class="{'has-error' : showBirthdayValidation(), 'has-success' : signupForm.birthdayMonth.$dirty && signupForm.birthdayDay.$dirty && signupForm.birthdayYear.$dirty && !showBirthdayValidation() }">
                    <div class="form-control fake-input-lg">
                        <label>Birthday</label>
                        <div class="lrx-select-group month">
                            <select class="lrx-input-field lrx-select" id="MonthDropdown" tabindex="4" lrx-valid-birthday lrx-form-interaction lrx-form-validation name="birthdayMonth" ng-model="signup.birthdayMonth">
                                <option value="" disabled selected>Month</option>
                                <option value="Jan">January</option>
                                <option value="Feb">February</option>
                                <option value="Mar">March</option>
                                <option value="Apr">April</option>
                                <option value="May">May</option>
                                <option value="Jun">June</option>
                                <option value="Jul">July</option>
                                <option value="Aug">August</option>
                                <option value="Sep">September</option>
                                <option value="Oct">October</option>
                                <option value="Nov">November</option>
                                <option value="Dec">December</option>
                            </select>
                        </div>
                        <div class="lrx-select-group day">
                            <select class="lrx-input-field lrx-select" id="DayDropdown" tabindex="5" lrx-valid-birthday lrx-form-interaction lrx-form-validation name="birthdayDay" ng-model="signup.birthdayDay">
                                <option value="" disabled selected>Day</option>
                                        <option value="1"
                                                >
                                            1
                                        </option>
                                        <option value="2"
                                                >
                                            2
                                        </option>
                                        <option value="3"
                                                >
                                            3
                                        </option>
                                        <option value="4"
                                                >
                                            4
                                        </option>
                                        <option value="5"
                                                >
                                            5
                                        </option>
                                        <option value="6"
                                                >
                                            6
                                        </option>
                                        <option value="7"
                                                >
                                            7
                                        </option>
                                        <option value="8"
                                                >
                                            8
                                        </option>
                                        <option value="9"
                                                >
                                            9
                                        </option>
                                        <option value="10"
                                                >
                                            10
                                        </option>
                                        <option value="11"
                                                >
                                            11
                                        </option>
                                        <option value="12"
                                                >
                                            12
                                        </option>
                                        <option value="13"
                                                >
                                            13
                                        </option>
                                        <option value="14"
                                                >
                                            14
                                        </option>
                                        <option value="15"
                                                >
                                            15
                                        </option>
                                        <option value="16"
                                                >
                                            16
                                        </option>
                                        <option value="17"
                                                >
                                            17
                                        </option>
                                        <option value="18"
                                                >
                                            18
                                        </option>
                                        <option value="19"
                                                >
                                            19
                                        </option>
                                        <option value="20"
                                                >
                                            20
                                        </option>
                                        <option value="21"
                                                >
                                            21
                                        </option>
                                        <option value="22"
                                                >
                                            22
                                        </option>
                                        <option value="23"
                                                >
                                            23
                                        </option>
                                        <option value="24"
                                                >
                                            24
                                        </option>
                                        <option value="25"
                                                >
                                            25
                                        </option>
                                        <option value="26"
                                                >
                                            26
                                        </option>
                                        <option value="27"
                                                >
                                            27
                                        </option>
                                        <option value="28"
                                                >
                                            28
                                        </option>
                                        <option value="29"
                                                >
                                            29
                                        </option>
                                        <option value="30"
                                                ng-show=isValidBirthday(30)>
                                            30
                                        </option>
                                        <option value="31"
                                                ng-show=isValidBirthday(31)>
                                            31
                                        </option>
                            </select>
                        </div>
                        <div class="lrx-select-group year">
                            <select class="lrx-input-field lrx-select" id="YearDropdown" lrx-valid-birthday lrx-form-interaction lrx-form-validation tabindex="6" name="birthdayYear" ng-model="signup.birthdayYear">
                                <option value="" disabled selected>Year</option>
                                <option value="2015">2015</option>
                                <option value="2014">2014</option>
                                <option value="2013">2013</option>
                                <option value="2012">2012</option>
                                <option value="2011">2011</option>
                                <option value="2010">2010</option>
                                <option value="2009">2009</option>
                                <option value="2008">2008</option>
                                <option value="2007">2007</option>
                                <option value="2006">2006</option>
                                <option value="2005">2005</option>
                                <option value="2004">2004</option>
                                <option value="2003">2003</option>
                                <option value="2002">2002</option>
                                <option value="2001">2001</option>
                                <option value="2000">2000</option>
                                <option value="1999">1999</option>
                                <option value="1998">1998</option>
                                <option value="1997">1997</option>
                                <option value="1996">1996</option>
                                <option value="1995">1995</option>
                                <option value="1994">1994</option>
                                <option value="1993">1993</option>
                                <option value="1992">1992</option>
                                <option value="1991">1991</option>
                                <option value="1990">1990</option>
                                <option value="1989">1989</option>
                                <option value="1988">1988</option>
                                <option value="1987">1987</option>
                                <option value="1986">1986</option>
                                <option value="1985">1985</option>
                                <option value="1984">1984</option>
                                <option value="1983">1983</option>
                                <option value="1982">1982</option>
                                <option value="1981">1981</option>
                                <option value="1980">1980</option>
                                <option value="1979">1979</option>
                                <option value="1978">1978</option>
                                <option value="1977">1977</option>
                                <option value="1976">1976</option>
                                <option value="1975">1975</option>
                                <option value="1974">1974</option>
                                <option value="1973">1973</option>
                                <option value="1972">1972</option>
                                <option value="1971">1971</option>
                                <option value="1970">1970</option>
                                <option value="1969">1969</option>
                                <option value="1968">1968</option>
                                <option value="1967">1967</option>
                                <option value="1966">1966</option>
                                <option value="1965">1965</option>
                                <option value="1964">1964</option>
                                <option value="1963">1963</option>
                                <option value="1962">1962</option>
                                <option value="1961">1961</option>
                                <option value="1960">1960</option>
                                <option value="1959">1959</option>
                                <option value="1958">1958</option>
                                <option value="1957">1957</option>
                                <option value="1956">1956</option>
                                <option value="1955">1955</option>
                                <option value="1954">1954</option>
                                <option value="1953">1953</option>
                                <option value="1952">1952</option>
                                <option value="1951">1951</option>
                                <option value="1950">1950</option>
                                <option value="1949">1949</option>
                                <option value="1948">1948</option>
                                <option value="1947">1947</option>
                                <option value="1946">1946</option>
                                <option value="1945">1945</option>
                                <option value="1944">1944</option>
                                <option value="1943">1943</option>
                                <option value="1942">1942</option>
                                <option value="1941">1941</option>
                                <option value="1940">1940</option>
                                <option value="1939">1939</option>
                                <option value="1938">1938</option>
                                <option value="1937">1937</option>
                                <option value="1936">1936</option>
                                <option value="1935">1935</option>
                                <option value="1934">1934</option>
                                <option value="1933">1933</option>
                                <option value="1932">1932</option>
                                <option value="1931">1931</option>
                                <option value="1930">1930</option>
                                <option value="1929">1929</option>
                                <option value="1928">1928</option>
                                <option value="1927">1927</option>
                                <option value="1926">1926</option>
                                <option value="1925">1925</option>
                                <option value="1924">1924</option>
                                <option value="1923">1923</option>
                                <option value="1922">1922</option>
                                <option value="1921">1921</option>
                                <option value="1920">1920</option>
                                <option value="1919">1919</option>
                                <option value="1918">1918</option>
                                <option value="1917">1917</option>
                                <option value="1916">1916</option>
                            </select>
                        </div>
                    </div>
                    <p id="BirthdayInputValidation" class="lrx-control-label input-validation lrx-text-danger" ng-bind="showBirthdayValidation() ? 'Invalid birthday' : ''"></p>
                </div>

            </div>
            <div class="gender-container">
                <div class="lrx-form-group" ng-class="{'has-error' : (badSubmit && !(signup.gender == 2 || signup.gender == 3)), 'has-success': signup.gender == 2 || signup.gender == 3 }">
                    <div class="form-control fake-input-lg">
                        <label>Gender</label>
                        <div id="FemaleButton" class="gender-circle" tabindex="7" lrx-form-interaction name="genderFemale" ng-class="{ 'selected-gender': signup.gender == 3 }" ng-click="setGender($event, 3)" ng-keypress="setGender($event, 3)">
                            <div class="cover-sprite gender female"></div>
                        </div>
                        <div id="MaleButton" class="gender-circle" tabindex="8" lrx-form-interaction name="genderMale" ng-class="{ 'selected-gender': signup.gender == 2 }" ng-click="setGender($event, 2)" ng-keypress="setGender($event, 2)">
                            <div class="cover-sprite gender male"></div>
                        </div>
                    </div>
                    <p id="GenderInputValidation" class="lrx-control-label input-validation lrx-text-danger" ng-bind="(badSubmit && !(signup.gender == 2 || signup.gender == 3)) ? 'Gender is required' : ''"></p>
                </div>
            </div>
            <button id="SignupButton" type="button" tabindex="9" class="lrx-btn-primary-md" lrx-form-interaction name="signupSubmit" ng-disabled="isSubmitting" data-signup-api-url="https://api.lunarix.com/signup/v1" ng-click="submitSignup($event)" ng-keypress="submitSignup($event)">Sign Up and Play!</button>
            <noscript>
                <div class="text-danger">
                    <strong>JavaScript is required to submit this form.</strong>
                </div>
            </noscript>
            <div id="GeneralErrorText" class="input-validation-large lrx-alert-warning lrx-font-bold" ng-cloak ng-show="signupForm.$generalError" ng-bind="signupForm.$generalErrorText"></div>
        </div>
        <div class="switch-to-login-section">
            Already have an account?
                <button id="switch-to-login" type="button" tabindex="10" lrx-show-section section-type="1" class="lrx-btn-secondary-sm">
                Log In
            </button>
        </div>
    </div>
        <div class="login-container" ng-controller="LoginController">
            <div ng-cloak ng-show="isSectionShown">
                <div class="login-input-area" ng-form name="loginForm" lrx-form-context context="PlayButton">
                    <div class="lrx-form-group" ng-class="{'has-error': ((loginForm.username.$dirty || badSubmit) && loginForm.username.$invalid || loginForm.username.showValidation), 'has-success': loginForm.username.$dirty && loginForm.username.$valid}">
                        <input id="login-username" class="form-control lrx-input-field" type="text" tabindex="1" placeholder="Username" name="username" lrx-form-interaction lrx-form-validation ng-required="true" ng-model="login.username"/>
                        <p id="login-username-input-validation" class="lrx-control-label input-validation lrx-text-danger" ng-bind="((loginForm.username.$dirty || badSubmit) && loginForm.username.$invalid || loginForm.username.showValidation) ? loginForm.username.$validationMessage : ''"></p>
                    </div>
                    <div class="lrx-form-group" ng-class="{'has-error': ((loginForm.password.$dirty || badSubmit) && loginForm.password.$invalid || loginForm.password.showValidation), 'has-success': loginForm.password.$dirty && loginForm.password.$valid}">
                        <input id="login-password" class="form-control lrx-input-field" type="password" tabindex="2" placeholder="Password" name="password" lrx-form-interaction lrx-form-validation lrx-form-validation-redact-input ng-required="true" ng-model="login.password" ng-keypress="enterLogin($event)">
                        <p id="login-password-input-validation" class="lrx-control-label input-validation lrx-text-danger" ng-bind="((loginForm.password.$dirty || badSubmit) && loginForm.password.$invalid || loginForm.password.showValidation) ? loginForm.password.$validationMessage : ''"></p>
                    </div>
                    <button id="login-button" type="button" ng-disabled="isSubmitting || isTwoStepSectionShown" lrx-form-interaction name="loginSubmit" tabindex="3" class="lrx-btn-primary-md" data-login-api-url="https://api.lunarix.com/login/v1" data-two-step-code-request-url="https://api.lunarix.com/twostepverification/request-unauthenticated" ng-click="submitLogin($event)">Log In</button>
                    <button id="switch-to-signup" type="button" tabindex="4" class="lrx-btn-secondary-md" lrx-show-section section-type="0">Sign Up</button>
                    <div id="general-login-error-text" class="input-validation-large lrx-alert-warning lrx-font-bold" ng-show="$generalError" ng-bind="$generalErrorText"></div>
                </div>
            <a href=" /login/resetpasswordrequest.aspx" target="_top" class="lrx-link lrx-font-sm">Forgot password?</a>
            </div>
    </div>
    
    <div class="captcha-container" ng-controller="CaptchaController" ng-form name="captchaForm" lrx-form-context context="PlayButton" ng-cloak ng-show="isSectionShown">
        <div class="captcha-response-message lrx-text-danger" ng-bind="$validationMessage"></div>
        <script type="text/javascript">
    var RecaptchaOptions = {
      theme : 'white',
      tabindex : 0
    };

</script><script type="text/javascript" src="https://www.google.com/recaptcha/api/challenge?k=6Le88gcTAAAAALG04IFgQDENWlQmc_hy_3tdF1yY">

</script><noscript>
    <iframe src="http://www.google.com/recaptcha/api/noscript?k=6Le88gcTAAAAALG04IFgQDENWlQmc_hy_3tdF1yY" width="500" height="300" frameborder="0">

    </iframe><br /><textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea><input name="recaptcha_response_field" value="manual_challenge" type="hidden" />
</noscript>
        <button id="CaptchaSubmitButton" class="lrx-btn-primary-md"
                data-signup-captcha-api-url="https://api.lunarix.com/captcha/validate/signup"
                data-log-in-captcha-api-url="https://api.lunarix.com/captcha/validate/login"
                ng-click="submitCaptcha($event)"
                ng-disabled="isSubmitting"
                lrx-form-interaction name="captchaSubmit">
            Submit
        </button>
    </div>
</div>

</div>


                <div id="Skyscraper-Adp-Right" class="abp abp-container right-abp">
                    

    <iframe allowtransparency="true"
            frameborder="0"
            height="612"
            scrolling="no"
            src="/userads/2"
            width="160"
            data-js-adtype="iframead"></iframe>


                </div>
</div>
@include('layout.footer')
@endsection
