<?php

namespace App\Models\Listing\Property;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    /**
     * @desc image path URL accessor
     */
    public function getImagePathAttribute($value)
    {
        return asset('storage/'.$value);
    }
    /**
     * @return BelongsTo
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * @param $query
     * @param $filters
     * @return mixed
     */
    public function scopeFilterBy($query,$filters)
    {
        return $query->where(function($query) use ($filters){
            if(isset($filters['property_id'])){
                $query->where('property_id',$filters['property_id']);
            }
            if(isset($filters['is_featured'])){
                $query->where('is_featured',$filters['is_featured']);
            }
        })
            ->orderBy($filters['sort_by']?? 'created_at',$filters['sort_order']?? 'desc')
            ->paginate(isset($filters['per_page']) ? $filters['per_page'] : 10);
    }
}
