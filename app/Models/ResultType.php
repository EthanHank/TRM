<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResultType extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'description'];
    
    protected $table = 'result_types';
}
