<?php
use App\Http\Controllers\Admin\AccessKeys;
use App\Http\Controllers\Admin\AbuseReportManagement;
use App\Http\Controllers\Admin\AssetManagement;
use App\Http\Controllers\Admin\AssetRerender;
use App\Http\Controllers\Admin\AssetReview;
use App\Http\Controllers\Admin\CreateAsset;
use App\Http\Controllers\Admin\CreatePlace;
use App\Http\Controllers\Admin\CreateUser;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\FeedMonitor;
use App\Http\Controllers\Admin\GameManagement;
use App\Http\Controllers\Admin\GameServers;
use App\Http\Controllers\Admin\ModLogs;
use App\Http\Controllers\Admin\ServerUsage;
use App\Http\Controllers\Admin\SiteWideAlert;
use App\Http\Controllers\Admin\UserLookup;
use App\Http\Controllers\Admin\UserManagement;
use App\Http\Controllers\Admin\MigrateAsset;
use App\Http\Controllers\Admin\GameEx;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbuseReportController;
use App\Http\Controllers\Backend;
use App\Http\Controllers\DiscordAccountController;
use App\Http\Controllers\Frontend;
use App\Http\Controllers\RBXApiController;
use App\Http\Controllers\RBXApis\Ads\Sponsored;
use App\Http\Controllers\RBXApis\Asset;
use App\Http\Controllers\RBXApis\Feed;
use App\Http\Controllers\RBXApis\Friends\CountRequests;
use App\Http\Controllers\RBXApis\Friends\FriendService;
use App\Http\Controllers\RBXApis\Friends\Friends;
use App\Http\Controllers\RBXApis\Friends\SocialControls;
use App\Http\Controllers\RBXApis\Game\Joinscript;
use App\Http\Controllers\RBXApis\Game\PlaceLauncher;
use App\Http\Controllers\RBXApis\Game\StartGame;
use App\Http\Controllers\RBXApis\Game\Studio;
use App\Http\Controllers\RBXApis\Game\Whitelist;
use App\Http\Controllers\RBXApis\Games\Recommendations;
use App\Http\Controllers\RBXApis\Inventory\FetchAssets;
use App\Http\Controllers\RBXApis\Locale;
use App\Http\Controllers\RBXApis\Login\Negotiate;
use App\Http\Controllers\RBXApis\LuaWebService\HandleSocial;
use App\Http\Controllers\RBXApis\AC\ACLog;
use App\Http\Controllers\RBXApis\DStores;
use App\Http\Controllers\Upload\VideoUpload;
use App\Http\Controllers\Upload\Place;
use App\Http\Controllers\Upload\UpdatePlace;
use App\Http\Controllers\RBXApis\Messages;
use App\Http\Controllers\RBXApis\Misc\Notification;
use App\Http\Controllers\RBXApis\Misc\Validation;
use App\Http\Controllers\RBXApis\Mobile\StaticResp;
use App\Http\Controllers\RBXApis\Notifications;
use App\Http\Controllers\RBXApis\RCC\CloseGameServer;
use App\Http\Controllers\RBXApis\RCC\ServerEntryLogger;
use App\Http\Controllers\RBXApis\RCC\Analytics;
use App\Http\Controllers\RBXApis\RCC\KillLogger;
use App\Http\Controllers\RBXApis\Setting\AppSettings;
use App\Http\Controllers\RBXApis\Marketplace\ProductInfo;
use App\Http\Controllers\RBXApis\Status;
use App\Http\Controllers\RBXApis\Thumbs\Batch;
use App\Http\Controllers\RBXApis\Universe\ValidateJoin;
use App\Http\Controllers\RBXApis\Legacy\AssetComment;
use App\Http\Controllers\RBXApis\Videos\VideoV1;
use App\Http\Controllers\General\UserAds;
use App\Http\Controllers\Upload\UserAdverts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\General\UserInfo;
use App\Http\Controllers\General\Frontend\Forums;
use App\Http\Controllers\General\Frontend\Eligibility;
use App\Http\Controllers\General\Frontend\AdUploader;
use App\Http\Controllers\General\Backend\BCEligibility;
use App\Http\Controllers\General\Backend\Adverts\Bid;
use App\Http\Controllers\General\Backend\Economy\Trades;
use App\Http\Controllers\General\Frontend\Groups;

