<?php
use App\Http\Controllers\Admin\AbuseReportManagement;
use App\Http\Controllers\Admin\AccessKeys;
use App\Http\Controllers\Admin\AssetManagement;
use App\Http\Controllers\Admin\AssetRerender;
use App\Http\Controllers\Admin\AssetReview;
use App\Http\Controllers\Admin\CreateAsset;
use App\Http\Controllers\Admin\CreatePlace;
use App\Http\Controllers\Admin\CreateUser;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\FeedMonitor;
use App\Http\Controllers\Admin\GameEx;
use App\Http\Controllers\Admin\GameManagement;
use App\Http\Controllers\Admin\GameServers;
use App\Http\Controllers\Admin\MigrateAsset;
use App\Http\Controllers\Admin\ModLogs;
use App\Http\Controllers\Admin\ServerUsage;
use App\Http\Controllers\Admin\SiteWideAlert;
use App\Http\Controllers\Admin\UserLookup;
use App\Http\Controllers\Admin\UserManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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