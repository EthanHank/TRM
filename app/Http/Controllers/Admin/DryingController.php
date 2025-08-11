<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Drying\CompleteDryingRequest;
use App\Models\Appointment;
use App\Services\AppointmentService;
use App\Services\DryingService;
use App\Http\Requests\Drying\MakeDryingRequest;
use App\Models\Drying;

class DryingController extends Controller
{
    public function index(AppointmentService $appointmentService, DryingService $dryingService)
    {
        $appointments = $appointmentService->confirmedAppointmentList()
            ->whereHas('appointment_type', function ($query) {
                $query->where('name', 'drying');
            })
            ->orderBy('appointment_start_date', 'asc')
            ->paginate(10)->withQueryString();

        $completed_dryings = $dryingService->getAllDryings()
            ->where('status', '=', 'Completed')
            ->orderBy('drying_start_date', 'asc')
            ->paginate(10)->withQueryString();

        $progress_dryings = $dryingService->getAllDryings()
            ->where('status', '=', 'In Progress')
            ->get();

        return view('admin.dryings.index', compact('appointments', 'completed_dryings', 'progress_dryings'));
    }

    public function create(Appointment $appointment)
    {
        return view('admin.dryings.create', compact('appointment'));
    }

    public function store(MakeDryingRequest $request, DryingService $dryingService)
    {
        $data = $request->validated();
        $appointment = Appointment::findOrFail($data['appointment_id']);
        $dryingService->createDrying($appointment);

        return redirect()->route('admin.dryings.index')->with('success', 'Drying created successfully.');
    }

    public function edit(Drying $drying)
    {
        if ($drying->status === 'Completed') {
            return redirect()->back()->with('error', 'This drying is already completed.');
        }

        return view('admin.dryings.edit', compact('drying'));
    }

    public function update(CompleteDryingRequest $request, Drying $drying, DryingService $dryingService)
    {
        $data = $request->validated();

        $dryingService->updateDrying($drying, $data);

        return redirect()->route('admin.dryings.index')->with('success', 'Drying marked as completed successfully.');


    }
}
