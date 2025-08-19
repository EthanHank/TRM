<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\ReportController;
use App\Models\Appointment;
use App\Models\Paddy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(Request $request, ReportController $reportController)
    {
        $user = Auth::user();
        $recentAppointments = Appointment::whereHas('paddy', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('paddy.paddy_type', 'appointment_type')->latest()->take(5)->get();

        $totalPaddySupplied = Paddy::where('user_id', $user->id)->sum('bag_quantity');
        $appointmentCount = Appointment::whereHas('paddy', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        // Get report data
        $appointmentHistory = $reportController->appointmentHistory($request);
        $paddyProcessing = $reportController->paddyProcessing($request);

        return view('users.dashboard', compact(
            'recentAppointments',
            'totalPaddySupplied',
            'appointmentCount',
            'appointmentHistory',
            'paddyProcessing'
        ));
    }
}