Route::match(['get', 'post'], '/', function (Request $request) {
    $auth = app(AuthController::class);
    $currentUser = $auth->getAuthenticatedUser($request);
    if ($currentUser) {
        return redirect('/home');
    }
    return view('landing');
});
Route::match(['get', 'post'], '/landing2', function (Request $request) {
    $auth = app(AuthController::class);
    $currentUser = $auth->getAuthenticatedUser($request);
    $isClient = str_contains($request->userAgent() ?? '', 'ROBLOX') || $request->header('requester') === 'Client' || $request->hasHeader('xboxaccesskey');
    if ($isClient) {
        if ($currentUser) {
            return response()->json(['UserId' => $currentUser->id, 'Username' => $currentUser->username]);
        }
        return response()->json(['userid' => 0, 'username' => 'Guest']);
    }
    if ($currentUser) {
        return redirect('/home');
    }
    return view('landing2');
});
Route::post('/landing/signup', [AuthController::class, 'signup'])->middleware(['throttle:timeout']);
Route::get('/login', [Frontend::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login/v1', [AuthController::class, 'login']);
Route::post('/mobileapi/login', [AuthController::class, 'loginMobile']);
Route::get('/home', [Frontend::class, 'home']);
Route::get('/users/{id}/profile', [Frontend::class, 'userProfile']);
Route::get('/my/account', [Frontend::class, 'settings']);
Route::get('/www/e.png', [Backend::class, 'heartbeat']);
Route::post('/apis/update/blurb', [Backend::class, 'updateblurb']);
Route::get('/users/{id}/friends', [Frontend::class, 'userFriends']);
Route::get('/users/{id}/inventory', [Frontend::class, 'userInventory']);
Route::get('/groups', [Frontend::class, 'groupIndex']);
Route::get('/groups/{id}', [Frontend::class, 'groupProfile']);
Route::get('/api/friends/{userid}', [Backend::class, 'fetchFriends']);
Route::get('/api/friends/request/{userid}', [Backend::class, 'fetchFriendRequests']);
Route::post('/api/friends/request/{userid}/accept', [Backend::class, 'acceptFriendRequest']);
Route::post('/api/friends/request/{userid}/decline', [Backend::class, 'declineFriendRequest']);
Route::post('/api/friends/{id}/add', [Backend::class, 'addFriend']);
Route::post('/api/friends/{id}/remove', [Backend::class, 'unfriend']);
Route::get('/Thumbs/Asset.ashx', [Backend::class, 'redirectAssetRender']);
Route::get('/Thumbs/{type}.ashx', [Backend::class, 'redirectRender']);
Route::get('/thumbs/asset.ashx', [Backend::class, 'redirectAssetRender']);
Route::get('/thumbs/{type}.ashx', [Backend::class, 'redirectRender']);
Route::get('/Asset/BodyColors.ashx', [RBXApiController::class, 'bodyColors']);
Route::get('/v1/avatar-fetch', [RBXApiController::class, 'avatarFetch']);
Route::get('/v1.1/avatar-fetch', [RBXApiController::class, 'avatarFetch']);
Route::get('/v2/avatar-fetch', [RBXApiController::class, 'avatarFetchV2']);
Route::get('/Asset/CharacterFetch.ashx', [Asset::class, 'avatarFetch']);
Route::post('/Login/FulfillConstraint.aspx', function (Request $request) {
    $key = trim((string) $request->input('ctl00$cphLunarix$Textbox1', ''));
    $maintenanceKey = trim((string) config('app.maintenance_key'));
    if ($maintenanceKey === '' || $key === '' || ! hash_equals($maintenanceKey, $key)) {
        return response()->view('maintenance', [], 503);
    }
    return redirect('/')->withCookie(cookie('security_mntnb', hash('sha256', $maintenanceKey), 60 * 24 * 30, '/', null, request()->isSecure(), true));
})->middleware(['resolve.ip', 'throttle:timeout'])->name('maintenance.unlock');
Route::get('/authentication/logout', [AuthController::class, 'logout']);
Route::post('/authentication/logout', [AuthController::class, 'logout']);
Route::post('/mobileapi/logout', [AuthController::class, 'logout']);
Route::get('/keys', [Frontend::class, 'accessKeys']);
Route::post('/keys/create', [Backend::class, 'createAccessKey']);
Route::get('/js/fetch', [Backend::class, 'jsfetch']);
Route::get('/CSS/Base/CSS/FetchCSS', [Backend::class, 'cssfetch'])->name('cssfetch');
Route::get('/membership/suspended', [Frontend::class, 'membershipSuspended'])->name('membership.suspended');
Route::post('/useraccount/reactivate', [Frontend::class, 'reactivateAccount'])->name('membership.reactivate');
Route::get('/games', function () {
    return view('games');
});
Route::get('/v1/games/list-categories', [Backend::class, 'listCategories']);
Route::get('/v1/games/list-games', [Backend::class, 'listGames']);
Route::get('/legal/terms', [Frontend::class, 'terms']);
Route::get('/legal/privacy', [Frontend::class, 'privacy']);
Route::get('/asset', [Asset::class, 'serveAsset']);
Route::get('/Asset', [Asset::class, 'serveAsset']);
Route::get('/catalog', [Frontend::class, 'catalog']);
Route::get('/Login/FulfillConstraint.aspx', function () {
    return view('maintenance');
});
Route::get('/my/messages', [Frontend::class, 'mymessages']);
Route::get('/{slug}-item', [Frontend::class, 'item'])->where('slug', '.*');
Route::get('/messages/compose', [Frontend::class, 'composeMessage']);
Route::get('/games/{id}/{slug}', [Frontend::class, 'showGame'])->name('games.view');
Route::middleware('auth')->group(function () {
    Route::post('/favorite/toggle', [Frontend::class, 'toggleGameFavorite'])->name('games.favorite.toggle');
    Route::post('/voting/vote', [Backend::class, 'voteOnGame']);
});
Route::get('/users/v1/check-if-taken', [Backend::class, 'checkUsername']);
Route::get('/api/economy/v1/users/{userid}/currency', [Backend::class, 'getCurrency']);
Route::match(['get', 'post'], 'api/thumbs/v1/batch', [Batch::class, 'getBatch']);
Route::match(['get', 'post'], '/mobileapi/check-app-version', [StaticResp::class, 'checkAppVersion']);
Route::match(['get', 'post'], '/device/initialize', [StaticResp::class, 'initializeDevice']);
Route::match(['get', 'post'], '/v1.0/SequenceStatistics/AddToSequence', [StaticResp::class, 'telemetry']);
Route::match(['get', 'post'], '/v1.1/Counters/Increment', [StaticResp::class, 'telemetry']);
Route::match(['get', 'post'], '/v1.0/SequenceStatistics/BatchAddToSequencesV2', [StaticResp::class, 'telemetry']);
Route::match(['get', 'post'], '/v1.0/MultiIncrement', [StaticResp::class, 'telemetry']);
Route::match(['get', 'post'], '/game/report-stats', [StaticResp::class, 'telemetry']);
Route::match(['get', 'post'], '/usercheck/show-tos', [StaticResp::class, 'telemetry']);
Route::match(['get', 'post'], '/notifications/signalr/negotiate', [StaticResp::class, 'telemetry']);
Route::match(['get', 'post'], '/notifications/negotiate', [StaticResp::class, 'telemetry']);
Route::match(['get', 'post'], '/v1.1/Counters/BatchIncrement', [StaticResp::class, 'telemetry']);
Route::match(['get', 'post'], '/mobile/pbe', [StaticResp::class, 'telemetry']);
Route::match(['get', 'post'], '/client/pbe', [StaticResp::class, 'telemetry']);
Route::get('/api/locale/v1/locales', [Locale::class, 'getLocale']);
Route::get('/api/locale/v1/locales/user-localization-locus-supported-locales', [Locale::class, 'getUserLocale']);
Route::post('/api/discovery-api/omni-recommendation', [Recommendations::class, 'omniSorts']);
Route::get('/users/friends/list-json', [Friends::class, 'getFriends']);
Route::post('/api/presence/v1/presence/users', [Status::class, 'getPresence']);
Route::get('/api/ads/v1/sponsored-pages', [Sponsored::class, 'get']);
Route::get('/api/accountsettings/v1/email', function () {
    return response()->json(['emailAddress' => 'burger@burger.com', 'verified' => true, 'canBypassPasswordForEmailUpdate' => true]);
});
Route::get('/api/auth/v1/password/current-status', function () {
    return response()->json(['valid' => true]);
});
Route::match(['get', 'post'], '/AbuseReport/InGameChatHandler.ashx', [AbuseReportController::class, 'inGameChat']);
Route::match(['get', 'post'], '/abusereport/InGameChatHandler.ashx', [AbuseReportController::class, 'inGameChat']);
Route::get('/abusereport/{subject}', [AbuseReportController::class, 'create'])->where('subject', '[A-Za-z]+');
Route::get('/AbuseReport/{subject}', [AbuseReportController::class, 'create'])->where('subject', '[A-Za-z]+');
Route::post('/abusereport/{subject}', [AbuseReportController::class, 'store'])->where('subject', '[A-Za-z]+');
Route::post('/AbuseReport/{subject}', [AbuseReportController::class, 'store'])->where('subject', '[A-Za-z]+');
Route::get('/api/privatemessages/v1/messages/unread/count', function () {
    return response()->json(['count' => '69']);
});
Route::get('/api/trades/v1/trades/inbound/count', function () {
    return response()->json(['count' => '69']);
});
Route::get('/api/notifications/v2/stream-notifications/unread-count', [Notifications::class, 'getNotifs']);
Route::get('/api/friends/v1/user/friend-requests/count', [CountRequests::class, 'count']);
Route::get('/user/following-exists', [SocialControls::class, 'followingExists']);
Route::get('/user/get-friendship-count', [SocialControls::class, 'friendshipCount']);
Route::match(['get', 'post'], '/user/request-friendship', [SocialControls::class, 'requestFriendship']);
Route::post('/user/follow', [SocialControls::class, 'follow']);
Route::post('/api/user/unfollow', [SocialControls::class, 'unfollow']);
Route::get('/Friend/AreFriends', [FriendService::class, 'areFriends']);
Route::get('/Friend/AreFriends.ashx', [FriendService::class, 'areFriends']);
Route::get('/friend/arefriends', [FriendService::class, 'areFriends']);
Route::get('/friend/arefriends.ashx', [FriendService::class, 'areFriends']);
Route::get('/UserCheck/checkifinvalidusernameforsignup', [Validation::class, 'checkUsernameAvailability']);
Route::get('/UserCheck/doesusernameexist', [Validation::class, 'checkUserifexists']);
Route::get('/LunarixDefaultErrorPage.aspx', function (Request $request) {
    $code = (int) $request->query('code', 500);
    if ($code < 400 || $code > 599) {
        $code = 500;
    }

    return response()->view('ldef', ['code' => $code, 'ref' => $request->query('ref')], $code);
});
Route::get('/viewapp/common/template/modal/window.html', function () {
    return view('extra.modal');
});
Route::get('/viewapp/common/template/modal/backdrop.html', function () {
    return view('extra.backdrop');
});
Route::get('/viewapp/common/template/tooltip/tooltip-popup.html', function () {
    return view('extra.tooltippopup');
});
Route::get('/viewapp/common/thumbnail.html', function () {
    return view('extra.thumbnail');
});
Route::get('/viewapp/common/tabs.html', function () {
    return view('extra.tabs');
});
Route::get('/viewapp/pages/messages/directives/messagesNav.html', function () {
    return view('extra.messages.nav');
});
Route::get('/viewapp/pages/messages/directives/messagesList.html', function () {
    return view('extra.messages.list');
});
Route::get('/viewapp/pages/messages/directives/messagesDetail.html', function () {
    return view('extra.messages.detail');
});
Route::get('/viewapp/pages/messages/controllers/message.html', function () {
    return view('extra.messages.controller');
});
Route::get('/viewapp/pages/messages/controllers/notification.html', function () {
    return view('extra.messages.notification');
});
Route::get('/Upgrades/BloxxersClubMemberships.aspx', function () {
    return view('premium.membership');
});
Route::get('/games/moreresultscached', [Backend::class, 'moreResultsCached']);
Route::post('/api/friends/sendfriendrequest', [SocialControls::class, 'addFriend']);
Route::post('/api/friends/removefriend', [SocialControls::class, 'removeFriend']);
Route::post('/api/friends/acceptfriendrequest', [SocialControls::class, 'acceptFriendRequest']);
Route::post('/api/friends/declinefriendrequest', [SocialControls::class, 'declineFriendRequest']);
Route::post('/feedifications/post', [Feed::class, 'post'])->middleware(['throttle:timeout']);
Route::get('/notifications/api/get-notifications', [Notification::class, 'index']);
Route::get('/messages/api/get-messages', [Messages::class, 'getMessages']);
// TODO: move to frontend.php
Route::get('/User.aspx', function (Request $request) {
    if ($request->has('ID')) {
        return redirect('/users/'.$request->ID.'/profile');
    }
    $user = auth()->user();
    if (! $user) {
        redirect('/');
    }

    return redirect('/users/'.$user->id.'/profile');
});
Route::get('/friends.aspx', function (Request $request) {
    $user = $request->user();
    if (! $user) {
        return redirect('/login');
    }

    return redirect('/users/'.$user->id.'/friends');
});
Route::post('/messages/api/send-message', [Messages::class, 'sendMessage']);
Route::post('/messages/api/mark-messages-read', [Messages::class, 'markMessagesRead']);
Route::match(['get', 'post'], '/Game/PlaceLauncher.ashx', [PlaceLauncher::class, 'handle']);
Route::get('/games/start', [StartGame::class, 'handle']);
Route::get('/game/studio.ashx', [Studio::class, 'handle']);
Route::get('/Game/Studio.ashx', [Studio::class, 'handle']);
Route::get('/game/Studio.ashx', [Studio::class, 'handle']);
Route::match(['get', 'post'], '/Game/Join.ashx', [Joinscript::class, 'handle']);
Route::match(['get', 'post'], '/Login/Negotiate.ashx', [Negotiate::class, 'handle']);
Route::match(['get', 'post'], '/Login/NegotiateAsync.ashx', [Negotiate::class, 'handle']);
Route::match(['get', 'post'], '/Setting/QuietGet/ClientAppSettings', [AppSettings::class, 'client']);
Route::match(['get', 'post'], '/Setting/QuietGet/ClientSharedSettings', [AppSettings::class, 'shared']);
Route::match(['get', 'post'], '/Setting/QuietGet/AndroidAppSettings', [AppSettings::class, 'android']);
Route::match(['get', 'post'], '/Setting/QuietGet/RCCServiceaRWyf4zz9jy', [AppSettings::class, 'rcc']);
Route::match(['get', 'post'], '/Setting/QuietGet/XboxAppSettings', [AppSettings::class, 'xbox']);
Route::get('/GetAllowedMD5Hashes', [Whitelist::class, 'getAllowedMd5Hashes']);
Route::get('/GetAllowedSecurityVersions', [Whitelist::class, 'getAllowedSecurityVersions']);
Route::get('/GetAllowedSecurityKeys', [Whitelist::class, 'getAllowedSecurityKeys']);
Route::get('/universes/validate-place-join', [ValidateJoin::class, 'validate']);
Route::get('/asset/roblox', [Asset::class, 'serveRobloxAsset']);
Route::get('/Game/LuaWebService/HandleSocialRequest.ashx', [HandleSocial::class, 'handle']);
Route::get('/Login/iFrameLogin.aspx', function () {
    return view('iframelogin');
});
Route::post('/API/Item.ashx', [Backend::class, 'purchase'])->middleware('auth');
Route::get('/disclaimer', function () {
    return view('disclaimer');
});
Route::get('/disclaimer/agree', function () {
    $redirect = request()->query('redirect', '/');

    return redirect($redirect)->withCookie(cookie('AgreedToDisclaimer', 'true', 60 * 24 * 365));
})->name('disclaimer.agree');
Route::get('/My/Character.aspx', [Frontend::class, 'characterCustomizer']);
Route::get('/info/terms-of-service', function () {
    return view('legal.tos');
});
Route::get('/info/Privacy.aspx', function () {
    return view('legal.privacy');
});
Route::get('/contributors', function () {
    return view('contributors');
});
Route::post('/My/Character.aspx', [Backend::class, 'characterCustomizer']);
Route::get('/users/inventory/list-json', [FetchAssets::class, 'fetchJson']);
Route::get('/users/inventory/recommended-json', [FetchAssets::class, 'fetchRecommendedJson']);
Route::get('/discord', function () {
    return redirect('https://discord.gg/JReS4PM8Gf');
});
Route::get('/account/signupredir', function () {
    return redirect('/');
});
Route::get('/Login/NewAge.aspx', function () {
    return redirect('/');
});
Route::get('/login/Default.aspx', function () {
    return redirect('/login');
});
Route::middleware(['auth'])->group(function () {
    Route::middleware('role:1')->prefix('administration')->group(function () {
        Route::get('/', fn () => redirect('/administration/dashboard'));
        Route::get('/dashboard', [Dashboard::class, 'index']);
        Route::get('/shoutbox', fn () => view('admin.placeholder', [
            'pageTitle' => 'Shoutbox',
            'pageDescription' => 'Manage staff and community shoutbox messages.',
        ]));
        Route::get('/asset/find', [AssetManagement::class, 'index'])->name('admin.assets.find');
        Route::get('/asset/{asset}/edit', [AssetManagement::class, 'edit'])->name('admin.assets.edit');
        Route::put('/asset/{asset}', [AssetManagement::class, 'update'])->name('admin.assets.update');
        Route::get('/asset/queue', [AssetReview::class, 'index'])->name('admin.assets.review');
        Route::put('/asset/{asset}/approval', [AssetReview::class, 'update'])->name('admin.assets.review.update');
        Route::get('/asset/{asset}/review-preview', [AssetReview::class, 'preview'])->name('admin.assets.review.preview');
        Route::get('/asset/{asset}/review-download', [AssetReview::class, 'download'])->name('admin.assets.review.download');
        Route::put('/videos/review/{video}', [AssetReview::class, 'updateVideo'])->name('admin.videos.review.update');
        Route::get('/videos/review/{video}/preview', [AssetReview::class, 'previewVideo'])->name('admin.videos.review.preview');
        Route::get('/videos/review/{video}/download', [AssetReview::class, 'downloadVideo'])->name('admin.videos.review.download');
    });
    Route::middleware('role:2')->prefix('administration')->group(function () {
        Route::get('/find', [UserLookup::class, 'index']);
        Route::get('/feeds', [FeedMonitor::class, 'index'])->name('admin.feeds.index');
        Route::post('/feeds/{feed}/content-deletion', [FeedMonitor::class, 'deleteContent'])->name('admin.feeds.content-deletion');
        Route::get('/reports', [AbuseReportManagement::class, 'index'])->name('admin.reports.index');
        Route::get('/reports/{report}', [AbuseReportManagement::class, 'show'])->name('admin.reports.show');
        Route::put('/reports/{report}', [AbuseReportManagement::class, 'update'])->name('admin.reports.update');
        Route::get('/find/game', [GameManagement::class, 'index'])->name('admin.games.find');
        Route::get('/games/{game}/edit', [GameManagement::class, 'edit'])->name('admin.games.edit');
        Route::put('/games/{game}', [GameManagement::class, 'update'])->name('admin.games.update');
        Route::post('/games/{game}/content-deletion', [GameManagement::class, 'deleteContent'])->name('admin.games.content-deletion');
        Route::get('/users/{user}', [UserManagement::class, 'show'])->name('admin.users.show');
        Route::post('/users/{user}/message', [UserManagement::class, 'sendMessage'])->name('admin.users.message');
        Route::post('/users/{user}/punishment', [UserManagement::class, 'punish'])->name('admin.users.punishment');
        Route::post('/users/{user}/reactivate', [UserManagement::class, 'reactivate'])->name('admin.users.reactivate');
        Route::post('/users/{user}/content-deletion', [UserManagement::class, 'deleteContent'])->name('admin.users.content-deletion');
    });
    Route::middleware('role:4')->prefix('administration')->group(function () {
        Route::post('/users/{user}/discord/password-reset', [UserManagement::class, 'sendDiscordPasswordReset'])->name('admin.users.discord.password-reset');
        Route::post('/users/{user}/currency', [UserManagement::class, 'updateCurrency'])->name('admin.users.currency');
        Route::post('/users/{user}/membership', [UserManagement::class, 'updateMembership'])->name('admin.users.membership');
        Route::post('/users/{user}/inventory', [UserManagement::class, 'grantCatalogItem'])->name('admin.users.inventory.grant');
        Route::delete('/users/{user}/inventory/{inventory}', [UserManagement::class, 'revokeCatalogItem'])->name('admin.users.inventory.revoke');
        Route::get('/keys', [AccessKeys::class, 'index']);
        Route::post('/keys/create', [AccessKeys::class, 'createAccessKey']);
        Route::get('/logs', [ModLogs::class, 'index'])->name('admin.logs');
        Route::get('/asset/create', [CreateAsset::class, 'index'])->name('admin.assets.create');
        Route::post('/asset/create', [CreateAsset::class, 'store'])->name('admin.assets.create.store');
        Route::get('/asset/migrate', [MigrateAsset::class, 'index'])->name('admin.assets.migrator');
        Route::post('/asset/migrate', [MigrateAsset::class, 'migrateFromRoblox'])->name('admin.assets.migrate-roblox');
        Route::get('/asset/rerender', [AssetRerender::class, 'index'])->name('admin.assets.rerender');
        Route::post('/asset/rerender', [AssetRerender::class, 'store'])->name('admin.assets.rerender.store');
    });
    Route::middleware('role:5')->prefix('administration')->group(function () {
        Route::post('/users/{user}/staff-role', [UserManagement::class, 'updateStaffRole'])->name('admin.users.staff-role');
    });
    Route::middleware('role:6')->prefix('administration')->group(function () {
        Route::post('/users/{user}/discord/link', [UserManagement::class, 'requestDiscordLink'])->name('admin.users.discord.link');
        Route::post('/users/{user}/discord/unlink', [UserManagement::class, 'requestDiscordUnlink'])->name('admin.users.discord.unlink');
        Route::get('/alert', fn () => view('admin.alert'));
        Route::post('/alert', [SiteWideAlert::class, 'update']);
        Route::get('/dev/ping', fn () => view('admin.dev.ping'));
        Route::get('/dev/ping/now', function () {
            return response('PONG');
        });
        Route::get('/dev/vps', [ServerUsage::class, 'index']);
        Route::get('/dev/vps/metrics', [ServerUsage::class, 'metrics']);
        Route::get('/dev/gs', [GameServers::class, 'index'])->name('admin.game-servers.index');
        Route::post('/dev/gs/{server}/stop', [GameServers::class, 'stop'])->name('admin.game-servers.stop');
        Route::delete('/dev/gs/{server}', [GameServers::class, 'forget'])->name('admin.game-servers.forget');
        Route::get('/dev/createuser', [CreateUser::class, 'index'])->name('admin.dev.create-user');
        Route::post('/dev/createuser', [CreateUser::class, 'store'])->name('admin.dev.create-user.store');
        Route::get('/dev/createplace', [CreatePlace::class, 'index'])->name('admin.dev.create-place');
        Route::post('/dev/createplace', [CreatePlace::class, 'store'])->name('admin.dev.create-place.store');
        Route::get('/dev/gameex', [GameEx::class, 'index'])->name('admin.dev.gameex');
        Route::get('/dev/gameex/manage', [GameEx::class, 'manage'])->name('admin.dev.gameex.manage');
    });
});
Route::middleware('auth')->group(function () {
    Route::get('/discord/redirect', [DiscordAccountController::class, 'redirect'])->name('discord.redirect');
    Route::get('/discord/callback', [DiscordAccountController::class, 'callback'])->name('discord.callback');
    Route::delete('/discord/unlink', [DiscordAccountController::class, 'requestUnlink'])->name('discord.unlink');
    Route::post('/account/username/verifyupdate', [Backend::class, 'verifyUsernameUpdate']);
    Route::post('/account/username/update', [Backend::class, 'updateUsername']);
});
Route::get('/discord/approve/{token}', [DiscordAccountController::class, 'approve'])->name('discord.approve');
Route::post('/discord/approve/{token}', [DiscordAccountController::class, 'confirm'])->name('discord.confirm');
Route::post('/discord/password-reset/{token}', [DiscordAccountController::class, 'resetPassword'])->name('discord.password-reset');
//Route::get('/develop', [Frontend::class, 'develop'])->name('develop');
Route::get('/develop', [Frontend::class, 'develop'])->name('develop');
Route::post('/api/upload', [Backend::class, 'uploadToCatalog']);
Route::get('/reference/styleguide', function () {
    return view('styleguide');
});
Route::get('/places/create', [Frontend::class, 'createPlace']);
Route::post('/my/account', [Backend::class, 'settings']);
Route::post('/my/account/update', [Backend::class, 'updateSettings']);
Route::get('/videos', function () {
    return view('videos');
});
Route::get('/videos/moreresultscached', [Frontend::class, 'videoCards']);
Route::get('/videos/{id}/view', [Frontend::class, 'viewVideo']);
Route::get('/games/getgameinstancesjson', [Backend::class, 'getGameInstances']);
Route::get('/game/getauthticket', [Backend::class, 'getAuthTicket']);
Route::match(['get', 'post'], '/game/report-event', [StaticResp::class, 'telemetry']);
Route::match(['get', 'post'], '/client-status/set', [StaticResp::class, 'telemetry']);
Route::get('/developer-apis/player-count', [Backend::class, 'playerCount']);
Route::get('/developer-apis/userinfo', [Backend::class, 'userInformation']);
Route::post('/RCCApi/Game/UserJoin', [ServerEntryLogger::class, 'userJoin']);
Route::post('/RCCApi/Game/UserExit', [ServerEntryLogger::class, 'userExit']);
Route::post('/RCCApi/Game/CloseJob', [CloseGameServer::class, 'closeGameServer']);
Route::post('/RCCApi/Stats/Update', [KillLogger::class, 'update']);
Route::post('/RCCApi/Analytics/Report', [Analytics::class, 'report']);
Route::get('/catalog/browse.aspx', [Frontend::class, 'browseCatalog']);
Route::get('/search/users', [Frontend::class, 'searchUsers']);
Route::get('/users/{id}/canmanage/{gameid}', [Backend::class, 'canManage']);
Route::get('/My/Money.aspx', [Frontend::class, 'mymoney']);
Route::post('/My/Money.aspx/GetMyTransactions', [Backend::class, 'getMyTransactions']);
Route::post('/My/Money.aspx/GetSummary', [Backend::class, 'getMySummary']);
Route::post('/api/anticheat/log', [ACLog::class, 'log']);
Route::post('/api/comments.ashx', [AssetComment::class, 'legacyApi']);
Route::get('/comments/get-json', [AssetComment::class, 'getJson']);
Route::post('/api/video/upload', [VideoUpload::class, 'upload']);
Route::get('/promocodes', [Frontend::class, 'promocodes']);
Route::post('/promocodes/redeem', [Backend::class, 'redeemPromocode']);
Route::post('/API/CreatePlace', [Place::class, 'storePlace']);
Route::get('/places/{id}/update', [UpdatePlace::class, 'edit'])->middleware('auth');
Route::post('/API/ConfigurePlace', [UpdatePlace::class, 'update'])->middleware('auth');
Route::post('/API/ConfigurePlace/UploadFile', [UpdatePlace::class, 'uploadFile'])->middleware('auth');
Route::post('/API/ConfigurePlace/UploadThumbnail', [UpdatePlace::class, 'uploadThumbnail'])->middleware('auth');
Route::get('/my/Item.aspx', [Frontend::class, 'configureItem']);
Route::post('/API/ConfigureItem', [Backend::class, 'updateItem']);
Route::get('/userads/{type}', [UserAds::class, 'show'])->where('type', '[123]');
Route::get('/userads/redirect', [UserAds::class, 'redirect']);
Route::get('/marketplace/productinfo', [ProductInfo::class, 'productInfo']);
Route::get('/users/{id}', [UserInfo::class, 'show']);
Route::get('/v1/videos/{id}', [VideoV1::class, 'fetch']);
Route::get('/hos', function () {
    $path = storage_path('app/public/hos.txt');
    abort_unless(file_exists($path), 404);
    return response(file_get_contents($path), 200)->header('Content-Type', 'text/plain');
});
//temporary
Route::get('/my/friendsonline', function () {
    return response()->json([
        [
            'VisitorId' => 4,
            'GameId' => 'test',
            'IsOnline' => true,
            'LastOnline' => '2016-03-02T14:22:31.447Z',
            'LastLocation' => 'test',
            'LocationType' => 2,
            'PlaceId' => 1,
        ],
    ]);
});
Route::get('/user/get-vote-count', function (Request $request) {
    return response()->json(['VoteCount' => 0]);
});
Route::post('/persistence/set', [DStores::class, 'set']);
Route::get('/persistence/increment', [DStores::class, 'increment']);
Route::match(['get', 'post'], '/persistence/getsorted', [DStores::class, 'getSorted']);
Route::match(['get', 'post'], '/persistence/getV2', [DStores::class, 'getV2']);
Route::get('/Forum/default.aspx', [Forums::class, 'index']);
Route::get('/Forum/Default.aspx', [Forums::class, 'index'])->name('forums.default');
Route::get('/Forum/Search/default.aspx', [Forums::class, 'search']);
Route::get('/Forum/Search/Default.aspx', [Forums::class, 'search']);
Route::get('/Forum/ShowForum.aspx', [Forums::class, 'showForum'])->name('forums.showforum');
Route::get('/Forum/ShowPost.aspx', [Forums::class, 'showPost'])->name('forums.showpost');
Route::get('/Forum/ShowForumGroup.aspx', [Forums::class, 'showforumgroup'])->name('forums.showforumgroup');
Route::middleware('auth')->group(function () {
    Route::get('/Forum/AddPost.aspx', [Forums::class, 'addPostForm'])->name('forums.addpost');
    Route::post('/Forum/AddPost.aspx', [Forums::class, 'addPost'])->name('forums.addpost.submit')->middleware(['throttle:timeout']);
    Route::get('/Forum/NewReply.aspx', [Forums::class, 'newReplyForm'])->name('forums.newreply');
    Route::post('/Forum/NewReply.aspx', [Forums::class, 'newReply'])->name('forums.newreply.submit')->middleware(['throttle:timeout']);
    Route::get('/Forum/User/MyForums.aspx', [Forums::class, 'myforums'])->name('forums.myforums');
});
Route::post('/collectible/sell', [Backend::class, 'sellCollectible'])->middleware('auth');
Route::post('/collectible/take-off-sale', [Backend::class, 'takeOffSale'])->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/Upgrades/BCEligibility.aspx', [Eligibility::class, 'showBcPage'])->middleware('auth');
    Route::post('/Upgrades/BCEligibility.ashx', [BCEligibility::class, 'redeemBc']);
    Route::get('/My/NewUserAd.aspx', [AdUploader::class, 'show']);
    Route::post('/My/NewUserAd.ashx', [UserAdverts::class, 'store']);
    Route::post('/My/UpdateAdBid.ashx', [Bid::class, 'bid']);
});
Route::middleware('auth')->group(function () {
    Route::post('/My/Money.aspx/GetMyItemTrades', [Trades::class, 'getMyItemTrades'])->name('trades.list');
    Route::post('/Trade/TradeHandler.ashx', [Trades::class, 'tradeHandler'])->name('trades.handler');
    Route::post('/Trade/Create', [Trades::class, 'create'])->name('trades.create');
    Route::post('/Trade/{id}/Accept', [Trades::class, 'accept'])->name('trades.accept');
    Route::post('/Trade/{id}/Decline', [Trades::class, 'decline'])->name('trades.decline');
    Route::post('/Trade/{id}/Cancel', [Trades::class, 'cancel'])->name('trades.cancel');
});
Route::match(['get', 'post'], '/Groups/Group.aspx', [Groups::class, 'show']);
Route::match(['get', 'post'], '/My/Groups.aspx', [Groups::class, 'showMine']);