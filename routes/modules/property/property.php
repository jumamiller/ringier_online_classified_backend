<?php

use App\Http\Controllers\API\Listing\Property\PropertyController;
use App\Http\Controllers\API\Listing\Property\PropertyImagesController;
use App\Http\Controllers\API\Listing\Property\PropertyInquiryController;
use Illuminate\Support\Facades\Route;

Route::group([],function(){
    //property listing
    Route::apiResource('listings',PropertyController::class)->names([
        'index'     =>  'api.listing.property.index',
        'store'     =>  'api.listing.property.store',
        'show'      =>  'api.listing.property.show',
        'update'    =>  'api.listing.property.update',
        'destroy'   =>  'api.listing.property.destroy',
    ]);
    //property image listing
    Route::apiResource('files',PropertyImagesController::class)->names([
        'index'     =>  'api.listing.property.image.index',
        'store'     =>  'api.listing.property.image.store',
        'show'      =>  'api.listing.property.image.show',
        'update'    =>  'api.listing.property.image.update',
        'destroy'   =>  'api.listing.property.image.destroy',
    ]);
    //property inquiry listing
    Route::apiResource('inquiries',PropertyInquiryController::class)->names([
        'index'     =>  'api.listing.property.inquiry.index',
        'store'     =>  'api.listing.property.inquiry.store',
        'show'      =>  'api.listing.property.inquiry.show',
        'update'    =>  'api.listing.property.inquiry.update',
        'destroy'   =>  'api.listing.property.inquiry.destroy',
    ]);

});
