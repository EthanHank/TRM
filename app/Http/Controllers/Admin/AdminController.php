<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ReportController;
use App\Models\Appointment;
use App\Models\Paddy;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request, ReportController $reportController)
    {
        $merchantCount = User::role('merchant')->count();
        $appointmentCount = Appointment::count();
        $totalPaddyWeight = Paddy::sum('bag_quantity');
        $recentAppointments = Appointment::with('paddy.user', 'appointment_type')->latest()->take(5)->get();

        // Get report data
        $overallPerformance = $reportController->overallPerformance($request);
        $paddyTypePerformance = $reportController->paddyTypePerformance($request);
        $merchantActivity = $reportController->merchantActivity($request);
        $millingPredictionAccuracy = $reportController->millingPredictionAccuracy($request);

        return view('admin.dashboard', compact(
            'merchantCount',
            'appointmentCount',
            'totalPaddyWeight',
            'recentAppointments',
            'overallPerformance',
            'paddyTypePerformance',
            'merchantActivity',
            'millingPredictionAccuracy'
        ));
    }
}
