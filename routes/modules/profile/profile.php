<?php

use App\Http\Controllers\API\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['api:auth'],function(){
    //profile accounts
    Route::apiResource('accounts',ProfileController::class)->only(['index','show','destroy']);
});
