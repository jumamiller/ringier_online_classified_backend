<?php

namespace App\Models\Listing\Category;

use Carbon\Carbon;
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
            ->orWhere('meta_keywords', 'like', '%' . $search . '%'))
        )->when($filters['start_date'] ?? null, fn ($query, $start_date) =>
        $query->where('created_at', '>=', Carbon::parse($start_date)->startOfDay())
        )->when($filters['end_date'] ?? null, fn ($query, $end_date) =>
        $query->where('created_at', '<=', Carbon::parse($end_date)->endOfDay())
        )->when($filters['sort_by'] ?? null, fn ($query, $sort_by) =>
        $query->orderBy($sort_by, $filters['order'] ?? 'asc'))
            ->paginate($filters['per_page'] ?? 10);
    }
}
