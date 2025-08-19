<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Drying;
use App\Models\Milling;
use App\Models\MillingResultCalculation;
use App\Models\Paddy;
use App\Models\PaddyType;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function overallPerformance(Request $request)
    {
        $totalAppointments = Appointment::count();
        $totalPaddyWeight = Paddy::sum('bag_quantity');
        $totalYields = Result::with('result_type')->get()->groupBy('result_type.name')->map(function ($group) {
            return $group->sum('bag_quantity');
        });

        return [
            'total_appointments' => $totalAppointments,
            'total_paddy_weight' => $totalPaddyWeight,
            'total_yields' => $totalYields,
        ];
    }

    public function paddyTypePerformance(Request $request)
    {
        $paddyTypes = PaddyType::with(['paddies.appointments.drying', 'paddies.appointments.milling.results.result_type'])->paginate(10, ['*'], 'paddy_type_page')->appends($request->query());

        $paddyTypes->through(function ($paddyType) {
            $totalDryingDuration = 0;
            $dryingCount = 0;
            $totalMillingYield = 0;
            $millingCount = 0;
            $qualityDistribution = [];

            foreach ($paddyType->paddies as $paddy) {
                foreach ($paddy->appointments as $appointment) {
                    if ($appointment->drying) {
                        $dryingStartDate = new \DateTime($appointment->drying->drying_start_date);
                        $dryingEndDate = new \DateTime($appointment->drying->drying_end_date);
                        $totalDryingDuration += $dryingEndDate->getTimestamp() - $dryingStartDate->getTimestamp();
                        $dryingCount++;
                    }

                    if ($appointment->milling) {
                        $initialWeight = $paddy->total_bag_weight;
                        $finalWeight = $appointment->milling->results->sum('bag_quantity');
                        if ($initialWeight > 0) {
                            $totalMillingYield += ($finalWeight / $initialWeight) * 100;
                            $millingCount++;
                        }

                        foreach ($appointment->milling->results as $result) {
                            $resultTypeName = $result->result_type->name;
                            if (!isset($qualityDistribution[$resultTypeName])) {
                                $qualityDistribution[$resultTypeName] = 0;
                            }
                            $qualityDistribution[$resultTypeName]++;
                        }
                    }
                }
            }

            $paddyType->average_drying_time_seconds = $dryingCount > 0 ? $totalDryingDuration / $dryingCount : 0;
            $paddyType->average_milling_yield_percentage = $millingCount > 0 ? $totalMillingYield / $millingCount : 0;
            $paddyType->quality_distribution = $qualityDistribution;

            return $paddyType;
        });

        return $paddyTypes;
    }

    public function merchantActivity(Request $request)
    {
        $merchants = User::role('merchant')->with(['paddies.appointments.milling.results.result_type'])->paginate(10, ['*'], 'merchant_page')->appends($request->query());

        $merchants->through(function ($merchant) {
            $totalAppointments = 0;
            $totalPaddySupplied = 0;
            $qualityDistribution = [];

            foreach ($merchant->paddies as $paddy) {
                $totalAppointments += $paddy->appointments->count();
                $totalPaddySupplied += $paddy->bag_quantity;

                foreach ($paddy->appointments as $appointment) {
                    if ($appointment->milling) {
                        foreach ($appointment->milling->results as $result) {
                            $resultTypeName = $result->result_type->name;
                            if (!isset($qualityDistribution[$resultTypeName])) {
                                $qualityDistribution[$resultTypeName] = 0;
                            }
                            $qualityDistribution[$resultTypeName] += $result->bag_quantity;
                        }
                    }
                }
            }

            $merchant->total_appointments = $totalAppointments;
            $merchant->total_paddy_supplied_kg = $totalPaddySupplied;
            $merchant->quality_distribution = $qualityDistribution;

            return $merchant;
        });

        return $merchants;
    }

    public function millingPredictionAccuracy(Request $request)
    {
        $predictions = MillingResultCalculation::with('paddy.appointments.milling.results.result_type')->paginate(10, ['*'], 'milling_accuracy_page')->appends($request->query());

        $predictions->through(function ($prediction) {
            $actualResults = [];
            if ($prediction->paddy && $prediction->paddy->appointments) {
                foreach ($prediction->paddy->appointments as $appointment) {
                    if ($appointment->milling) {
                        foreach ($appointment->milling->results as $result) {
                            $resultTypeName = strtolower(str_replace(' ', '_', $result->result_type->name));
                            if (!isset($actualResults[$resultTypeName])) {
                                $actualResults[$resultTypeName] = 0;
                            }
                            $actualResults[$resultTypeName] += $result->bag_quantity;
                        }
                    }
                }
            }

            $predictedResults = [
                'white_rice' => $prediction->white_rice_bags,
                'broken_rice' => $prediction->broken_rice_bags,
                'bran' => $prediction->bran_bags,
                'husk' => $prediction->husk_bags,
            ];

            $accuracy = [];
            foreach ($predictedResults as $type => $predictedValue) {
                $actualValue = $actualResults[$type] ?? 0;
                $error = $predictedValue > 0 ? (($actualValue - $predictedValue) / $predictedValue) * 100 : 0;
                $accuracy[$type] = [
                    'predicted' => $predictedValue,
                    'actual' => $actualValue,
                    'error_percentage' => round($error, 2),
                ];
            }

            $prediction->accuracy = $accuracy;

            return $prediction;
        });

        return $predictions;
    }

    public function overallPerformancePdf(Request $request)
    {
        $data = $this->overallPerformance($request);
        $pdf = Pdf::loadView('admin.reports.pdf.overall_performance', ['data' => $data]);
        return $pdf->download('overall-performance.pdf');
    }

    public function paddyTypePerformancePdf(Request $request)
    {
        $paddyTypePerformance = $this->paddyTypePerformance($request);
        $pdf = Pdf::loadView('admin.reports.pdf.paddy_type_performance', ['paddyTypePerformance' => $paddyTypePerformance]);
        return $pdf->download('paddy-type-performance.pdf');
    }

    public function merchantActivityPdf(Request $request)
    {
        $merchantActivity = $this->merchantActivity($request);
        $pdf = Pdf::loadView('admin.reports.pdf.merchant_activity', ['merchantActivity' => $merchantActivity]);
        return $pdf->download('merchant-activity.pdf');
    }

    public function millingPredictionAccuracyPdf(Request $request)
    {
        $millingPredictionAccuracy = $this->millingPredictionAccuracy($request);
        $pdf = Pdf::loadView('admin.reports.pdf.milling_prediction_accuracy', ['millingPredictionAccuracy' => $millingPredictionAccuracy]);
        return $pdf->download('milling-prediction-accuracy.pdf');
    }

    
}
