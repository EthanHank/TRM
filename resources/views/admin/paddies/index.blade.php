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
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(Auth::user()->hasPermissionTo('create-paddy'))
<div class="d-flex justify-content-start mb-4">
    <a href="{{ route('admin.paddies.create') }}" class="btn btn-success"> + Add Paddy</a>
</div>
@endif
<!-- Search for paddies by name. -->
<div class="row mb-3">
    <div class="col-md-6 offset-md-6">
        <form method="GET" action="{{ route('admin.paddies.index') }}" class="input-group">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search paddies by type, merchant, moisture or duration..."
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
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Current Paddies</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>Paddy Type</th>
                            <th>Merchant</th>
                            <th>Bag Quantity</th>
                            <th>Bag Weight</th>
                            <th>Total Weight</th>
                            <th>Moisture Content</th>
                            <th>Storage Start</th>
                            <th>Storage End</th>
                            <th>Maximum Storage Duration</th>
                            @if(Auth::user()->hasPermissionTo('edit-paddy') || Auth::user()->hasPermissionTo('delete-paddy'))
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($paddies->count() == 0)
                        <tr>
                            <td colspan="{{ Auth::user()->hasPermissionTo('edit-paddy') || Auth::user()->hasPermissionTo('delete-paddy') ? 10 : 9 }}" class="text-center text-muted py-4">No paddies found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($paddies as $paddy)
                        <tr class="text-center align-middle">
                            <td>{{ $paddy->paddy_type ? $paddy->paddy_type->name : 'Deleted Paddy Type' }}</td>
                            <td>{{ $paddy->user ? $paddy->user->name : '[Deleted User]' }}</td>
                            <td>{{ $paddy->bag_quantity }} bags</td>
                            <td>{{ $paddy->bag_weight }} kg</td>
                            <td>{{ $paddy->total_bag_weight }} kg</td>
                            <td>{{ $paddy->moisture_content }}%</td>
                            <td>{{ $paddy->storage_start_date }}</td>
                            <td>{{ $paddy->storage_end_date }}</td>
                            <td>{{ $paddy->maximum_storage_duration }}</td>
                            @if(Auth::user()->hasPermissionTo('edit-paddy') || Auth::user()->hasPermissionTo('delete-paddy'))
                            <td>
                                @if(Auth::user()->hasPermissionTo('edit-paddy'))
                                <span class="btn btn-primary mb-1">
                                    <a class="text-white" href="{{ route('admin.paddies.edit', $paddy->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </span>
                                @endif
                                @if(Auth::user()->hasPermissionTo('delete-paddy'))
                                <form action="{{ route('admin.paddies.destroy', $paddy->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this paddy?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                            @endif
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