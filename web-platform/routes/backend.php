<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend;
use App\Http\Controllers\General\Backend\Discord;
use App\Http\Controllers\General\Backend\Adverts\Bid;
use App\Http\Controllers\General\Backend\AbuseReport;
use App\Http\Controllers\General\Backend\AuthTicket;
use App\Http\Controllers\General\Backend\BCEligibility;
use App\Http\Controllers\General\Backend\CSS;
use App\Http\Controllers\General\Backend\CharacterCustomizer;
use App\Http\Controllers\General\Backend\Economy\GetCurrency;
use App\Http\Controllers\General\Backend\Economy\Purchase;
use App\Http\Controllers\General\Backend\Economy\RedeemPromocode;
use App\Http\Controllers\General\Backend\Economy\SellCollectible;
use App\Http\Controllers\General\Backend\Economy\Summary;
use App\Http\Controllers\General\Backend\Economy\TakeOffSale;
use App\Http\Controllers\General\Backend\Economy\Trades;
use App\Http\Controllers\General\Backend\Economy\Transactions;
use App\Http\Controllers\General\Backend\Games\CanManage;
use App\Http\Controllers\General\Backend\Games\GameInstances;
use App\Http\Controllers\General\Backend\Games\MoreResults;
use App\Http\Controllers\General\Backend\Games\PlayerCount;
use App\Http\Controllers\General\Backend\Games\VoteOnGame;
use App\Http\Controllers\General\Backend\Heartbeat;
use App\Http\Controllers\General\Backend\Renders\AssetRender;
use App\Http\Controllers\General\Backend\Renders\UserRender;
use App\Http\Controllers\General\Backend\UpdateItem;
use App\Http\Controllers\General\Backend\UpdateSettings;
use App\Http\Controllers\General\Backend\UploadToCatalog;
use App\Http\Controllers\General\Backend\Users\CheckUsername;
use App\Http\Controllers\General\Backend\Users\UpdateUsername;
use App\Http\Controllers\General\Backend\Users\UserInformation;
use App\Http\Controllers\RBXApis\Notifications;
use App\Http\Controllers\Upload\Place;
use App\Http\Controllers\Upload\UpdatePlace;
use App\Http\Controllers\Upload\UserAdverts;
use App\Http\Controllers\Upload\VideoUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/landing/signup', [AuthController::class, 'signup'])->middleware(['throttle:timeout']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login/v1', [AuthController::class, 'login']);
Route::post('/mobileapi/login', [AuthController::class, 'loginMobile']);
Route::get('/www/e.png', [Heartbeat::class, 'heartbeat']);
Route::get('/Thumbs/Asset.ashx', [AssetRender::class, 'redirectAssetRender']);
Route::get('/Thumbs/{type}.ashx', [UserRender::class, 'redirectRender']);
Route::get('/thumbs/asset.ashx', [AssetRender::class, 'redirectAssetRender']);
Route::get('/thumbs/{type}.ashx', [UserRender::class, 'redirectRender']);
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
Route::get('/CSS/Base/CSS/FetchCSS', [CSS::class, 'cssfetch'])->name('cssfetch');
Route::post('/voting/vote', [VoteOnGame::class, 'voteOnGame'])->middleware('auth');
Route::get('/users/v1/check-if-taken', [CheckUsername::class, 'checkUsername']);
Route::get('/api/economy/v1/users/{userid}/currency', [GetCurrency::class, 'getCurrency']);
Route::match(['get', 'post'], '/AbuseReport/InGameChatHandler.ashx', [AbuseReport::class, 'inGameChat']);
Route::match(['get', 'post'], '/abusereport/InGameChatHandler.ashx', [AbuseReport::class, 'inGameChat']);
Route::get('/abusereport/{subject}', [AbuseReport::class, 'create'])->where('subject', '[A-Za-z]+');
Route::get('/AbuseReport/{subject}', [AbuseReport::class, 'create'])->where('subject', '[A-Za-z]+');
Route::post('/abusereport/{subject}', [AbuseReport::class, 'store'])->where('subject', '[A-Za-z]+');
Route::post('/AbuseReport/{subject}', [AbuseReport::class, 'store'])->where('subject', '[A-Za-z]+');
Route::get('/api/notifications/v2/stream-notifications/unread-count', [Notifications::class, 'getNotifs']);
Route::get('/games/moreresultscached', [MoreResults::class, 'moreResultsCached']);
Route::post('/API/Item.ashx', [Purchase::class, 'purchase'])->middleware('auth');
Route::post('/My/Character.aspx', [CharacterCustomizer::class, 'characterCustomizer']);
Route::middleware('auth')->group(function () {
    Route::get('/discord/redirect', [Discord::class, 'redirect'])->name('discord.redirect');
    Route::get('/discord/callback', [Discord::class, 'callback'])->name('discord.callback');
    Route::delete('/discord/unlink', [Discord::class, 'requestUnlink'])->name('discord.unlink');
    Route::post('/account/username/verifyupdate', [UpdateUsername::class, 'verifyUsernameUpdate']);
    Route::post('/account/username/update', [UpdateUsername::class, 'updateUsername']);
});
Route::get('/discord/approve/{token}', [Discord::class, 'approve'])->name('discord.approve');
Route::post('/discord/approve/{token}', [Discord::class, 'confirm'])->name('discord.confirm');
Route::post('/discord/password-reset/{token}', [Discord::class, 'resetPassword'])->name('discord.password-reset');
Route::post('/api/upload', [UploadToCatalog::class, 'uploadToCatalog']);
Route::get('/reference/styleguide', function () {
    return view('styleguide');
});
Route::post('/my/account/update', [UpdateSettings::class, 'updateSettings']);
Route::get('/games/getgameinstancesjson', [GameInstances::class, 'getGameInstances']);
Route::get('/game/getauthticket', [AuthTicket::class, 'getAuthTicket']);
Route::get('/developer-apis/player-count', [PlayerCount::class, 'playerCount']);
Route::get('/developer-apis/userinfo', [UserInformation::class, 'userInformation']);
Route::get('/users/{id}/canmanage/{gameid}', [CanManage::class, 'canManage']);
Route::post('/My/Money.aspx/GetMyTransactions', [Transactions::class, 'getMyTransactions']);
Route::post('/My/Money.aspx/GetSummary', [Summary::class, 'getMySummary']);
Route::post('/api/video/upload', [VideoUpload::class, 'upload']);
Route::post('/promocodes/redeem', [RedeemPromocode::class, 'redeemPromocode']);
Route::post('/API/CreatePlace', [Place::class, 'storePlace']);
Route::get('/places/{id}/update', [UpdatePlace::class, 'edit'])->middleware('auth');
Route::post('/API/ConfigurePlace', [UpdatePlace::class, 'update'])->middleware('auth');
Route::post('/API/ConfigurePlace/UploadFile', [UpdatePlace::class, 'uploadFile'])->middleware('auth');
Route::post('/API/ConfigurePlace/UploadThumbnail', [UpdatePlace::class, 'uploadThumbnail'])->middleware('auth');
Route::post('/API/ConfigureItem', [UpdateItem::class, 'updateItem']);
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
Route::post('/collectible/sell', [SellCollectible::class, 'sellCollectible'])->middleware('auth');
Route::post('/collectible/take-off-sale', [TakeOffSale::class, 'takeOffSale'])->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::post('/Upgrades/BCEligibility.ashx', [BCEligibility::class, 'redeemBc']);
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