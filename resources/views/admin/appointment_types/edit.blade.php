@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Appointment Types Update')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Appointment Types > Update</h6>
</div>
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.appointment_types.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Appointment Types
    </a>
</div>
<div class="mb-4">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">
                Update Appointment Type
                (<span class="text-primary">{{ $appointment_type->name }}</span>)
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.appointment_types.update', $appointment_type) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $appointment_type->name }}">
                    @error('name')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ $appointment_type->description }}</textarea>
                    @error('description')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection