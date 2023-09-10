<?php

namespace App\Models\Country;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'phone_code',
        'currency_id',
        'status',
    ];
    public function scopeFilterBy($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%'.$search.'%');
        });
        $query->when($filters['status'] ?? null, function ($query, $status) {
            $query->where('status', $status);
        });
        $query->when($filters['currency_id'] ?? null, function ($query, $currency_id) {
            $query->where('currency_id', $currency_id);
        });
        $query->when($filters['code'] ?? null, function ($query, $code) {
            $query->where('code', $code);
        });
        $query->when($filters['phone_code'] ?? null, function ($query, $phone_code) {
            $query->where('phone_code', $phone_code);
        });
        return $query
            ->orderBy('created_at', 'desc')
            ->paginate($filters['per_page'] ?? 20);
    }
}
