<?php

namespace App\Http\Requests\Listing\Property;

use App\Http\Requests\Base\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class PropertyRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return $this->getRules();
    }
    private function getRules(): array
    {
        $rules=[
            'api.listing.property.store'    =>[
                'title' => 'required|string',
                'description' => 'required|string',
                'country_id' => 'required|integer',
                'currency_id' => 'required|integer',
                'category_id' => 'required|integer',
                'price' => 'required|numeric',
                'bedrooms' => 'required|integer',
                'bathrooms' => 'required|integer',
                'pool' => 'required|boolean',
                'overview' => 'required|string',
                'why_buy' => 'string',
                'type'    => 'required|string|in:SALE,RENT',
            ],
            'api.listing.property.image.store'  =>[
                'property_id'   => 'required|string',
                'image'         => 'required|string',
            ],
            'api.listing.property.inquiry.store'=>[
                'property_id'   => 'required|string',
                'name'          => 'required|string',
                'email'         => 'required|email',
                'phone'         => 'required|string',
                'message'       => 'required|string',
            ]
        ];
        return $rules[$this->route()->getName()];
    }
    public function messages(): array
    {
        return [
            'title.required'    =>__('validation.required', ['attribute' => 'title']),
            'title.string'      =>__('validation.string', ['attribute' => 'title']),
            'name.required'     =>__('validation.required', ['attribute' => 'name']),
            'name.string'       =>__('validation.string', ['attribute' => 'name']),
            'description.required'  =>__('validation.required', ['attribute' => 'description']),
            'description.string'    =>__('validation.string', ['attribute' => 'description']),
            'country_id.required'   =>__('validation.required', ['attribute' => 'country']),
            'country_id.integer'    =>__('validation.integer', ['attribute' => 'country']),
            'currency_id.required'  =>__('validation.required', ['attribute' => 'currency']),
            'currency_id.integer'   =>__('validation.integer', ['attribute' => 'currency']),
            'category_id.required'  =>__('validation.required', ['attribute' => 'category']),
            'category_id.integer'   =>__('validation.integer', ['attribute' => 'category']),
            'price.required'        =>__('validation.required', ['attribute' => 'price']),
            'price.numeric'         =>__('validation.numeric', ['attribute' => 'price']),
            'sale.required'         =>__('validation.required', ['attribute' => 'sale']),
            'sale.numeric'          =>__('validation.numeric', ['attribute' => 'sale']),
            'bedrooms.required'     =>__('validation.required', ['attribute' => 'bedrooms']),
            'bedrooms.integer'      =>__('validation.integer', ['attribute' => 'bedrooms']),
            'drawing_rooms.required'=>__('validation.required', ['attribute' => 'drawing rooms']),
            'drawing_rooms.integer' =>__('validation.integer', ['attribute' => 'drawing rooms']),
            'bathrooms.required'    =>__('validation.required', ['attribute' => 'bathrooms']),
            'bathrooms.integer'     =>__('validation.integer', ['attribute' => 'bathrooms']),
            'pool.required'         =>__('validation.required', ['attribute' => 'pool']),
            'pool.boolean'          =>__('validation.boolean', ['attribute' => 'pool']),
            'overview.required'     =>__('validation.required', ['attribute' => 'overview']),
            'overview.string'       =>__('validation.string', ['attribute' => 'overview']),
            'why_buy.string'        =>__('validation.string', ['attribute' => 'why buy']),
            'type.required'         =>__('validation.required', ['attribute' => 'type']),
            'type.string'           =>__('validation.string', ['attribute' => 'type']),
            'type.in'               =>__('validation.in', ['attribute' => 'type']),
        ];
    }
}
