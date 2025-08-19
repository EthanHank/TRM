<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drying extends Model
{
    use HasFactory;
    protected $table = 'dryings';
    protected $fillable = [
        'appointment_id',
        'drying_start_date',
        'drying_end_date',
        'bag_quantity',
        'status',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
