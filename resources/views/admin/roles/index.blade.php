@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Roles Management')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Roles</h6>
</div>
@if (session('role-created'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('role-created') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.roles.create') }}" class="btn btn-success"> + Add Role</a>
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
                        <tr>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($roles->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No roles found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
                            <td>
                                <span class="btn btn-primary">
                                    <a class="text-white" href="#">
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