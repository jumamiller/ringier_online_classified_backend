<?php

namespace App\Http\Controllers\API\Profile;

use App\Http\Controllers\Common\CommonController;
use App\Models\Auth\User;
use Illuminate\Http\Request;

class ProfileController extends CommonController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->commonOperation(function(){
            return User::paginate(request()->get('per_page', 10));
        },__('messages.users.list'));
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->commonOperation(function() use ($id){
            return User::findOrFail($id);
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->commonOperation(function() use ($request,$id) {
            return User::findOrFail($id)->update(array_filter($request->all()));
        });
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->commonOperation(function() use ($id) {
            return User::findOrFail($id)->delete();
        });
    }
}
