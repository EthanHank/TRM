<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DryingResultCalculation;
use App\Models\Paddy;
use Illuminate\Http\Request;

class DryingResultCalculationController extends Controller
{
    public function edit(Paddy $paddy)
    {
        
        return view('users.drying_result_calculations.edit', compact('paddy'));
    }


}
