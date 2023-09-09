<?php

namespace App\Models\Listing\Property;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyImage extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'property_id',
        'image_path',
        'is_featured',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
