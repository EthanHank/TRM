<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Milling extends Model
{
    use SoftDeletes;

    protected $table = 'millings';

    protected $fillable = [
        'appointment_id',
        'milling_start_date',
        'milling_end_date',
        'bag_quantity',
        'status',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
