@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Roles Management')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Roles</h6>
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
@if(Auth::user()->hasPermissionTo('create-role'))
<div class="d-flex justify-content-start mb-4">
    <a href="{{ route('admin.roles.create') }}" class="btn btn-success"> + Add Role</a>
</div>
@endif
<div class="row mb-3">
    <div class="col-md-6 offset-md-6">
        <form method="GET" action="{{ route('admin.roles.index') }}" class="input-group">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search roles by name..."
                value="{{ request('search') }}"
                aria-label="Search roles"
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
            <h5 class="card-title mb-0">Current Roles</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            @if (Auth::user()->hasPermissionTo('edit-role') || Auth::user()->hasPermissionTo('delete-role'))
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($roles->count() == 0)
                        <tr>
                            <td colspan="{{ Auth::user()->hasPermissionTo('edit-role') || Auth::user()->hasPermissionTo('delete-role') ? 4 : 3 }}" class="text-center text-muted py-4">No roles found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($roles as $role)
                        <tr class="text-center align-middle">
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
                            <!-- Action buttons for editing and deleting roles -->
                            @if (Auth::user()->hasPermissionTo('edit-role') || Auth::user()->hasPermissionTo('delete-role'))
                            <td>
                                @if(Auth::user()->hasPermissionTo('edit-role'))
                                <span class="btn btn-primary mb-1">
                                    <a class="text-white" href="{{ route('admin.roles.edit', $role->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </span>
                                @endif
                                @if(Auth::user()->hasPermissionTo('delete-role'))
                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this role?')">
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
                    @if($roles->hasPages())
                        {{ $roles->links('vendor.pagination.custom-pagination') }}
                    @else
                        <small class="text-muted">Showing all results ({{ $roles->total() }} total)</small>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection