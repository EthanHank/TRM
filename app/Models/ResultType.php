<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResultType extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description'];

    protected $table = 'result_types';

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
        });
    }
}
