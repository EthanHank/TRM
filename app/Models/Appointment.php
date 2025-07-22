<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_type_id',
        'paddy_id',
        'appointment_start_date',
        'appointment_end_date',
        'bag_quantity',
        'status',
    ];
}
