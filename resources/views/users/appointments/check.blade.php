@extends('layouts.user')

@section('title', 'Tun Rice Milling - Check Appointment Availability')

@section('content')
<div class="container">
    <div class="progress-bar-container" data-aos="fade-down">
        <div class="progress-bar-segment active">
            Check Availability
        </div>
        <div class="progress-bar-segment">
            Make Appointment
        </div>
    </div>
    <h2>Check Appointment Availability</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.appointments.check-availability') }}" method="GET" data-aos="fade-up">
        <input type="hidden" name="paddy_id" value="{{ $paddy->id }}">
        <div class="form-group mb-3">
            <label for="appointment_type_id">Appointment Type</label>
            <select name="appointment_type_id" id="appointment_type_id" class="form-control">
                @foreach($appointment_types as $appointment_type)
                    <option value="{{ $appointment_type->id }}">{{ $appointment_type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="appointmentstartdate">Appointment Date</label>
            <input type="date" name="appointment_start_date" id="appointmentstartdate" class="form-control" placeholder="Select a date">
        </div>
        <div class="form-group mb-3">
            <label for="bag_quantity">Bag Quantity</label>
            <input type="text" name="bag_quantity" id="bag_quantity" value="{{ $paddy->bag_quantity }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Check Availability</button>
        <a href="{{ route('users.paddies.index') }}" class="btn btn-outline-dark">Back to Paddies</a>
    </form>
</div>
@endsection