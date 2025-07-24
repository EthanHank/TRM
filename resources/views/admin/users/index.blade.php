@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Users Management')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Users</h6>
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
<div class="d-flex justify-content-start mb-4">
    <a href="{{ route('admin.users.create') }}" class="btn btn-success"> + Add User</a>
</div>
<div class="row mb-3">
    <div class="col-md-6 offset-md-6">
        <form method="GET" action="{{ route('admin.users.index') }}" class="input-group">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search users by name, email or role..."
                value="{{ request('search') }}"
                aria-label="Search users">
            <button class="btn btn-search me-2" type="submit">
                <i class="bi bi-search"></i> Search
            </button>
        </form>
    </div>
</div>
<!-- Users Table -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Current Users</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Is Opened</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->count() == 0)
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No users found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($users as $user)
                        <tr class="text-center align-middle">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->is_opened == 1)
                                <span class="badge bg-success">Yes</span>
                                @else
                                <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            <td>
                                @if($user->roles->count() > 0)
                                {{ $user->roles->pluck('name')->implode(', ') }}
                                @else
                                <span class="text-muted">No role assigned</span>
                                @endif
                            </td>
                            <td>
                                @if($user->status == 1)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <span class="btn btn-primary mb-1">
                                    <a class="text-white" href="{{ route('admin.users.edit', $user->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </span>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this user?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                <span class="btn btn-secondary">
                                    <a href="{{ route('admin.users.changeStatus', $user->id) }}" class="text-white"><i class="bi bi-toggle-on"></i></a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                @if($users->hasPages())
                {{ $users->links('vendor.pagination.custom-pagination') }}
                @else
                <small class="text-muted">Showing all results ({{ $users->total() }} total)</small>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection