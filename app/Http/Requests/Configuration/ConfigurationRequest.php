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
        return self::getRules($this->route()->getActionMethod());
    }

    /**
     * @param string $method
     * @return string[]
     */
    private static function getRules(string $method): array
    {
        $rules = [
            'currency' => [
                'name'          => 'required|string',
                'code'          => 'required|string',
                'symbol'        => 'required|string',
                'status'        => 'required|integer|in:0,1',
            ],
            'country' => [
                'name'          => 'required|string',
                'code'          => 'required|string',
                'phone_code'    => 'required|string',
                'currency_id'   => 'required|integer|exists:currencies,id',
                'status'        => 'required|integer|in:ACTIVE,INACTIVE',
            ],
        ];
        return $rules[$method];
    }
}
