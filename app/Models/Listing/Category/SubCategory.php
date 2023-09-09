<?php

namespace App\Models\Listing\Category;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'description',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * @return Attribute
     */
    public function slug(): Attribute
    {
        //set slug from name
        return Attribute::make(
            set: fn (string $value) => str_replace(' ', '-', strtolower($value))
        );
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @param $query
     * @param array $filters
     * @return void
     */
    public function scopeFilterBy($query, array $filters)
    {
        return $query->when($filters['q'] ?? null, fn ($query, $search) =>
            $query->where(fn ($query) =>
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('meta_title', 'like', '%' . $search . '%')
                ->orWhere('meta_description', 'like', '%' . $search . '%')
                ->orWhere('meta_keywords', 'like', '%' . $search . '%')
            )
            )->when($filters['category_id'] ?? null, fn ($query, $category_id) =>
                //search category table
                $query->whereHas('category', fn ($query) =>
                $query->where('name', 'like', '%' . $category_id . '%'))
            )->when($filters['start_date'] ?? null, fn ($query, $start_date) =>
                $query->where('created_at', '>=', Carbon::parse($start_date)->startOfDay())
            )->when($filters['end_date'] ?? null, fn ($query, $end_date) =>
                $query->where('created_at', '<=', Carbon::parse($end_date)->endOfDay())
            )->when($filters['sort_by'] ?? null, fn ($query, $sort_by) =>
                    $query->orderBy($sort_by, $filters['order'] ?? 'asc'))
            ->paginate($filters['per_page'] ?? 10);
    }

}
