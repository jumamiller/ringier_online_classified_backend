<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Base\BaseRequest;

class AuthRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return self::getRules($this->route()->getActionMethod());
    }

    /**
     * @description get rules
     * @param string $method
     * @return string[]
     */
    private static function getRules(string $method): array
    {
        $rules = [
            'register' => [
                'name'          => 'required|string',
                'phone_number'  => 'required|string',
                'email'         => 'required|email|unique:users,email',
                'password'      => 'required|string|min:6',
                'role'          => 'required|string|exists:roles,name'
            ],
            'login' => [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ],
        ];
        return $rules[$method];
    }
}
