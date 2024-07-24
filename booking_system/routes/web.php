<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Middleware\AdminMiddleware;
use App\Http\Controllers\BookingController;
use App\Kernel;
Route::get('/', function () {
    return view('welcome');
});
Route::middleware('admin')->group(function(){
    Route::apiResource('user',UserController::class)->names('user');
    Route::get('businesses',[BusinessController::class,'index'])->name('businesses');
    Route::post('business-store',[BusinessController::class,'store'])->name('new_business');
    Route::get('business-create',[BusinessController::class,'create'])->name('business.create');
    Route::get('business-delete/{id}',[BusinessController::class,'destroy'])->name('business.delete');
    Route::get('user',[UserController::class,'index'])->name('users');
    Route::post('user-store',[UserController::class,'store'])->name('new_user');
    Route::get('user-create',[UserController::class,'create'])->name('user.create');
    Route::get('user-delete/{id}',[UserController::class,'destroy'])->name('user.delete');


});


Route::post('admin_login',[AdminLoginController::class,'login'])->name('admin_login');
Route::get('showloginform',[AdminLoginController::class,'showloginform'])->name('login_form');
Route::get('logout',[AdminLoginController::class,'logout'])->name('logout');
Route::get('login',[AdminLoginController::class,'login'])->name('login');
