<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Common\CommonController;
use App\Http\Requests\Auth\AuthRequest;
use App\Models\Auth\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends CommonController
{
    /**
     * @description register account
     * @param AuthRequest $request
     * @return mixed
     */
    public function register(AuthRequest $request)
    {
        return $this->commonOperation(function() use ($request){
            $this->authorize('create',User::class);
            //get role
            $role=Role::where('name',$request->input('role'))->first();
            //validate request
            $validated=$request->validated();
            return User::create($validated)->assignRole($role->name);
        },__('auth.register_success'),[],Response::HTTP_CREATED);
    }
    /**
     * @description login
     * @param AuthRequest $request
     * @return mixed
     */
    public function login(AuthRequest $request)
    {
        return $this->commonOperation(function() use ($request){
            $credentials = $request->validated();
            if (!Auth::attempt($credentials)) {
                throw new Exception(__('auth.failed'),Response::HTTP_BAD_REQUEST);
            }
            $user = User::where('id',Auth::id())
                ->with(['roles','permissions']);
            //generate passport token
            $token = $user->createToken('RingierTokenApp')->accessToken;
            return[
                'account'=>$user,
                'token'=>$token
            ];
        },__('auth.login_success'),[], Response::HTTP_OK);
    }
    /**
     * @Logout
     */
    public function logout()
    {
        return $this->commonOperation(function(){
            Auth::user()->token()->revoke();
            return true;
        },__('auth.logout_success'),[],Response::HTTP_OK);
    }
}
