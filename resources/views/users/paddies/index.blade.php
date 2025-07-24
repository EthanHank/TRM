@extends('layouts.user')

@section('title', 'Tun Rice Milling - My Paddies')

@section('content')
<div>
    <h6 class="text-muted mb-4" data-aos="fade-right">User &gt; My Paddies</h6>
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
<!-- Search for paddies -->
<div class="row mb-3">
    <div class="col-md-6 offset-md-6">
        <form method="GET" action="{{ route('users.paddies.index') }}" class="input-group">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search by paddy type, moisture, or max storage duration..."
                value="{{ request('search') }}"
                aria-label="Search paddies"
            >
            <button class="btn btn-search me-2" type="submit">
                <i class="bi bi-search"></i> Search
            </button>
        </form>
    </div>
</div>
<!-- Paddies Table -->
<div class="col-md-12">
    <div class="card" data-aos="fade-up">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0" data-aos="fade-down">My Paddies</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive" data-aos="fade-up">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>Paddy Type</th>
                            <th>Merchant</th>
                            <th>Bag Quantity</th>
                            <th>Bag Weight (kg)</th>
                            <th>Total Bag Weight (kg)</th>
                            <th>Moisture Content</th>
                            <th>Storage Start</th>
                            <th>Storage End</th>
                            <th>Maximum Storage</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($paddies->count() == 0)
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">No paddies found!</td>
                        </tr>
                        @endif
                        @foreach ($paddies as $paddy)
                        <tr class="text-center align-middle">
                            <td>{{ $paddy->paddy_type ? $paddy->paddy_type->name : 'Deleted Paddy Type' }}</td>
                            <td>{{ $paddy->user->name }}</td>
                            <td>{{ $paddy->bag_quantity }} bags</td>
                            <td>{{ $paddy->bag_weight ?? '-' }} kg</td>
                            <td>{{ $paddy->total_bag_weight ?? '-' }} kg</td>
                            <td>{{ $paddy->moisture_content }}%</td>
                            <td>{{ $paddy->storage_start_date }}</td>
                            <td>{{ $paddy->storage_end_date }}</td>
                            <td>{{ $paddy->maximum_storage_duration }}</td>
                            <td>
                                <a href="{{ route('users.appointments.check', $paddy->id) }}" class="btn btn-outline-primary btn-sm mb-1">
                                    <i class="bi bi-calendar-plus"></i> Make Appointment
                                </a><br>
                                <a href="{{ route('users.paddies.show', $paddy->id) }}" class="btn btn-outline-info btn-sm mb-1">
                                    <i class="bi bi-eye"></i> View Paddy Details
                                </a><br>
                                <a href="{{ route('users.drying_result_calculations.edit', $paddy->id) }}" class="btn btn-outline-success btn-sm mb-1">
                                    <i class="bi bi-calculator"></i> Calculate Drying Result
                                </a><br>
                                <a href="{{ route('users.milling_result_calculations.edit', $paddy->id) }}" class="btn btn-outline-warning btn-sm mb-1">
                                    <i class="bi bi-calculator"></i> Calculate Milling Result
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                @if($paddies->hasPages())
                    {{ $paddies->links('vendor.pagination.custom-pagination') }}
                @else
                    <small class="text-muted">Showing all results ({{ $paddies->total() }} total)</small>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
