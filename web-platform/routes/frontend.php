<?php
use App\Http\Controllers\AuthController; //TODO: retire this in favor of auth()
use App\Http\Controllers\General\Frontend\AdUploader;
use App\Http\Controllers\General\Frontend\Catalog\Browse;
use App\Http\Controllers\General\Frontend\Catalog\ConfigureItem;
use App\Http\Controllers\General\Frontend\Catalog\Index;
use App\Http\Controllers\General\Frontend\Catalog\Item;
use App\Http\Controllers\General\Frontend\CharacterCustomizer;
use App\Http\Controllers\General\Frontend\Develop;
use App\Http\Controllers\General\Frontend\Eligibility;
use App\Http\Controllers\General\Frontend\Forums;
use App\Http\Controllers\General\Frontend\Games\ShowGame;
use App\Http\Controllers\General\Frontend\Games\CreatePlace;
use App\Http\Controllers\General\Frontend\Groups;
use App\Http\Controllers\General\Frontend\Home;
use App\Http\Controllers\General\Frontend\Login;
use App\Http\Controllers\General\Frontend\Messages\Compose;
use App\Http\Controllers\General\Frontend\Messages\MyMessages;
use App\Http\Controllers\General\Frontend\MyMoney;
use App\Http\Controllers\General\Frontend\Profile;
use App\Http\Controllers\General\Frontend\Promocodes;
use App\Http\Controllers\General\Frontend\Settings;
use App\Http\Controllers\General\Frontend\Suspension;
use App\Http\Controllers\General\Frontend\Users\Inventory;
use App\Http\Controllers\General\Frontend\Users\Search;
use App\Http\Controllers\General\Frontend\Users\Friends;
use App\Http\Controllers\General\Frontend\Videos\VideoCards;
use App\Http\Controllers\General\Frontend\Videos\ViewVideo;
use App\Http\Controllers\General\UserAds;
use App\Http\Controllers\General\UserInfo;
use App\Http\Controllers\RBXApis\Videos\VideoV1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/login', [Login::class, 'login'])->name('login');
Route::get('/home', [Home::class, 'home']);
Route::get('/users/{id}/profile', [Profile::class, 'userProfile']);
Route::get('/my/account', [Settings::class, 'settings']);
Route::get('/users/{id}/friends', [Friends::class, 'userFriends']);
Route::get('/users/{id}/inventory', [Inventory::class, 'userInventory']);
Route::get('/membership/suspended', [Suspension::class, 'membershipSuspended'])->name('membership.suspended');
Route::post('/useraccount/reactivate', [Suspension::class, 'reactivateAccount'])->name('membership.reactivate');
Route::get('/games', function () {
    return view('games');
});
Route::get('/catalog', [Index::class, 'catalog']);
Route::get('/Login/FulfillConstraint.aspx', function () {
    return view('maintenance');
});
Route::get('/my/messages', [MyMessages::class, 'mymessages']);
Route::get('/{slug}-item', [Item::class, 'item'])->where('slug', '.*');
Route::get('/messages/compose', [Compose::class, 'composeMessage']);
Route::get('/games/{id}/{slug}', [ShowGame::class, 'showGame'])->name('games.view');
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
Route::get('/Login/iFrameLogin.aspx', function () {
    return view('iframelogin');
});
Route::get('/disclaimer', function () {
    return view('disclaimer');
});
Route::get('/disclaimer/agree', function () {
    $redirect = request()->query('redirect', '/');

    return redirect($redirect)->withCookie(cookie('AgreedToDisclaimer', 'true', 60 * 24 * 365));
})->name('disclaimer.agree');
Route::get('/My/Character.aspx', [CharacterCustomizer::class, 'characterCustomizer']);
Route::get('/info/terms-of-service', function () {
    return view('legal.tos');
});
Route::get('/info/Privacy.aspx', function () {
    return view('legal.privacy');
});
Route::get('/contributors', function () {
    return view('contributors');
});
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
//Route::get('/develop', [Develop::class, 'develop'])->name('develop');
Route::get('/develop', [Develop::class, 'develop'])->name('develop');
Route::get('/places/create', [CreatePlace::class, 'createPlace']);
Route::get('/videos', function () {
    return view('videos');
});
Route::get('/videos/moreresultscached', [VideoCards::class, 'videoCards']);
Route::get('/videos/{id}/view', [ViewVideo::class, 'viewVideo']);
Route::get('/catalog/browse.aspx', [Browse::class, 'browseCatalog']);
Route::get('/search/users', [Search::class, 'searchUsers']);
Route::get('/My/Money.aspx', [MyMoney::class, 'mymoney']);
Route::get('/promocodes', [Promocodes::class, 'promocodes']);
Route::get('/my/Item.aspx', [ConfigureItem::class, 'configureItem']);
Route::get('/userads/{type}', [UserAds::class, 'show'])->where('type', '[123]');
Route::get('/userads/redirect', [UserAds::class, 'redirect']);
Route::get('/users/{id}', [UserInfo::class, 'show']);
Route::get('/v1/videos/{id}', [VideoV1::class, 'fetch']);
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
Route::middleware('auth')->group(function () {
    Route::get('/Upgrades/BCEligibility.aspx', [Eligibility::class, 'showBcPage'])->middleware('auth');
    Route::get('/My/NewUserAd.aspx', [AdUploader::class, 'show']);
});
Route::match(['get', 'post'], '/Groups/Group.aspx', [Groups::class, 'show']);
Route::match(['get', 'post'], '/My/Groups.aspx', [Groups::class, 'showMine']);