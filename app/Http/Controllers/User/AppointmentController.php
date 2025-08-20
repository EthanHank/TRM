<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\CheckAvailabilityRequest;
use App\Http\Requests\Appointment\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\Paddy;
use App\Services\AppointmentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class AppointmentController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using('user-dashboard'), only: ['index', 'show', 'check', 'checkAvailability', 'store', 'destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            $search = request()->input('search');

            $appointments = Appointment::with(['appointment_type:id,name', 'paddy.paddy_type:id,name'])
                ->whereHas('paddy', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->when($search, fn ($query, $search) => $query->search($search))
                ->orderBy('appointment_start_date', 'asc')
                ->paginate(10);

            return view('users.appointments.index', compact('appointments'));
        } catch (\Exception $e) {
            Log::error('Failed to retrieve appointments: '.$e->getMessage());

            return back()->with('error', 'An error occurred while fetching appointments: '.$e->getMessage());
        }
    }

    public function show(Appointment $appointment)
    {
        $milling = $appointment->milling;
        $drying = $appointment->drying;

        if (($milling || $drying) === null) 
            return redirect()->back()->with('error', 'No milling or drying information available for this appointment.');
        else
            return view('users.appointments.show', compact('appointment', 'milling', 'drying'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function check(Paddy $paddy)
    {
        $appointment_types = AppointmentType::select('id', 'name')->get();

        return view('users.appointments.check', compact('paddy', 'appointment_types'));
    }

    public function checkAvailability(CheckAvailabilityRequest $request, AppointmentService $appointmentService)
    {
        try {
            $appointment = $appointmentService->checkAvailability($request->validated());

            return view('users.appointments.make', [
                'appointment' => $appointment,
                'success' => 'Appointment date is available.',
            ]);
        } catch (\App\Exceptions\AppointmentSlotNotAvailableException $e) {
            return back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Appointment availability check error: '.$e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Failed to check appointment availability: '.$e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request, AppointmentService $appointmentService)
    {
        try {
            $appointmentService->storeAppointment($request->validated());

            return redirect()->route('users.paddies.index')->with('success', 'Appointment is made successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create appointment: '.$e->getMessage());

            return redirect()->back()->with('error', 'Failed to create appointment: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment, AppointmentService $appointmentService)
    {
        try {
            if ($appointment->status === 'Confirmed') {
                return redirect()->back()->with('error', 'Cannot cancel a confirmed appointment.');
            }
            $appointmentService->destroyAppointment($appointment);

            return redirect()->route('users.appointments.index')->with('success', 'Appointment is cancelled successfully');
        } catch (\Exception $e) {
            Log::error('Failed to delete appointment: '.$e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
