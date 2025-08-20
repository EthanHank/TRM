<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ReportController;
use App\Models\Appointment;
use App\Models\Paddy;
use App\Models\PaddyType;
use App\Models\ResultType;
use App\Models\User;
use App\Models\Milling;
use App\Models\Drying;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request, ReportController $reportController)
    {
        $merchantCount = User::role('merchant')->count();
        $appointmentCount = Appointment::count();
        $resultTypeCount = ResultType::count();
        $paddyTypeCount = PaddyType::count();
        $totalMillings = Milling::count();
        $totalDryings = Drying::count();
        $totalCompletedDryings = Drying::where('status', 'Completed')->count();
        $totalCompletedMillings = Milling::where('status', 'Completed')->count();
        $progress_millings = Milling::where('status', 'In Progress')->get();
        $progress_dryings = Drying::where('status', 'In Progress')->get();
        $pendingAppointmentCount = Appointment::where('status', 'Pending')->count();
        $totalPaddyWeight = Paddy::sum('bag_quantity');
        $pendingAppointments = Appointment::with('paddy.user', 'appointment_type','paddy.paddy_type')->where('status', 'Pending')->latest()->take(5)->get();

        // Get report data
        $overallPerformance = $reportController->overallPerformance($request);
        $paddyTypePerformance = $reportController->paddyTypePerformance($request);
        $merchantActivity = $reportController->merchantActivity($request);
        $millingPredictionAccuracy = $reportController->millingPredictionAccuracy($request);

        return view('admin.dashboard', compact(
            'merchantCount',
            'appointmentCount',
            'totalPaddyWeight',
            'pendingAppointments',
            'overallPerformance',
            'paddyTypePerformance',
            'merchantActivity',
            'millingPredictionAccuracy',
            'pendingAppointmentCount',
            'resultTypeCount',
            'paddyTypeCount',
            'progress_millings',
            'totalMillings',
            'totalCompletedMillings',
            'progress_dryings',
            'totalDryings',
            'totalCompletedDryings'
        ));
    }
}
