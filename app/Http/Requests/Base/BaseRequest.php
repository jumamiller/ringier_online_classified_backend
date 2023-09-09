<?php

namespace App\Http\Requests\Base;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ApiResponder;
use Illuminate\Contracts\Validation\Validator;
class BaseRequest extends FormRequest
{
    use ApiResponder;
    /**
     * @description  Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException($this->error($validator->errors()->first(), Response::HTTP_BAD_REQUEST, null, $validator->errors()));
    }
}
