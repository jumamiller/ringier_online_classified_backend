<?php

namespace App\Http\Controllers\API\Listing\Property;

use App\Http\Controllers\Common\CommonController;
use App\Http\Requests\Listing\Property\PropertyRequest;
use App\Models\Listing\Property\Property;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends CommonController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->commonOperation(function(){
            return Property::filterBy(request()->all());
        },__('messages.listing.property.index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyRequest $request)
    {
        return $this->commonOperation(function() use ($request){
            $validated = $request->validated();
            $validated['slug'] = $this->slugify($validated['title']);
            $validated['created_by'] = Auth::id();
            $validated['date_online'] = Carbon::now();
            $validated['updated_by'] = Auth::id();
            //
            return Property::create($validated);
        },__('messages.listing.property.store'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->commonOperation(function() use ($id){
            return Property::findOrFail($id);
        },__('messages.listing.property.show'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->commonOperation(function() use ($request,$id){
            if ($request->has('status') && $request->get('status') === 'INACTIVE')
                $request->merge(['date_offline' => Carbon::now()]);
            else
                $request->merge(['date_offline' => null]);
            //
            $property = Property::findOrFail($id);
            $property->update(array_filter($request->all()));
            return $property;
        },__('messages.listing.property.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->commonOperation(function() use ($id){
            $property = Property::findOrFail($id);
            $property->delete();
            return $property;
        },__('messages.listing.property.delete'));
    }
}
