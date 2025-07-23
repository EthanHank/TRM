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
        'duration',
        'status',
    ];

    public function appointment_type()
    {
        return $this->belongsTo(AppointmentType::class);
    }

    public function paddy()
    {
        return $this->belongsTo(Paddy::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('status', 'like', "%{$search}%")
                ->orWhereHas('appointment_type', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('paddy.paddy_type', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
        });
    }
}
