<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Paddy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class ReportController extends Controller
{
    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using('user-dashboard'), only: ['appointmentHistory', 'paddyProcessing', 'appointmentHistoryPdf', 'paddyProcessingPdf']),
        ];
    }
    
    public function appointmentHistory(Request $request)
    {
        $user = Auth::user();
        return Appointment::whereHas('paddy', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['appointment_type', 'paddy.paddy_type'])->paginate(10, ['*'], 'appointment_history_page')->appends($request->query());
    }

    public function paddyProcessing(Request $request)
    {
        $user = Auth::user();
        return Paddy::where('user_id', $user->id)->with(['paddy_type', 'appointments.drying', 'appointments.milling.results.result_type'])->paginate(10, ['*'], 'paddy_processing_page')->appends($request->query());
    }

    public function appointmentHistoryPdf(Request $request)
    {
        $appointmentHistory = $this->appointmentHistory($request);
        $pdf = Pdf::loadView('users.reports.pdf.appointment_history', ['appointmentHistory' => $appointmentHistory]);
        return $pdf->download('appointment-history.pdf');
    }

    public function paddyProcessingPdf(Request $request)
    {
        $paddyProcessing = $this->paddyProcessing($request);
        $pdf = Pdf::loadView('users.reports.pdf.paddy_processing', ['paddyProcessing' => $paddyProcessing]);
        return $pdf->download('paddy-processing.pdf');
    }
}