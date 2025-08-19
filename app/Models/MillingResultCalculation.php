<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MillingResultCalculation extends Model
{
    use HasFactory;
    protected $table = 'milling_result_calculations';

    protected $fillable = [
        'paddy_id',
        'initial_moisture_content',
        'final_moisture_content',
        'initial_bag_quantity',
        'adjusted_weight',
        'white_rice_bags',
        'broken_rice_bags',
        'bran_bags',
        'husk_bags',
    ];

    public function paddy()
    {
        return $this->belongsTo(Paddy::class);
    }
}
