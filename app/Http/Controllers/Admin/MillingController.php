<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Milling\MakeMillRequest;
use App\Http\Requests\Milling\UpdateRequest;
use App\Services\AppointmentService;
use App\Services\MillingService;
use App\Models\Appointment;
use App\Models\Milling;
use App\Models\Result;
use App\Models\ResultType;

class MillingController extends Controller
{
    public function index(AppointmentService $appointmentService, MillingService $millingService)
    {
        $appointments = $appointmentService->confirmedAppointmentList()
        ->whereHas('appointment_type', function ($query) {
            $query->where('name', 'milling');
        })
        ->orderBy('appointment_start_date', 'asc')
        ->paginate(10)->withQueryString();

        $completed_millings = $millingService->getAllMillings()
            ->where('status', '=', 'Completed')
            ->orderBy('milling_start_date', 'asc')
            ->paginate(10)->withQueryString();
        
        $progress_millings = $millingService->getAllMillings()
            ->where('status', '=', 'In Progress')
            ->get();

        return view('admin.millings.index', compact('appointments', 'completed_millings', 'progress_millings'));
    }

    public function create(Appointment $appointment)
    {
        return view('admin.millings.create', compact('appointment'));
    }

    public function store(MakeMillRequest $request, MillingService $millingService)
    {
        $data = $request->validated();
        $appointment = Appointment::findOrFail($data['appointment_id']);
        $milling = $millingService->createMilling($appointment);

        if ($milling) {
            return redirect()->route('admin.millings.index')->with('success', 'Milling created successfully.');
        }

        return redirect()->back()->with('error', 'Failed to create milling.');
    }

    public function edit(Milling $milling)
    {
        $result_types = ResultType::all();
        return view('admin.millings.edit', compact('milling', 'result_types'));
    }

    public function update(UpdateRequest $request, Milling $milling)
    {
        $data = $request->validated();

        foreach ($data['results'] as $result_type_id => $bag_quantity) {
            Result::create([
                'result_type_id' => $result_type_id,
                'milling_id' => $milling->id,
                'user_id' => $milling->appointment->paddy->user_id,
                'bag_quantity' => $bag_quantity,
            ]);
        }

        $milling->status = 'Completed';
        $milling->milling_end_date = now();
        $milling->save();

        return redirect()->route('admin.millings.index')->with('success', 'Milling marked as completed successfully.');
    }

}
