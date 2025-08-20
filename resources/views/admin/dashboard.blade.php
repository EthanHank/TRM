@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Admin Dashboard')

@section('content')
<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Our Merchants</h6>
                        <h3 class="mb-0">{{ $merchantCount }}</h3>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Pending Appointments</h6>
                        <h3 class="mb-0">{{ $pendingAppointmentCount }}</h3>
                    </div>
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-calendar-minus"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Appointments</h6>
                        <h3 class="mb-0">{{ $appointmentCount }}</h3>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Paddy Quantity (bags)</h6>
                        <h3 class="mb-0">{{ number_format($totalPaddyWeight) }}</h3>
                    </div>
                    <div class="stat-icon bg-secondary bg-opacity-10 text-secondary">
                        <i class="bi bi-box"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Paddy Types</h6>
                        <h3 class="mb-0">{{ number_format($paddyTypeCount) }}</h3>
                    </div>
                    <div class="stat-icon bg-info bg-opacity-10 text-info">
                        <i class="bi bi-backpack4-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Result Types</h6>
                        <h3 class="mb-0">{{ number_format($resultTypeCount) }}</h3>
                    </div>
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-boxes"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Appointments Table -->
<div class="col-md-12 mb-5">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Pending Appointments</h5>
            <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-primary float-end">View All</a>
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
                        @if ($pendingAppointments->count() == 0)
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">No Appointments found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($pendingAppointments as $appointment)
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
        </div>
    </div>
</div>

<!-- Statistics Cards Millings-->
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Completed Millings</h6>
                        <h3 class="mb-0">{{ $totalCompletedMillings }}</h3>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-building-fill-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Millings</h6>
                        <h3 class="mb-0">{{ $totalMillings }}</h3>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-building-fill-gear"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- In Progress Milling Table -->
<div class="col-md-12 mb-5">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Milling - In Progress</h5>
            <a href="{{ route('admin.millings.index') }}" class="btn btn-sm btn-primary float-end">View All</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>#</th>
                            <th>Appointment Type</th>
                            <th>Paddy Type</th>
                            <th>Milling Start Date</th>
                            <th>Bag Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($progress_millings->count() == 0)
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No In Progress Milling found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($progress_millings as $milling)
                        <tr class="text-center align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $milling->appointment->appointment_type->name }}</td>
                            <td>{{ $milling->appointment?->paddy?->paddy_type?->name ?? 'Not Available' }}</td>
                            <td>{{ $milling->milling_start_date }}</td>
                            <td>{{ $milling->bag_quantity }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $milling->status }}</span>
                            </td>
                            <td>
                                <span class="btn btn-primary btn-sm">
                                    <a class="text-white text-decoration-none" href="{{ route('admin.millings.edit', $milling->id) }}">
                                        Mark as Completed
                                    </a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards Dryings-->
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Completed Dryings</h6>
                        <h3 class="mb-0">{{ $totalCompletedDryings }}</h3>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-check2-all"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Dryings</h6>
                        <h3 class="mb-0">{{ $totalDryings }}</h3>
                    </div>
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-fire"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- In Progress Drying Table -->
<div class="col-md-12 mb-5">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Drying - In Progress</h5>
            <a href="{{ route('admin.dryings.index') }}" class="btn btn-sm btn-primary float-end">View All</a>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($progress_dryings->count() == 0)
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No In Progress Drying found! T_T</td>
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
                            <td>
                                <span class="btn btn-primary btn-sm">
                                    <a class="text-white text-decoration-none" href="{{ route('admin.dryings.edit', $drying->id) }}">
                                        Mark as Completed
                                    </a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Reports -->
<div class="card">
    <div class="card-header bg-white">
        <ul class="nav nav-tabs card-header-tabs" id="reportsTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="overall-performance-tab" data-bs-toggle="tab" data-bs-target="#overall-performance" type="button" role="tab" aria-controls="overall-performance" aria-selected="true">Overall Performance</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="paddy-type-performance-tab" data-bs-toggle="tab" data-bs-target="#paddy-type-performance" type="button" role="tab" aria-controls="paddy-type-performance" aria-selected="false">Paddy Type Performance</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="merchant-activity-tab" data-bs-toggle="tab" data-bs-target="#merchant-activity" type="button" role="tab" aria-controls="merchant-activity" aria-selected="false">Merchant Activity</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="milling-prediction-accuracy-tab" data-bs-toggle="tab" data-bs-target="#milling-prediction-accuracy" type="button" role="tab" aria-controls="milling-prediction-accuracy" aria-selected="false">Milling Prediction Accuracy</button>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="reportsTabContent">
            <div class="tab-pane fade show active" id="overall-performance" role="tabpanel" aria-labelledby="overall-performance-tab">
                <a href="{{ route('admin.reports.overall_performance.pdf') }}" class="btn btn-primary mb-3 btn-sm">Export to <i class="bi bi-filetype-pdf"></i></a>
                @include('admin.reports.overall_performance', ['data' => $overallPerformance])
            </div>
            <div class="tab-pane fade" id="paddy-type-performance" role="tabpanel" aria-labelledby="paddy-type-performance-tab">
                <a href="{{ route('admin.reports.paddy_type_performance.pdf') }}" class="btn btn-primary btn-sm mb-3">Export to <i class="bi bi-filetype-pdf"></i></a>
                @include('admin.reports.paddy_type_performance', ['paddyTypePerformance' => $paddyTypePerformance])
            </div>
            <div class="tab-pane fade" id="merchant-activity" role="tabpanel" aria-labelledby="merchant-activity-tab">
                <a href="{{ route('admin.reports.merchant_activity.pdf') }}" class="btn btn-primary btn-sm mb-3">Export to <i class="bi bi-filetype-pdf"></i></a>
                @include('admin.reports.merchant_activity', ['merchantActivity' => $merchantActivity])
            </div>
            <div class="tab-pane fade" id="milling-prediction-accuracy" role="tabpanel" aria-labelledby="milling-prediction-accuracy-tab">
                <a href="{{ route('admin.reports.milling_prediction_accuracy.pdf') }}" class="btn btn-primary btn-sm mb-3">Export to <i class="bi bi-filetype-pdf"></i></a>
                @include('admin.reports.milling_prediction_accuracy', ['millingPredictionAccuracy' => $millingPredictionAccuracy])
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Tab persistence with URL parameters
        var url = new URL(window.location.href);
        var activeTab = url.searchParams.get("tab");
        if (activeTab) {
            $('#reportsTab button[data-bs-target="#' + activeTab + '"]').tab('show');
        }

        $('button[data-bs-toggle="tab"]').on('click', function(e) {
            e.preventDefault();
            var tab = $(this).attr('data-bs-target').substring(1);
            var url = new URL(window.location.href);
            url.searchParams.set("tab", tab);
            // Clear other page parameters
            url.searchParams.delete('paddy_type_page');
            url.searchParams.delete('merchant_page');
            url.searchParams.delete('milling_accuracy_page');
            window.location.href = url.href;
        });
    });
</script>
@endpush