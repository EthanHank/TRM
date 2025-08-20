@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Dryings Management')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Dryings</h6>
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
        <form method="GET" action="{{ route('admin.dryings.index') }}" class="input-group">
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

<!-- Appointments Table -->
<div class="col-md-12 mb-5">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Appointments</h5>
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
                            @if(Auth::user()->hasPermissionTo('create-drying'))
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($appointments->count() == 0)
                        <tr>
                            <td colspan="{{ Auth::user()->hasPermissionTo('create-drying') ? 9 : 8 }}" class="text-center text-muted py-4">No Appointments found! T_T</td>
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
                            @if(Auth::user()->hasPermissionTo('create-drying'))
                            <td>
                                <span class="btn btn-primary btn-sm">
                                    <a class="text-white text-decoration-none" href="{{ route('admin.dryings.create', $appointment->id) }}">
                                        Start Drying
                                    </a>
                                </span>
                            </td>
                            @endif
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

<!-- In Progress Drying Table -->
<div class="col-md-12 mb-5">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Drying - In Progress</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>#</th>
                            <th>Appointment Type</th>
                            <th>Paddy Type</th>
                            <th>Drying Start Date</th>
                            <th>Bag Quantity</th>
                            <th>Status</th>
                            @if(Auth::user()->hasPermissionTo('complete-drying'))
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($progress_dryings->count() == 0)
                        <tr>
                            <td colspan="{{ Auth::user()->hasPermissionTo('complete-drying') ? 7 : 6 }}" class="text-center text-muted py-4">No In Progress Drying found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($progress_dryings as $drying)
                        <tr class="text-center align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $drying->appointment->appointment_type->name }}</td>
                            <td>{{ $drying->appointment?->paddy?->paddy_type?->name ?? 'Not Available' }}</td>
                            <td>{{ $drying->drying_start_date }}</td>
                            <td>{{ $drying->bag_quantity }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $drying->status }}</span>
                            </td>
                            @if(Auth::user()->hasPermissionTo('complete-drying'))
                            <td>
                                <span class="btn btn-primary btn-sm">
                                    <a class="text-white text-decoration-none" href="{{ route('admin.dryings.edit', $drying->id) }}">
                                        Mark as Completed
                                    </a>
                                </span>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Completed Drying Table -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Drying - Completed</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>#</th>
                            <th>Appointment Type</th>
                            <th>Paddy Type</th>
                            <th>Drying Start Date</th>
                            <th>Drying End Date</th>
                            <th>Bag Quantity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($completed_dryings->count() == 0)
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No Completed Drying found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($completed_dryings as $drying)
                        <tr class="text-center align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $drying->appointment->appointment_type->name }}</td>
                            <td>{{ $drying->appointment?->paddy?->paddy_type?->name ?? 'Deleted Paddy Type' }}</td>
                            <td>{{ $drying->drying_start_date }}</td>
                            <td>{{ $drying->drying_end_date ?? 'N/A' }}</td>
                            <td>{{ $drying->bag_quantity }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $drying->status }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                @if($completed_dryings->hasPages())
                    {{ $completed_dryings->links('vendor.pagination.custom-pagination') }}
                @else
                    <small class="text-muted">Showing all results ({{ $completed_dryings->total() }} total)</small>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection