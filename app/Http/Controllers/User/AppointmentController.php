<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\Paddy;
use Illuminate\Http\Request;
use App\Http\Requests\Appointment\CheckAvailabilityRequest;
use App\Services\AppointmentService;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $data = $request->validated();

        $appointment_type_id = $data['appointment_type_id'];
        $appointment_start_date = $data['appointment_start_date'];
        $bag_quantity = $data['bag_quantity'];

        $result = $appointmentService->calculateEndDate($appointment_start_date, $bag_quantity);
        $appointment_end_date = $result['end_date'];
        $duration = $result['duration'];

        $existingAppointment = Appointment::where('appointment_type_id', $appointment_type_id)
            ->where('appointment_end_date', $appointment_end_date)
            ->first();

        if ($existingAppointment) {
            return back()->with('error', 'This appointment date is already booked. Please choose another date.');
        }

        $appointment = new Appointment();
        $appointment->appointment_type_id = $appointment_type_id;
        $appointment->appointment_start_date = $appointment_start_date;
        $appointment->appointment_end_date = $appointment_end_date;
        $appointment->duration = $duration;
        $appointment->bag_quantity = $bag_quantity;

        return view('users.appointments.make', compact('appointment'))->with('success', 'This appointment date is available!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
