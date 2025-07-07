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
}
