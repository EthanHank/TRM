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
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.users.create') }}" class="btn btn-success"> + Add User</a>
</div>
<!-- Roles Table -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Current Users</h5>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->count() == 0)
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No users found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($users as $user)
                        <tr>
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
                                <span class="btn btn-primary">
                                    <a class="text-white" href="{{ route('admin.users.edit', $user->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </span>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
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