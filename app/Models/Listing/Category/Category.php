<?php

namespace App\Models\Listing\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}
