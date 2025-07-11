<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paddy extends Model
{
    protected $table = 'paddies';

    protected $fillable = [
        'user_id',
        'paddy_type_id',
        'bag_quantity',
        'moisture_content',
        'storage_start_date',
        'storage_end_date',
        'maximum_storage_duration',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paddy_type()
    {
        return $this->belongsTo(PaddyType::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })->orWhereHas('paddy_type', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orWhere('moisture_content', 'like', "%{$search}%")
            ->orWhere('maximum_storage_duration', 'like', "%{$search}%");
        });
    }
}
