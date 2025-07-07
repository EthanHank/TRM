@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Paddies Management')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Paddies</h6>
</div>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.paddies.create') }}" class="btn btn-success"> + Add Paddy</a>
</div>
<!-- Roles Table -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Current Paddies</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Paddy Type</th>
                            <th>Merchant</th>
                            <th>Bag Quantity</th>
                            <th>Moisture Content</th>
                            <th>Storage Start</th>
                            <th>Storage End</th>
                            <th>Maximum Storage Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($paddies->count() == 0)
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No paddies found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($paddies as $paddy)
                        <tr>
                            <td>{{ $paddy->paddy_type->name }}</td>
                            <td>{{ $paddy->user->name }}</td>
                            <td>{{ $paddy->bag_quantity }} bags</td>
                            <td>{{ $paddy->moisture_content }}%</td>
                            <td>{{ $paddy->storage_start }}</td>
                            <td>{{ $paddy->storage_end }}</td>
                            <td>{{ $paddy->maximum_storage_duration }}</td>
                            <td>
                                <span class="btn btn-primary">
                                    <a class="text-white" href="{{ route('admin.paddies.edit', $paddy->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </span>
                                <form action="{{ route('admin.paddies.destroy', $paddy->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this paddy?')">
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