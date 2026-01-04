<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatMessageController;
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
Route::post('/', [ItemController::class, 'search']);
Route::get('/item/{item_id}', [ItemController::class, 'detail']);
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::get('/mypage/profile', [ProfileController::class, 'profileEdit']);
    Route::post('/mypage/profile', [ProfileController::class, 'profileUpdate']);
    Route::get('/mypage', [ProfileController::class, 'profile']);
    Route::get('/item/{item_id}/like', [ItemController::class, 'likeCreate']);
    Route::get('/item/{item_id}/not-like', [ItemController::class, 'likeDelete']);
    Route::post('/item/comment', [ItemController::class, 'commentPost']);
    Route::get('/purchase/{item_id}', [ItemController::class, 'purchaseConfirm']);
    Route::get('/purchase/address/{item_id}', [ProfileController::class, 'addressEdit']);
    Route::post('/purchase/address', [ProfileController::class, 'addressUpdate']);
    Route::post('/purchase', [ItemController::class, 'purchase']);
    Route::get('/sell', [ItemController::class, 'sell']);
    Route::post('/exhibition', [ItemController::class, 'exhibition']);
    Route::get('/chat/{chat_id}', [ChatController::class, 'show']);
    Route::post('/chat/{chat_id}/messages', [ChatMessageController::class, 'store']);
    Route::patch('/chat/{chat_id}/messages/{chat_message_id}', [ChatMessageController::class, 'update']);
});
