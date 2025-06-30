@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Merchants Management')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Merchants</h6>
</div>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<!-- Roles Table -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Pending Merchants</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Is Opened</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($merchants->count() == 0)
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No merchants found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($merchants as $merchant)
                        <tr>
                            <td>{{ $merchant->name }}</td>
                            <td>{{ $merchant->email }}</td>
                            <td>
                                @if($merchant->is_opened == 1)
                                    <span class="badge bg-success">Confirmed</span>
                                @else
                                    <span class="badge bg-danger">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if($merchant->roles->count() > 0)
                                    {{ $merchant->roles->pluck('name')->implode(', ') }}
                                @else
                                    <span class="text-muted">No role assigned</span>
                                @endif
                            </td>
                            <td>
                                @if($merchant->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <span class="btn btn-primary">
                                    <a class="text-white" href="{{ route('admin.merchants.edit', $merchant->id) }}">
                                        <i class="bi bi-person-fill-check"></i>
                                    </a>
                                </span>
                                <form action="{{ route('admin.merchants.destroy', $merchant->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
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
                    @if($merchants->hasPages())
                        {{ $merchants->links('vendor.pagination.custom-pagination') }}
                    @else
                        <small class="text-muted">Showing all results ({{ $merchants->total() }} total)</small>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection