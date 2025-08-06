@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Appointments Management')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Appointments</h6>
</div>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Search for appointments -->
    <div class="container mb-4">
        <form method="GET" action="{{ route('admin.appointments.index') }}" class="input-group">
            <input type="text" name="search" class="form-control"
                placeholder="Search by appointment type, paddy type" value="{{ request('search') }}"
                aria-label="Search appointments">
            <input type="date" name="start_date" class="form-control" id="appointmentstartdate"
                placeholder="Search by start date" value="{{ request('start_date') }}" aria-label="Start Date">
            <button class="btn btn-search me-2" type="submit">
                <i class="bi bi-search"></i> Search
            </button>
        </form>
    </div>

<!-- Pending Appointments Table -->
<div class="col-md-12 mb-4">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Pending Appointments</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>#</th>
                            <th>Appointment Type</th>
                            <th>Paddy Type</th>
                            <th>Moisture Content</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Bag Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($appointments->count() == 0)
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">No Appointments found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($appointments as $appointment)
                        <tr class="text-center align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $appointment->appointment_type->name }}</td>
                            <td>{{ $appointment->paddy->paddy_type->name }}</td>
                            <td>{{ $appointment->paddy->moisture_content }}%</td>
                            <td>{{ $appointment->appointment_start_date }}</td>
                            <td>{{ $appointment->appointment_end_date }}</td>
                            <td>{{ $appointment->bag_quantity }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $appointment->status }}</span>
                            </td>
                            <td>
                                <span class="btn btn-danger btn-sm mb-1">
                                    <a class="text-white text-decoration-none" href="{{ route('admin.appointments.cancel', $appointment->id) }}">
                                        <i class="bi bi-x-circle"></i> Cancel
                                    </a>
                                </span>
                                <span class="btn btn-primary btn-sm mb-1">
                                    <a class="text-white text-decoration-none" href="{{ route('admin.appointments.confirm', $appointment->id) }}">
                                        <i class="bi bi-calendar-check-fill"></i> Confirm
                                    </a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                    @if($appointments->hasPages())
                        {{ $appointments->links('vendor.pagination.custom-pagination') }}
                    @else
                        <small class="text-muted">Showing all results ({{ $appointments->total() }} total)</small>
                    @endif
            </div>
        </div>
    </div>
</div>

<!-- Confirmed Appointments Table -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Confirmed Appointments</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>#</th>
                            <th>Appointment Type</th>
                            <th>Paddy Type</th>
                            <th>Moisture Content</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Bag Quantity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($confirmed_appointments->count() == 0)
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No Appointments found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($confirmed_appointments as $appointment)
                        <tr class="text-center align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $appointment->appointment_type->name }}</td>
                            <td>{{ $appointment->paddy->paddy_type->name }}</td>
                            <td>{{ $appointment->paddy->moisture_content }}%</td>
                            <td>{{ $appointment->appointment_start_date }}</td>
                            <td>{{ $appointment->appointment_end_date }}</td>
                            <td>{{ $appointment->bag_quantity }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $appointment->status }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                    @if($confirmed_appointments->hasPages())
                        {{ $confirmed_appointments->links('vendor.pagination.custom-pagination') }}
                    @else
                        <small class="text-muted">Showing all results ({{ $confirmed_appointments->total() }} total)</small>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection