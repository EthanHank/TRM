<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaddyType extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description'];

    protected $table = 'paddy_types';

    public function paddies()
    {
        return $this->hasMany(Paddy::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%");
    }
}
