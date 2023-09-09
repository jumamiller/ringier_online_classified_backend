<?php

namespace App\Http\Controllers\API\Listing\Settings\Category;

use App\Http\Controllers\Common\CommonController;
use App\Http\Requests\Listing\Category\CategoryRequest;
use App\Models\Listing\Category\Category;

class CategoryController extends CommonController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->commonOperation(function() {
            return Category::filterBy(request()->all());
        },__('messages.listing.category.list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        return $this->commonOperation(function() use ($request) {
            $validated = $request->validated();
            $validated['slug'] = str_replace(' ', '-', strtolower($validated['name']));
            return Category::create($validated);
        },__('messages.listing.category.create'));
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->commonOperation(function() use ($id) {
            return Category::findOrFail($id);
        },__('messages.listing.category.show'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        return $this->commonOperation(function() use ($request,$id) {
            $category = Category::findOrFail($id);
            $category->update($request->validated());
            return $category;
        },__('messages.listing.category.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->commonOperation(function() use ($id) {
            $category = Category::findOrFail($id);
            $category->delete();
            return $category;
        },__('messages.listing.category.delete'));
    }
}
