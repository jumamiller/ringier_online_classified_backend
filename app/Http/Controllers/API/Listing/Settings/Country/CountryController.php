<?php

namespace App\Http\Controllers\API\Listing\Settings\Country;

use App\Http\Controllers\Common\CommonController;
use App\Models\Country\Country;

class CountryController extends  CommonController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->commonOperation(function() {
            return Country::filterBy(request()->all());
        },__('messages.listing.country.list'));
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->commonOperation(function() use ($id) {
            return Country::findOrFail($id);
        },__('messages.listing.country.show'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->commonOperation(function() use ($id) {
            $category = Country::findOrFail($id);
            $category->delete();
            return $category;
        },__('messages.listing.country.delete'));
    }
}
