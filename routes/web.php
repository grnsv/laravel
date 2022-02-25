<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Account\IndexController as AccountController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/account', AccountController::class)->name('account');
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('account.logout');

    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::view('/', 'admin.index')->name('index');
        Route::get('/parser', ParserController::class)->name('parser');
        Route::resource('/categories', AdminCategoryController::class);
        Route::resource('/news', AdminNewsController::class);
        Route::resource('/users', AdminUserController::class);
        Route::group(['as' => 'feedbacks.', 'prefix' => 'feedbacks'], function () {
            Route::get('/', [AdminFeedbackController::class, 'index'])->name('index');
            Route::delete('/{id}', [AdminFeedbackController::class, 'delete']);
        });
    });
});

Route::group(['as' => 'news.', 'prefix' => 'news'], function () {
    Route::get('/{category:slug?}', [NewsController::class, 'index'])->name('index');
    Route::get('/show/{news:slug}', [NewsController::class, 'show'])->name('show');
});

Route::group(['as' => 'feedbacks.', 'prefix' => 'feedbacks'], function () {
    Route::get('/', [FeedbackController::class, 'index'])->name('index');
    Route::post('/', [FeedbackController::class, 'create'])->name('create');
});

Route::post('/order', [OrderController::class, 'success'])->name('order');

Auth::routes();

Route::group(['as' => 'auth.', 'prefix' => 'auth/{network}', 'middleware' => 'guest'], function () {
    Route::get('/redirect', [SocialController::class, 'redirect'])
        ->where('network', '\w+')
        ->name('redirect');
    Route::get('/callback', [SocialController::class, 'callback'])
        ->where('network', '\w+')
        ->name('callback');
});
