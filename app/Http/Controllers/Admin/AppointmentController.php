<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\CancelAppointmentRequest;
use App\Mail\AppointmentCancelled;
use App\Models\Appointment;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmed;

class AppointmentController extends Controller
{
    public function index()
    {
        try {
            $search = request()->input('search');
            $startDate = request()->input('start_date');

            $appointments = Appointment::with(['appointment_type:id,name', 'paddy.paddy_type:id,name'])
                ->where('status', '!=', 'Confirmed')
                ->when($search, function ($query, $search) {
                    return $query->adminSearch($search);
                })
                ->when($startDate, function ($query, $startDate) {
                    return $query->adminSearchByStartDate($startDate);
                })
                ->orderBy('appointment_start_date', 'asc')
                ->paginate(10)->withQueryString();

            return view('admin.appointments.index', compact('appointments'));
        } catch (\Exception $e) {
            Log::error('Failed to retrieve appointments: '.$e->getMessage());

            return back()->with('error', 'An error occurred while fetching appointments: '.$e->getMessage());
        }
    }

    public function cancel(Appointment $appointment)
    {
        try {
            return view('admin.appointments.cancel', compact('appointment'));
        } catch (\Exception $e) {
            Log::error('Failed to cancel appointment: '.$e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while cancelling the appointment: '.$e->getMessage());
        }
    }

    public function confirm(Appointment $appointment)
    {
        try {
            $appointment->update(['status' => 'Confirmed']);
            $user = $appointment->paddy->user;

            Mail::to($user->email)->queue(new AppointmentConfirmed($appointment, $user));

            return redirect()->route('admin.appointments.index')->with('success', 'Appointment is confirmed successfully');
        } catch (\Exception $e) {
            Log::error('Failed to confirm appointment: '.$e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while confirming the appointment: '.$e->getMessage());
        }
    }

    public function destroy(CancelAppointmentRequest $request, Appointment $appointment, AppointmentService $appointmentService)
    {
        try {
            $validated = $request->validated();

            // Get the merchant user
            $user = $appointment->paddy->user;

            Mail::to($user->email)->send(new AppointmentCancelled($appointment->id, $user->id, $validated['cancel_reason']));

            $appointmentService->destroyAppointment($appointment);

            return redirect()->route('admin.appointments.index')->with('success', 'Appointment is cancelled successfully');
        } catch (\Exception $e) {
            Log::error('Failed to delete appointment: '.$e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
