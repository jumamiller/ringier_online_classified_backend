<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Common\CommonController;
use App\Http\Requests\Auth\AuthRequest;
use App\Models\Auth\User;
use App\Models\Country\Country;
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
    public function register(AuthRequest $request): mixed
    {
        return $this->commonOperation(function() use ($request){
            $this->authorize('create',User::class);
            //get role
            $role=Role::where('name',$request->input('role'))->first();
            //validate request
            $validated=$request->validated();
            //country code
            $country=Country::findOrFail($validated['country_id']);
            //get msisdn
            $validated['phone_number']=$this->getMsisdn($validated['phone_number'],$country->code);
            //create user
            return User::create($validated)->assignRole($role->name);
        },__('auth.register_success'),[],Response::HTTP_CREATED);
    }
    /**
     * @description login
     * @param AuthRequest $request
     * @return mixed
     */
    public function login(AuthRequest $request): mixed
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
