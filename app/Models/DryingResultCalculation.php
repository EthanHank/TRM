<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryingResultCalculation extends Model
{
    use HasFactory;
    protected $table = 'drying_result_calculations';

    protected $fillable = [
        'paddy_id',
        'initial_moisture_content',
        'final_moisture_content',
        'initial_bag_quantity',
        'final_bag_quantity',
        'approximate_loss',
        'initial_total_bag_weight',
        'final_total_bag_weight',
    ];

    public function paddy()
    {
        return $this->belongsTo(Paddy::class);
    }
}
