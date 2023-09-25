<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('articles')->group(function () {
    Route::get('/', [\App\Http\Controllers\Api\ArticleController::class, 'index']);
    Route::get('/{article:slug}/comments', [\App\Http\Controllers\Api\ArticleController::class, 'get_comments']);
});
