<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::group([],function(){
    //v1 routes
    Route::group(['prefix'=>'v1'],function(){
        //auth routes
        Route::prefix('auth')->group(base_path('routes/modules/auth/auth.php'));
    });
});
