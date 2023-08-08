<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/balance', [ProfileController::class, 'userBalance'])->name('account.balance');
    Route::get('/gift', [\App\Http\Controllers\GiftController::class, 'view'])->name('gift');
    Route::post('/mo-qua', [\App\Http\Controllers\GiftController::class, 'open_gift'])->name('gift.open');

    Route::get('/lucky-number', [\App\Http\Controllers\LuckyNumberController::class, 'view'])->name('lucky');
    Route::post('/lucky-number/send', [\App\Http\Controllers\LuckyNumberController::class, 'doBet'])->name('lucky.bet');

    Route::get('/account', [ProfileController::class, 'edit'])->name('account');
    Route::get('/exchange-point', [ProfileController::class, 'withdrawView'])->name('account.withdraw');
    Route::post('/exchange-point', [ProfileController::class, 'withdrawRequest'])->name('account.withdraw.post');

    Route::get('/news', [\App\Http\Controllers\NewsController::class, 'homeView'])->name('news');
    Route::get('/news/{id}', [\App\Http\Controllers\NewsController::class, 'viewPost'])->name('news.view');
    Route::post('/news/react/{id}', [\App\Http\Controllers\NewsController::class, 'react'])->name('news.react');
    Route::post('/react/buy', [\App\Http\Controllers\NewsController::class, 'buyReact'])->name('news.buyReact');

    Route::get('/account-verify', [ProfileController::class, 'verifyAccountView'])->name('account.verify');
    Route::post('/account-verify', [ProfileController::class, 'verifyAccount'])->name('account.verify.post');

    Route::get('/banking', [ProfileController::class, 'bankingView'])->name('account.banking');
    Route::post('/banking', [ProfileController::class, 'bankUpdate'])->name('account.banking.post');

    Route::get('/profile', [ProfileController::class, 'editProfileView'])->name('account.profile');
    Route::post('/profile', [ProfileController::class, 'editProfile'])->name('account.profile.post');


    Route::get('/history-play/{tables}', [ProfileController::class, 'historyPlay'])->name('account.history_play');
    Route::post('/getGame', [ProfileController::class, 'getGameInfo'])->name('account.getGame');

});

Route::controller(\App\Http\Controllers\AdminController::class)->group(function () {
    Route::get('/admincp', 'loginView')->name('admin.login');
    Route::post('/admincp/let_met_in', 'login')->name('admin.login.submit');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');

        Route::get('/admin/settings', 'settingsView')->name('admin.settings');
        Route::post('/admin/settings', 'saveSettings')->name('admin.settings.post');
        Route::get('/admin/lucky_game', 'luckyGameView')->name('admin.lucky_game');
        Route::post('/admin/lucky_game', 'luckyUpdate')->name('admin.lucky_game.post');

        Route::get('/admin/bai_viet', 'postview')->name('admin.bai_viet');
        Route::post('/admin/bai_viet', 'createPost')->name('admin.bai_viet.post');

        Route::post('/admin/user_withdraw', 'findWithdraw')->name('admin.findWithdraw');
        Route::post('/admin/editBal', 'updateBalance')->name('admin.updateBalance');
        Route::post('/admin/user_update', 'updateUser')->name('admin.updateUser');
        Route::post('/admin/chage_pass', 'changePassword')->name('admin.changePass');
        Route::get('/admin/user_ban/{id}', 'lockUser')->name('admin.lockUser');
        Route::get('/admin/users_list', 'usersView')->name('admin.users.list');
        Route::get('/admin/find_user', 'liveSearch')->name('admin.users.ajax');
        Route::get('/admin/users_view/{id}', 'findUser')->name('admin.users.find');

        Route::get('/admin/banks', 'bankView')->name('admin.bank');
        Route::post('/admin/banks', 'bankRequest')->name('admin.bank.post');

        Route::get('/admin/recharge', 'rechargeView')->name('admin.recharge');
        Route::get('/admin/find_recharge', 'liveSearchRecharge')->name('admin.recharge.ajax');
        Route::get('/admin/recharge/normal', 'rechargeNormalView')->name('admin.recharge.normal');
        Route::get('/admin/recharge/ad', 'rechargeAdView')->name('admin.recharge.ad');
        Route::post('/admin/recharge', 'rechargeRequest')->name('admin.recharge.post');
        Route::post('/admin/rechargeRevoke', 'rechargeRevoke')->name('admin.recharge.revoke');

        Route::get('/admin/withdraw', 'withdrawView')->name('admin.withdraw');
        Route::get('/admin/find_withdraw', 'liveSearchWithdraw')->name('admin.withdraw.ajax');

        Route::post('/admin/withdraw', 'updateWithdraw')->name('admin.withdraw.post');

        Route::post('/admin/find_by_id', 'findById')->name('admin.findById');

        Route::get('/admin/game_manager', 'gameManagerView')->name('admin.game_manager');

        Route::get('/admin/seo', 'seoView')->name('admin.seo');
        Route::post('/admin/seo', 'seoRequest')->name('admin.seo.post');

        Route::get('admin/logout', 'logout')->name('admin.logout');
    });
});

require __DIR__.'/auth.php';
