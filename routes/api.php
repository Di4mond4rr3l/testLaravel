<?php

use App\Http\Controllers\ApiJWTAuthController;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\TokenAuthenticator;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [LoginController::class, 'authenticate']);

Route::resource('comments', CommentController::class);

Route::get('users', [ApiUserController::class, 'index']);

Route::post('users', [ApiUserController::class, 'store']);

Route::get('users/csvPDF', [CsvController::class, 'csvPDF'])->middleware(TokenAuthenticator::class);

Route::get('users/{id}', [ApiUserController::class, 'show']);

Route::put('users/{id}', [ApiUserController::class, 'update']);

Route::delete('users/{id}', [ApiUserController::class, 'destroy']);

Route::controller(ApiJWTAuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('show', 'show');
});
