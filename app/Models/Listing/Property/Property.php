<?php

namespace App\Models\Listing\Property;

use App\Models\Auth\User;
use App\Models\Country\Country;
use App\Models\Currency\Currency;
use App\Models\Listing\Category\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    /**
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    /**
     * @return BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function inquiries()
    {
        return $this->hasMany(PropertyInquiry::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    /**
     * @param $query
     * @param array $filters
     * @return void
     */
    public function scopeFilterBy($query, array $filters)
    {
        return $query->when($filters['q'] ?? null, function ($query, $search) use ($filters) {
            $query->where('title', 'like', '%'.$search.'%')
                ->orWhere('slug', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%')
                ->orWhere('date_online', 'like', '%'.$search.'%')
                ->orWhere('date_offline', 'like', '%'.$search.'%')
                ->orWhere('country_id', 'like', '%'.$search.'%')
                ->orWhere('currency_id', 'like', '%'.$search.'%')
                ->orWhere('category_id', 'like', '%'.$search.'%')
                ->orWhere('price', 'like', '%'.$search.'%')
                ->orWhere('bedrooms', 'like', '%'.$search.'%')
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
                });
        })
            ->orderBy($filters['sort_by']??'created_at', $filters['order'] ?? 'asc')
            ->with([
                'country:id,name',
                'currency:id,name,symbol',
                'category:id,name',
                'category.sub_categories:id,category_id,name',
                'contact:id,name,email,phone_number',
                'inquiries:id,property_id,name,email,phone,message',
                'images:id,property_id,image_path',
            ])
            ->paginate($filters['per_page'] ?? 10);
    }

    /**
     * @param $query
     * @param string $slug
     * @return mixed
     */
    public function scopeGetBySlug($query, string $slug)
    {
        return $query->where('slug',$slug)
            ->with([
                'country:id,name',
                'currency:id,name,symbol',
                'category:id,name',
                'category.sub_categories:id,category_id,name',
                'contact:id,name,email,phone_number',
                'inquiries:id,property_id,name,email,phone,message',
                'images:id,property_id,image_path',
            ])
            ->firstOrFail();
    }
}
