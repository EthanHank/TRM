<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'results';

    protected $fillable = [
        'result_type_id',
        'milling_id',
        'user_id',
        'bag_quantity',
    ];

    public function result_type()
    {
        return $this->belongsTo(ResultType::class);
    }

    public function milling()
    {
        return $this->belongsTo(Milling::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAdminSearch($query, $search){
        return $query->where(function ($q) use ($search) {
            $q->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })->orWhereHas('result_type', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })->orWhereHas('milling.appointment.paddy.paddy_type', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            });
        });
    }

    public function scopeSearch($query, $search){
        return $query->where(function ($q) use ($search) {
            $q->whereHas('milling.appointment.paddy.paddy_type', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })->orWhereHas('result_type', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            });
        });
    }
}
