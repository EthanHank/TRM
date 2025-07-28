@extends('layouts.user')

@section('title', 'Tun Rice Milling - My Appointments')

@section('content')
<div>
    <h6 class="text-muted mb-4" data-aos="fade-right">User > My Appointments</h6>
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
<div class="row mb-3">
    <div class="col-md-6 offset-md-6">
        <form method="GET" action="{{ route('users.appointments.index') }}" class="input-group">
            <input type="text" name="search" class="form-control"
                placeholder="Search by appointment type, paddy type, or status..." value="{{ request('search') }}"
                aria-label="Search appointments">
            <button class="btn btn-search me-2" type="submit">
                <i class="bi bi-search"></i> Search
            </button>
        </form>
    </div>
</div>
<!-- Appointments Table -->
<div class="col-md-12">
    <div class="card mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0" data-aos="fade-down">My Appointments</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive" data-aos="fade-up">
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
                            <td colspan="8" class="text-center text-muted py-4">No appointments found!</td>
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
                                <span class="badge bg-{{ $appointment->status == 'Pending' ? 'secondary' : 'success' }}">{{ $appointment->status }}</span>
                            </td>
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
                                <span class="badge bg-dark">No action available</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                @if ($appointments->hasPages())
                {{ $appointments->links('vendor.pagination.custom-pagination') }}
                @else
                <small class="text-muted">Showing all results ({{ $appointments->total() }} total)</small>
                @endif
            </div>
        </div>
    </div>
    <div class="badge bg-danger">
        Notes: Appointments can be cancelled before they are confirmed.
    </div>
</div>
@endsection