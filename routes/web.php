<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', fn () => view('about'));

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/news', AdminNewsController::class);
});

Route::group(['as' => 'news.', 'prefix' => 'news'], function () {
    Route::get('/', [NewsController::class, 'index'])
        ->name('index');

    Route::get('/{categoryId}', [NewsController::class, 'index'])
        ->where('categoryId', '\d+')
        ->name('index');

    Route::get('/{categoryId}/{newsId}', [NewsController::class, 'show'])
        ->where('categoryId', '\d+')
        ->where('newsId', '\d+')
        ->name('show');
});
