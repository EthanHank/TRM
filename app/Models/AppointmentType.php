<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentType extends Model
{
    use SoftDeletes;
    
    protected $table = 'appointment_types';

    protected $fillable = ['name', 'description'];
}
