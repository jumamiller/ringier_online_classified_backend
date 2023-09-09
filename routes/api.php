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
        //admin
        Route::group(['prefix'=>'admin'],function(){
            //profile routes
            Route::prefix('profile')->group(base_path('routes/modules/profile/profile.php'));
        });
    });
});
