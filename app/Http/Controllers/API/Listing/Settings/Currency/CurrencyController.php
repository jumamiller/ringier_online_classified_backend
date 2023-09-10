<?php

namespace App\Http\Controllers\API\Listing\Settings\Currency;

use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Controller;
use App\Models\Currency\Currency;
use Illuminate\Http\Request;

class CurrencyController extends CommonController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->commonOperation(function () {
            return Currency::filterBy(request()->all());
        }, __('messages.listing.currency.list'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->commonOperation(function () use ($id) {
            return Currency::findOrFail($id);
        }, __('messages.listing.currency.show'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->commonOperation(function () use ($id) {
            $category = Currency::findOrFail($id);
            $category->delete();
            return $category;
        }, __('messages.listing.currency.delete'));
    }
}
