@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Appointment Types Management')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Appointment Types</h6>
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
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.appointment_types.create') }}" class="btn btn-success"> + Add Appointment Type</a>
</div>
<!-- Search for appointment types by name. -->
<div class="row mb-3">
    <div class="col-md-6 offset-md-6">
        <form method="GET" action="{{ route('admin.appointment_types.index') }}" class="input-group">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search appointment types by name..."
                value="{{ request('search') }}"
                aria-label="Search appointment types"
            >
            <button class="btn btn-search me-2" type="submit">
                <i class="bi bi-search"></i> Search
            </button>
        </form>
    </div>
</div>
<!-- Roles Table -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Current Appointment Types</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($appointment_types->count() == 0)
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No appointment types found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($appointment_types as $appointment_type)
                        <tr class="text-center align-middle">
                            <td>{{ $appointment_type->name }}</td>
                            <td>{{ $appointment_type->description }}</td>
                            <td>
                                <span class="btn btn-primary mb-1">
                                    <a class="text-white" href="{{ route('admin.appointment_types.edit', $appointment_type->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </span>
                                <form action="{{ route('admin.appointment_types.destroy', $appointment_type->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this appointment type?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                    @if($appointment_types->hasPages())
                        {{ $appointment_types->links('vendor.pagination.custom-pagination') }}
                    @else
                        <small class="text-muted">Showing all results ({{ $appointment_types->total() }} total)</small>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection