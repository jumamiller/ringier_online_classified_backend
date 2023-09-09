<?php

use App\Http\Controllers\API\Listing\Settings\Category\CategoryController;
use App\Http\Controllers\API\Listing\Settings\SubCategory\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['auth:api'],function(){
    //categories
    Route::apiResource('categories', CategoryController::class)->names([
        'index'     => 'listing.category.index',
        'store'     => 'listing.category.store',
        'show'      => 'listing.category.show',
        'update'    => 'listing.category.update',
        'destroy'   => 'listing.category.destroy',
    ]);
    //sub categories
    Route::apiResource('sub-categories', SubCategoryController::class)->names([
        'index'     => 'listing.sub.category.index',
        'store'     => 'listing.sub.category.store',
        'show'      => 'listing.sub.category.show',
        'update'    => 'listing.sub.category.update',
        'destroy'   => 'listing.sub.category.destroy',
    ]);
});
