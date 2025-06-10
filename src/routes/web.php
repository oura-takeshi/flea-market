<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

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

Route::post('/register', [UserController::class, 'userStore']);
Route::post('/login', [UserController::class, 'userLogin']);
Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{item_id}', [ItemController::class, 'detail']);
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::get('/mypage/profile', [ProfileController::class, 'profileEdit']);
    Route::post('/mypage/profile', [ProfileController::class, 'profileUpdate']);
    Route::get('/mypage', [ProfileController::class, 'profile']);
    Route::post('/item/{item_id}/like', [ItemController::class, 'likeCreate']);
    Route::post('/item/{item_id}/not-like', [ItemController::class, 'likeDelete']);
    Route::post('/item/comment', [ItemController::class, 'commentPost']);
    Route::post('/purchase/{item_id}', [ItemController::class, 'purchaseConfirm']);
    Route::get('/purchase/address/{item_id}', [profileController::class, 'address']);
});
