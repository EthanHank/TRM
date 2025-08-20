<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Milling\MakeMillRequest;
use App\Http\Requests\Milling\UpdateRequest;
use App\Mail\MillingCompleted;
use App\Mail\MillingCreated;
use App\Models\Appointment;
use App\Models\Milling;
use App\Models\ResultType;
use App\Services\AppointmentService;
use App\Services\MillingService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class MillingController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using('view-milling'), only: ['index']),
            new Middleware(PermissionMiddleware::using('create-milling'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('complete-milling'), only: ['edit', 'update']),
        ];
    }

    public function index(AppointmentService $appointmentService, MillingService $millingService)
    {
        $search = request()->input('search');
        $startDate = request()->input('start_date');

        $appointments = $appointmentService->confirmedAppointmentList()
            ->whereHas('appointment_type', function ($query) {
                $query->where('name', 'milling');
            })
            ->when($search, fn ($query, $search) => $query->adminSearch($search))
            ->when($startDate, fn ($query, $startDate) => $query->adminSearchByStartDate($startDate))
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
        if ($appointment->appointment_type->name !== 'milling') {
            return redirect()->back()->with('error', 'This appointment is not for milling.');
        }

        if ($appointment->appointment_start_date > now()) {
            return redirect()->back()->with('error', 'This appointment should not be milled today. Please check the appointment start date.');
        }

        $milling = Milling::where('status', '=', 'In Progress')->first();

        if ($milling) {
            return redirect()->back()->with('error', 'There is already a milling in progress.');
        }

        return view('admin.millings.create', compact('appointment'));
    }

    public function store(MakeMillRequest $request, MillingService $millingService)
    {
        $data = $request->validated();
        $appointment = Appointment::findOrFail($data['appointment_id']);
        $milling = $millingService->createMilling($appointment);

        if ($milling) {
            // Send email to user
            Mail::to($milling->appointment->paddy->user->email)->queue(new MillingCreated($milling));

            return redirect()->route('admin.millings.index')->with('success', 'Milling created successfully.');
        }

        return redirect()->back()->with('error', 'Failed to create milling.');
    }

    public function edit(Milling $milling)
    {
        if ($milling->status === 'Completed') {
            return redirect()->back()->with('error', 'This milling is already completed.');
        }

        $result_types = ResultType::all();

        return view('admin.millings.edit', compact('milling', 'result_types'));
    }

    public function update(UpdateRequest $request, Milling $milling, MillingService $millingService)
    {
        $data = $request->validated();

        if ($millingService->updateMilling($milling, $data)) {
            // Send email to user
            Mail::to($milling->appointment->paddy->user->email)->queue(new MillingCompleted($milling));

            return redirect()->route('admin.millings.index')->with('success', 'Milling marked as completed successfully.');
        }

        return redirect()->back()->with('error', 'Failed to update milling.');
    }
}
