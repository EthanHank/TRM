@extends('layouts.user')

@section('title', 'Appointment Details')

@section('content')
<style>
    .bg-color {
        background: linear-gradient(135deg, #667eea, #764ba2) !important;
    }
</style>
<div class="container mt-5">
    <div>
        <h6 class="text-muted mb-4" data-aos="fade-right">User &gt; My Appointment &gt; Appointment Details</h6>
    </div>
    <h2 class="mb-4" data-aos="fade-down">Appointment Details</h2>
    <div class="card mb-4 shadow-sm" data-aos="fade-up">
        <div class="card-body">
            <h5 class="card-title">Appointment #{{ $appointment->id }}</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Paddy Type:</strong> {{ $appointment->paddy->paddy_type->name ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>Appointment Type:</strong> {{ $appointment->appointment_type->name ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>Moisture Content:</strong> {{ $appointment->paddy->moisture_content }}%</li>
                <li class="list-group-item"><strong>Appointment Start Date:</strong> {{ $appointment->appointment_start_date }}</li>
                <li class="list-group-item"><strong>Storage End Date:</strong> {{ $appointment->appointment_end_date }}</li>
                <li class="list-group-item"><strong>Duration:</strong> {{ $appointment->duration }}</li>
                <li class="list-group-item"><strong>Status:</strong> {{ $appointment->status }}</li>
            </ul>
        </div>
    </div>
</div>

@if(isset($milling))
<div class="container mb-5">
    <h4 class="mb-3" data-aos="fade-right">Milling Overview</h4>
    <div class="row bg-color" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
        <div class="mb-4 mt-4" data-aos="fade-up" data-aos-offset="400">
            <div class="card shadow-sm border-0 fade-in-result" style="margin: 0 auto; position: relative;">
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-droplet-half me-2 text-primary"></i>Milling #</span>
                            <span class="fw-bold">{{ $milling->id }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-calendar-plus me-2 text-info"></i>Milling Start Date</span>
                            <span class="fw-bold">{{ $milling->milling_start_date }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-calendar-x me-2 text-warning"></i>Milling End Date</span>
                            <span class="fw-bold">{{ $milling->milling_end_date ?? 'Milling is not done yet.' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-box2-heart me-2 text-danger"></i>Bag Quantity</span>
                            <span class="fw-bold text-danger">{{ $milling->bag_quantity }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-compass-fill me-2 text-success"></i>Status</span>
                            <span class="fw-bold text-success">{{ $milling->status }}</span>
                        </li>
                    </ul>
                    <div class="text-center mt-2">
                        <span class="badge rounded-pill bg-primary">{{ $milling->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <h4 class="mb-3" data-aos="fade-right">Results Overview</h4>
    <div class="row bg-color" data-aos="fade-right" data-aos-offset="200" data-aos-easing="ease-in-sine">
        <div class="mb-4 mt-4" data-aos="fade-up" data-aos-offset="300">
            <div class="card shadow-sm border-0 fade-in-result" style="margin: 0 auto; position: relative;">
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-3">
                        @foreach ($milling->results as $result)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $result->result_type->name }}</span>
                                <span class="fw-bold">{{ $result->bag_quantity }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(isset($drying))
<div class="container">
    <h4 class="mb-3" data-aos="fade-right">Drying Overview</h4>
    <div class="row bg-color" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
        <div class="mb-4 mt-4" data-aos="fade-up" data-aos-offset="400">
            <div class="card shadow-sm border-0 fade-in-result" style="margin: 0 auto; position: relative;">
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-droplet-half me-2 text-primary"></i>Drying #</span>
                            <span class="fw-bold">{{ $drying->id }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-calendar-plus me-2 text-info"></i>Drying Start Date</span>
                            <span class="fw-bold">{{ $drying->drying_start_date }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-calendar-x me-2 text-warning"></i>Drying End Date</span>
                            <span class="fw-bold">{{ $drying->drying_end_date ?? 'Drying is not done yet.' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-box2-heart me-2 text-danger"></i>Bag Quantity</span>
                            <span class="fw-bold text-danger">{{ $drying->bag_quantity }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-compass-fill me-2 text-success"></i>Status</span>
                            <span class="fw-bold text-success">{{ $drying->status }}</span>
                        </li>
                    </ul>
                    <div class="text-center mt-2">
                        <span class="badge rounded-pill bg-primary">{{ $drying->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="text-start mt-5">
    <a href="{{ route('users.appointments.index') }}" class="btn btn-outline-dark">Back to Appointments</a>
</div>

@endsection