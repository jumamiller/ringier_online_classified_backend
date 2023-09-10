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
        'slug',
        'description',
        'date_online',
        'date_offline',
        'country_id',
        'contact_id',
        'currency_id',
        'category_id',
        'price',
        'type',
        'bedrooms',
        'bathrooms',
        'pool',
        'status',
        'overview',
        'why_buy',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    public function scopeFilterBy($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) use ($filters) {
            $query->where('title', 'like', '%'.$search.'%')
                ->orWhere('slug', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%')
                ->orWhere('date_online', 'like', '%'.$search.'%')
                ->orWhere('date_offline', 'like', '%'.$search.'%')
                ->orWhere('country_id', 'like', '%'.$search.'%')
                ->orWhere('contact_id', 'like', '%'.$search.'%')
                ->orWhere('currency_id', 'like', '%'.$search.'%')
                ->orWhere('category_id', 'like', '%'.$search.'%')
                ->orWhere('price', 'like', '%'.$search.'%')
                ->orWhere('sale', 'like', '%'.$search.'%')
                ->orWhere('bedrooms', 'like', '%'.$search.'%')
                ->orWhere('drawing_rooms', 'like', '%'.$search.'%')
                ->orWhere('bathrooms', 'like', '%'.$search.'%')
                ->orWhere('pool', 'like', '%'.$search.'%')
                ->orWhere('overview', 'like', '%'.$search.'%')
                ->orWhere('why_buy', 'like', '%'.$search.'%')
                ->orWhere('created_by', 'like', '%'.$search.'%')
                ->orWhere('updated_by', 'like', '%'.$search.'%')
                ->orWhere('deleted_by', 'like', '%'.$search.'%')
                //search in relations
                ->orWhereHas('country', function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                })
                ->orWhereHas('currency', function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                })
                ->orWhereHas('category', function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                })
                ->orderBy($filters['sort_by']??'created_at', $filters['order'] ?? 'asc')
                ->paginate($filters['per_page'] ?? 10);
        });
    }
}
