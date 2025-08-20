<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Drying\CompleteDryingRequest;
use App\Models\Appointment;
use App\Services\AppointmentService;
use App\Services\DryingService;
use App\Http\Requests\Drying\MakeDryingRequest;
use App\Models\Drying;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class DryingController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using('view-drying'), only: ['index']),
            new Middleware(PermissionMiddleware::using('create-drying'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('complete-drying'), only: ['edit', 'update']),
        ];
    }

    public function index(AppointmentService $appointmentService, DryingService $dryingService)
    {
        $search = request()->input('search');
        $startDate = request()->input('start_date');

        $appointments = $appointmentService->confirmedAppointmentList()
            ->whereHas('appointment_type', function ($query) {
                $query->where('name', 'drying');
            })
            ->when($search, fn ($query, $search) => $query->adminSearch($search))
            ->when($startDate, fn ($query, $startDate) => $query->adminSearchByStartDate($startDate))
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
        if ($appointment->appointment_type->name !== 'drying') 
        {
            return redirect()->back()->with('error', 'This appointment is not for drying.');
        }

        if($appointment->appointment_start_date > now()) 
        {
            return redirect()->back()->with('error', 'This appointment should not be dried today. Please check the appointment start date.');
        }

        $drying = Drying::where('status', '=', 'In Progress')->first();

        if ($drying) {
            return redirect()->back()->with('error', 'There is already a drying in progress.');
        }
        
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
