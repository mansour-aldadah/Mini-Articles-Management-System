<?php

use App\Http\Controllers\Web\Admin\ArticleController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CommentController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

    Route::prefix('auth')->as('auth.')->group(function () {
        Route::view('login', 'pages.auth.login')->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login_submit');
        Route::view('register', 'pages.auth.register')->name('register');
        Route::post('register', [AuthController::class, 'register'])->name('register.create');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
    });

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('home/article/{article:slug}', [HomeController::class, 'show'])->name('home-article-show');

    Route::middleware('auth')->group(function () {
        Route::resource('articles', \App\Http\Controllers\Web\ArticleController::class);
        Route::prefix('articles')->as('articles.')->group(function () {
            Route::post('{article:slug}/comments/create', [CommentController::class, 'store'])->name('comments.create');
            Route::put('{article:slug}/comments/{comment}/update', [CommentController::class, 'update'])->name('comments.update');
            Route::delete('{article:slug}/comments/{comment}/delete', [CommentController::class, 'destroy'])->name('comments.destroy');
        });
    });


    Route::middleware('admin')->prefix('admin')->as('admin.')->group(function () {
        Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('articles/{article:slug}/show', [ArticleController::class, 'show'])->name('articles.show');
        Route::put('articles/{article:slug}/{status}', [ArticleController::class, 'update'])->name('articles.change_status')
            ->where('status', 'approve|reject|draft');
    });
});
