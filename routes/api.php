<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromocodeController;
use App\Http\Controllers\SubscripeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/************Api users*************/
Route::get('/users',[UserController::class,'index']);
Route::get('/users/{user}',[UserController::class,'show'])->middleware('auth:api');
Route::delete('/users/{user}',[UserController::class,'destroy']);
Route::put('/users/{user}',[UserController::class,'update']);
Route::post('login', [UserController::class,'login']);
Route::post('register', [UserController::class,'register']);
Route::post('/logout',[UserController::class,'logout'])->middleware('auth:api');



/*****************Api promocode */
Route::post('/promocodes', [PromocodeController::class,'store']);
Route::get('/promocodes',[PromocodeController::class,'index']);
Route::get('/promocodes/{promocode}',[PromocodeController::class,'show']);
Route::delete('/promocodes/{promocode}',[PromocodeController::class,'destroy']);
Route::put('/promocodes/{promocode}',[PromocodeController::class,'update']);

/*****************Api subscripe */
Route::post('/subscripes', [SubscripeController::class,'store']);
Route::get('/subscripes',[SubscripeController::class,'index']);
Route::get('/subscripes/{subscripe}',[SubscripeController::class,'show']);
Route::delete('/subscripes/{subscripe}',[SubscripeController::class,'destroy']);
Route::put('/subscripes/{subscripe}',[SubscripeController::class,'update']);

