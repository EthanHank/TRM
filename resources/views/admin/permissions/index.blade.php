@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Permissions Management')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Permissions</h6>
</div>
@if (session('permission-created'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('permission-created') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.permissions.create') }}" class="btn btn-success"> + Add Permission</a>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($permissions->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No permissions found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->category }}</td>
                            <td>{{ $permission->created_at }}</td>
                            <td>{{ $permission->updated_at }}</td>
                            <td>
                                <span class="btn btn-primary">
                                    <a class="text-white" href="{{ route('admin.permissions.edit', $permission->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </span>
                                <span class="btn btn-danger">
                                    <a class="text-white" href="#">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection