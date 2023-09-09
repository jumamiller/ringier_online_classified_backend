<?php

namespace App\Http\Requests\Listing\Category;

use App\Http\Requests\Base\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class CategoryRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return self::getRules();
    }

    /**
     * @description get rules by route name
     * @return string[]
     */
    private function getRules(): array
    {
        //category and subcategory
        $rules =[
            'category' => [
                'name' => 'required|string',
                'slug' => 'string',
                'description' => 'required|string',
                'status' => 'in:ACTIVE,INACTIVE',
                'meta_title' => 'string',
                'meta_description' => 'string',
                'meta_keywords' => 'string',
            ],
            'sub_category' => [
                'name' => 'required|string',
                'slug' => 'string',
                'description' => 'required|string',
                'status' => 'in:ACTIVE,INACTIVE',
                'meta_title' => 'string',
                'meta_description' => 'string',
                'meta_keywords' => 'string',
                'category_id' => 'required|integer|exists:categories,id',
            ],
        ];
        return $rules[$this->route()->getName()];
    }
}
