<?php

namespace App\Models\Currency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'symbol',
        'status',
    ];
    public function scopeFilterBy($query, array $filters)
    {
        $filters = collect($filters);
        if ($filters->has('name') && $filters->get('name') != '') {
            $query->where('name', 'like', '%' . $filters->get('name') . '%');
        }
        if ($filters->has('code') && $filters->get('code') != '') {
            $query->where('code', 'like', '%' . $filters->get('code') . '%');
        }
        if ($filters->has('symbol') && $filters->get('symbol') != '') {
            $query->where('symbol', 'like', '%' . $filters->get('symbol') . '%');
        }
        if ($filters->has('status') && $filters->get('status') != '') {
            $query->where('status', $filters->get('status'));
        }
        return $query->orderBy('created_at', 'desc')
            ->paginate($filters->has('per_page') ? $filters->get('per_page') : 10);
    }
}
