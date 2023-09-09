<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Base\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class AuthRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @return array<string, ValidationRule|array|string>
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
                'email'     => 'required|email',
                'password'  => 'required|string|min:6',
            ],
        ];
        return $rules[$method];
    }
    /**
     * @description get messages
     */
    public function messages(): array
    {
        return [
            'email.required' => __('validation.required', ['attribute' => 'email']),
            'email.email' => __('validation.email', ['attribute' => 'email']),
            'email.unique' => __('validation.unique', ['attribute' => 'email']),
            'password.required' => __('validation.required', ['attribute' => 'password']),
            'password.min' => __('validation.min.string', ['attribute' => 'password', 'min' => 6]),
            'name.required' => __('validation.required', ['attribute' => 'name']),
            'name.string' => __('validation.string', ['attribute' => 'name']),
            'phone_number.required' => __('validation.required', ['attribute' => 'phone_number']),
            'phone_number.string' => __('validation.string', ['attribute' => 'phone_number']),
            'role.required' => __('validation.required', ['attribute' => 'role']),
            'role.string' => __('validation.string', ['attribute' => 'role']),
            'role.exists' => __('validation.exists', ['attribute' => 'role']),
        ];
    }
}
