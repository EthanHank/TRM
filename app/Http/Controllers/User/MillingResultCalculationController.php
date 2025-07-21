<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\MillingResultCalculation\MillingResultCalculateRequest;
use App\Models\MillingResultCalculation;
use App\Models\Paddy;
use App\Services\MillingPredictor;
use Illuminate\Http\Request;

class MillingResultCalculationController extends Controller
{
    public function edit(Paddy $paddy)
    {
        return view('users.milling_result_calculations.edit', compact('paddy'));
    }

    public function calculate(MillingResultCalculateRequest $request)
    {
        $data = $request->validated();
        $paddy = Paddy::find($data['paddy_id']);
        $bag_weight = $paddy->bag_weight ?? 50;
        $predictor = new MillingPredictor(
            $data['initial_bag_quantity'],
            $bag_weight,
            $data['initial_moisture_content'],
            $data['final_moisture_content']
        );
        $result = $predictor->summary();
        return view('users.milling_result_calculations.edit', [
            'paddy' => $paddy,
            'millingResult' => (object) array_merge($data, $result)
        ]);
    }

    public function store(MillingResultCalculateRequest $request)
    {
        $millingResult = MillingResultCalculation::create($request->validated());
        $paddy = Paddy::find($millingResult->paddy_id);
        return view('users.milling_result_calculations.edit', [
            'paddy' => $paddy,
            'success' => 'Milling result calculated and saved successfully.'
        ]);
    }

    public function destroy(MillingResultCalculation $millingResultCalculation)
    {
        $paddyId = $millingResultCalculation->paddy_id;
        $millingResultCalculation->delete();
        return redirect()->route('users.paddies.show', $paddyId)
            ->with('mill-result-delete', 'Milling result calculation deleted successfully.');
    }
} 