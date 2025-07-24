@extends('layouts.user')

@section('title', 'Tun Rice Milling - Make Appointment')

@section('content')
<div class="container">
    <div class="progress-bar-container" data-aos="fade-right">
        <div class="progress-bar-segment completed" >
            Check Availability
        </div>
        <div class="progress-bar-segment active">
            Make Appointment
        </div>
    </div>
    <h2>Make Appointment</h2>

    @if(isset($success))
        <div class="alert alert-success">
            {{ $success }}
        </div>
    @endif

    <div class="card" data-aos="fade-up">
        <div class="card-header">
            Appointment Details
        </div>
        <div class="card-body">
            <p><strong>Appointment Type:</strong> {{ $appointment->appointment_type->name }}</p>
            <p><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_start_date)->format('F j, Y') }}</p>
            <p><strong>Estimated End Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_end_date)->format('F j, Y') }}</p>
            <p><strong>Duration:</strong> {{ $appointment->duration }} days</p>
            <p><strong>Bag Quantity:</strong> {{ $appointment->bag_quantity }}</p>
        </div>
    </div>

    <form action="{{ route('users.appointments.store') }}" method="POST" class="mt-3">
        @csrf
        <input type="hidden" name="paddy_id" value="{{ $appointment->paddy_id }}">
        <input type="hidden" name="appointment_type_id" value="{{ $appointment->appointment_type_id }}">
        <input type="hidden" name="appointment_start_date" value="{{ $appointment->appointment_start_date }}">
        <input type="hidden" name="appointment_end_date" value="{{ $appointment->appointment_end_date }}">
        <input type="hidden" name="duration" value="{{ $appointment->duration }}">
        <input type="hidden" name="bag_quantity" value="{{ $appointment->bag_quantity }}">
        
        <button type="submit" class="btn btn-primary">Confirm Appointment</button>
        <a href="{{ url()->previous() }}" class="btn btn-outline-dark">Cancel</a>
    </form>
</div>
@endsection