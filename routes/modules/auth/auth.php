<?php

use App\Http\Controllers\API\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::group([],function(){
    //login
    Route::post('login',[AuthController::class,'login'])->name('login');
    //register
    Route::post('register',[AuthController::class,'register'])->name('register');
});
