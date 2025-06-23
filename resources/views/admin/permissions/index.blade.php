@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Permissions Management')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Permissions</h6>
</div>

<!-- Roles Table -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Current Permissions</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($permissions->count() == 0)
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No permissions found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->category }}</td>
                            <td>{{ $permission->created_at->format('d-m-Y H:i:s') }}</td>
                            <td>{{ $permission->updated_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                    @if($permissions->hasPages())
                        {{ $permissions->links('vendor.pagination.custom-pagination') }}
                    @else
                        <small class="text-muted">Showing all results ({{ $permissions->total() }} total)</small>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection