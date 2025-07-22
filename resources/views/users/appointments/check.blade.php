@extends('layouts.user')

@section('title', 'Tun Rice Milling - Check Appointment Availability')

@section('content')
<div class="container">
<div>
    <h6 class="text-muted mb-4" data-aos="fade-right">User &gt; My Paddies &gt; Check Appointment Availability</h6>
</div>
    <h1>Check Appointment Availability</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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

    <form action="" method="POST">
        @csrf
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
    </form>
</div>
@endsection