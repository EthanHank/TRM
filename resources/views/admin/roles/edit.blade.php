@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Roles Update')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Roles > Update</h6>
</div>
<a href="{{ route('admin.roles.index') }}" class="btn btn-secondary mb-4">
    <i class="bi bi-arrow-left"></i> Back to Roles
</a>
<div class="mb-4">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Update Role</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}">
                </div>
                @error('name')
                    <div class="text-danger my-1">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </form>
        </div>
    </div>
</div>
<div class="mb-4">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Current Permissions for <span class="text-primary">{{ $role->name }}</span></h5>
        </div>
        <div class="card-body">
            @if ($role->permissions->count() > 0)
                <div class="d-flex align-items-center mb-2">
                @foreach ($role->permissions as $permission)
                    <form class="m-2 d-flex align-items-center" action="{{ route('admin.roles.permissions.revoke', [$role->id, $permission->id]) }}" method="POST" style="display:inline;" onclick="return confirm('Are you sure you want to revoke this permission?')">
                        @csrf
                        @method('DELETE')
                        <label for="permission_{{ $permission->id }}" class="border p-1 border-end-0">{{ $permission->name }}</label>
                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-x-circle"></i></button>
                    </form>
                
                @endforeach
                </div>
            @else
            <p class="text-muted">No permissions found for this role.</p>
            @endif
            @if (session('revoke_success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('revoke_success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="mb-4">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Assign Permissions to <span class="text-primary">{{ $role->name }}</span></h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.roles.permissions.assign', $role->id) }}" method="POST" class="row p-2">
                @csrf
                @if ($permissions->count() > 0)
                    @foreach ($permissions as $permission)
                        <div class="form-check col-md-3 mb-2">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                            <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No permissions found to assign.</p>
                @endif
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <button type="submit" class="btn btn-success mt-2 col-md-3 offset-md-9">Assign Permissions</button>
            </form>
        </div>
    </div>
</div>

@endsection