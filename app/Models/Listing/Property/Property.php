<?php

namespace App\Models\Listing\Property;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'title',
        'name',
        'slug',
        'description',
        'date_online',
        'date_offline',
        'country_id',
        'contact_id',
        'currency_id',
        'category_id',
        'price',
        'sale',
        'bedrooms',
        'drawing_rooms',
        'bathrooms',
        'pool',
        'overview',
        'why_buy',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
