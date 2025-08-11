<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
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
}
