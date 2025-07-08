<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentType\CreateAppointmentTypeRequest;
use App\Http\Requests\AppointmentType\UpdateAppointmentTypeRequest;
use App\Models\AppointmentType;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Middleware\PermissionMiddleware;

class AppointmentTypeController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using('view-appointment-type'), only: ['index']),
            new Middleware(PermissionMiddleware::using('create-appointment-type'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('edit-appointment-type'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('delete-appointment-type'), only: ['destroy']),
        ];
    }

    public function index()
    {
        try {
            $appointment_types = AppointmentType::select('id', 'name', 'description')->paginate(5);

            return view('admin.appointment_types.index', compact('appointment_types'));
        } catch (\Exception $e) {
            Log::error('Failed to retrieve appointment types: '.$e->getMessage());

            return back()->with('error', 'Failed to load appointment types. Please try again.');
        }
    }

    public function create()
    {
        return view('admin.appointment_types.create');
    }

    public function store(CreateAppointmentTypeRequest $request)
    {
        try {
            AppointmentType::create($request->validated());

            return redirect()->route('admin.appointment_types.index')->with('success', 'Appointment Type is created successfully');
        } catch (\Exception $e) {
            Log::error('Failed to create appointment type: '.$e->getMessage());

            return back()->withInput()->with('error', 'Failed to create appointment type. Please try again.');
        }
    }

    public function edit(AppointmentType $appointment_type)
    {
        return view('admin.appointment_types.edit', compact('appointment_type'));
    }

    public function update(UpdateAppointmentTypeRequest $request, AppointmentType $appointment_type)
    {
        try {
            $appointment_type->update($request->validated());

            return redirect()->route('admin.appointment_types.index')->with('success', 'Appointment Type is updated successfully');
        } catch (\Exception $e) {
            Log::error('Failed to update appointment type: '.$e->getMessage());

            return back()->withInput()->with('error', 'Failed to update appointment type. Please try again.');
        }
    }

    public function destroy(AppointmentType $appointment_type)
    {
        try {
            $appointment_type->delete();

            return redirect()->route('admin.appointment_types.index')->with('success', 'Appointment Type is deleted successfully');
        } catch (\Exception $e) {
            Log::error('Failed to delete appointment type: '.$e->getMessage());

            return back()->with('error', 'Failed to delete appointment type. Please try again.');
        }
    }
}
