<?php

namespace App\Http\Requests\Configuration;

use App\Http\Requests\Base\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class ConfigurationRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
       //get by route name
        $route = $this->route()->getName();
        return self::getRules($route);
    }
    /**
     * @param string $method
     * @return string[]
     */
    private static function getRules(string $route): array
    {
        $rules = [
            'currency' => [
                'name'          => 'required|string',
                'code'          => 'required|string',
                'symbol'        => 'required|string',
                'status'        => 'required|string|in:ACTIVE,INACTIVE',
            ],
            'country' => [
                'name'          => 'required|string',
                'code'          => 'required|string',
                'phone_code'    => 'required|string',
                'currency_id'   => 'required|integer|exists:currencies,id',
                'status'        => 'required|string|in:ACTIVE,INACTIVE',
            ],
        ];
        return $rules[$route];
    }
    public function messages(): array
    {
        return [
            'name.required' => __('validation.required', ['attribute' => 'name']),
            'name.string' => __('validation.string', ['attribute' => 'name']),
            'code.required' => __('validation.required', ['attribute' => 'code']),
            'code.string' => __('validation.string', ['attribute' => 'code']),
            'symbol.required' => __('validation.required', ['attribute' => 'symbol']),
            'symbol.string' => __('validation.string', ['attribute' => 'symbol']),
            'status.required' => __('validation.required', ['attribute' => 'status']),
            'status.string' => __('validation.integer', ['attribute' => 'status']),
            'status.in' => __('validation.in', ['attribute' => 'status']),
            'phone_code.required' => __('validation.required', ['attribute' => 'phone_code']),
            'phone_code.string' => __('validation.string', ['attribute' => 'phone_code']),
            'currency_id.required' => __('validation.required', ['attribute' => 'currency_id']),
            'currency_id.integer' => __('validation.integer', ['attribute' => 'currency_id']),
            'currency_id.exists' => __('validation.exists', ['attribute' => 'currency_id']),
        ];
    }
}
