<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\DryingResultCalculation\DryResultCalculateRequest;
use App\Models\DryingResultCalculation;
use App\Models\Paddy;
use Illuminate\Support\Facades\Log;
use App\Services\PaddyService;

class DryingResultCalculationController extends Controller
{
    public function edit(Paddy $paddy)
    {
        return view('users.drying_result_calculations.edit', compact('paddy'));
    }

    public function calculate(DryResultCalculateRequest $request, PaddyService $paddyService)
    {
        $data = $request->validated();
        $result = $paddyService->calculateDryResult(
            $data['initial_moisture_content'],
            $data['final_moisture_content'],
            $data['initial_bag_quantity']
        );
        $paddy = \App\Models\Paddy::find($data['paddy_id']);
        return view('users.drying_result_calculations.edit', [
            'paddy' => $paddy,
            'dryingResult' => (object) array_merge($data, $result),
            'calculated' => true
        ]);
    }

    public function store(DryResultCalculateRequest $request, PaddyService $paddyService)
    {
        try{
            $data = $request->validated();
            $result = $paddyService->calculateDryResult(
                $data['initial_moisture_content'],
                $data['final_moisture_content'],
                $data['initial_bag_quantity']
            );
            $dryingResult = DryingResultCalculation::create([
                'paddy_id' => $data['paddy_id'],
                'initial_moisture_content' => $data['initial_moisture_content'],
                'final_moisture_content' => $data['final_moisture_content'],
                'initial_bag_quantity' => $data['initial_bag_quantity'],
                'final_bag_quantity' => $result['final_bag_quantity'],
                'approximate_loss' => $result['approximate_loss'],
            ]);

            return view('users.drying_result_calculations.edit', [
                'dryingResult' => $dryingResult,
                'success' => 'Drying result calculated and saved successfully.'
            ]);
            
        }
        catch (\Exception $e) {
            Log::error('Calculation error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Calculation failed: ' . $e->getMessage()]);
        }
    }
}
