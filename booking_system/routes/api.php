<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Business\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\AdminLoginController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('service',ServiceController::class);
    Route::apiResource('booking',BookingController::class);
    Route::apiResource('review',ReviewsController::class);
    Route::apiResource('business',BusinessController::class);
    Route::post('user-store',[UserController::class,'store'])->name('new_user');


    Route::put('update_review/{id}',[ReviewsController::class,'update']);



});
Route::get('users',[AuthController::class,'eloquentUser']);