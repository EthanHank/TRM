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
<!-- Roles Table -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Pending Appointments</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Appointment Type</th>
                            <th>Paddy Type</th>
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
                            <td colspan="8" class="text-center text-muted py-4">No Appointments found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $appointment->appointment_type->name }}</td>
                            <td>{{ $appointment->paddy->paddy_type->name }}</td>
                            <td>{{ $appointment->appointment_start_date }}</td>
                            <td>{{ $appointment->appointment_end_date }}</td>
                            <td>{{ $appointment->bag_quantity }}</td>
                            <td>{{ $appointment->status }}</td>
                            <td>
                                @if($appointment->status === "Pending")
                                <form action="{{ route('users.appointments.destroy', $appointment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                        <i class="bi bi-trash"></i> Cancel Appointment
                                    </button>
                                </form>
                                @else
                                <span class="badge bg-primary">Appointment is confirmed</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                    @if($merchants->hasPages())
                        {{ $merchants->links('vendor.pagination.custom-pagination') }}
                    @else
                        <small class="text-muted">Showing all results ({{ $merchants->total() }} total)</small>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection