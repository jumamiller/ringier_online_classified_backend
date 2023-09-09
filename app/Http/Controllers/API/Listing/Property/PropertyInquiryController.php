<?php

namespace App\Http\Controllers\API\Listing\Property;

use App\Http\Controllers\Common\CommonController;
use App\Http\Requests\Listing\Property\PropertyRequest;
use App\Models\Listing\Property\PropertyInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyInquiryController extends CommonController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->commonOperation(function(){
            return PropertyInquiry::filterBy(request()->all());
        },__('messages.listing.property.inquiry.index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyRequest $request)
    {
        return $this->commonOperation(function() use ($request){
            $validated = $request->validated();
            $validated['created_by'] = Auth::id();
            return PropertyInquiry::create($validated);
        },__('messages.listing.property.inquiry.store'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->commonOperation(function() use ($id){
            return PropertyInquiry::findOrFail($id);
        },__('messages.listing.property.inquiry.show'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->commonOperation(function() use ($request,$id){
            $property = PropertyInquiry::findOrFail($id);
            $property->update(array_filter($request->all()));
            return $property;
        },__('messages.listing.property.inquiry.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->commonOperation(function() use ($id){
            $property = PropertyInquiry::findOrFail($id);
            $property->delete();
            return $property;
        },__('messages.listing.property.inquiry.delete'));
    }
}
