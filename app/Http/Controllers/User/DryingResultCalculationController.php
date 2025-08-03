<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\DryingResultCalculation\DryResultCalculateRequest;
use App\Models\DryingResultCalculation;
use App\Models\Paddy;
use App\Services\PaddyService;
use Illuminate\Support\Facades\Log;

class DryingResultCalculationController extends Controller
{
    public function edit(Paddy $paddy)
    {
        $dryingResult = session('dryingResult');

        return view('users.drying_result_calculations.edit', compact('paddy', 'dryingResult'));
    }

    public function calculate(DryResultCalculateRequest $request, PaddyService $paddyService)
    {
        try {
            $data = $request->validated();
            $paddy = Paddy::find($data['paddy_id']);
            $bag_weight = $paddy->bag_weight ?? 50;
            $result = $paddyService->calculateDryResult(
                $data['initial_moisture_content'],
                $data['final_moisture_content'],
                $data['initial_bag_quantity'],
                $bag_weight
            );

            $dryingResult = (object) array_merge($data, $result);

            return redirect()->route('users.drying_result_calculations.edit', ['paddy' => $paddy->id])
                ->with('dryingResult', $dryingResult);
        } catch (\Exception $e) {
            Log::error('Drying result calculation error: '.$e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Calculation failed: '.$e->getMessage()]);
        }
    }

    public function store(DryResultCalculateRequest $request, PaddyService $paddyService)
    {
        try {
            $data = $request->validated();
            $paddy = Paddy::find($data['paddy_id']);
            $bag_weight = $paddy->bag_weight ?? 50;
            $result = $paddyService->calculateDryResult(
                $data['initial_moisture_content'],
                $data['final_moisture_content'],
                $data['initial_bag_quantity'],
                $bag_weight
            );
            DryingResultCalculation::create(array_merge($data, $result));

            return redirect()->route('users.drying_result_calculations.edit', $paddy->id)
                ->with('success', 'Drying result calculated and saved successfully.');
        } catch (\Exception $e) {
            Log::error('Calculation store error: '.$e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Saving failed: '.$e->getMessage()]);
        }
    }

    public function destroy(DryingResultCalculation $dryingResultCalculation)
    {
        try {
            $paddyId = $dryingResultCalculation->paddy_id;
            $dryingResultCalculation->delete();

            return redirect()->route('users.paddies.show', $paddyId)
                ->with('dry-result-delete', 'Drying result calculation deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Drying result deletion error: '.$e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Deletion failed: '.$e->getMessage()]);
        }
    }
}
