<?php

namespace App\Models\Listing\Property;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyInquiry extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'property_id',
        'name',
        'email',
        'phone',
        'message',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function scopeFilterBy($query, array $input)
    {
        $fields = ['property_id','name','email','phone','message','created_by','updated_by','deleted_by'];
        foreach ($fields as $field) {
            if (isset($input[$field])) {
                $query->where($field, 'LIKE', '%' . $input[$field] . '%')
                    ->orWhere($field, 'LIKE', '%' . $input[$field] . '%');
            }
        }
        return $query->orderBy($input['sort_by'] ?? 'created_at', $input['order'] ?? 'desc')
            ->paginate($input['per_page'] ?? 10);
    }
}
