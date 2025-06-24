@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Users Update')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Users > Update</h6>
</div>
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Users
    </a>
</div>
<div class="mb-4">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">
                Update User 
                (<span class="text-primary">{{ $user->name }}</span>)
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                    @error('name')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}">
                    @error('full_name')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                    @error('phone')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                    @error('email')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nrc" class="form-label">NRC</label>
                    <input type="text" class="form-control" id="nrc" name="nrc" value="{{ old('nrc', $user->nrc) }}">
                    @error('nrc')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender">
                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="text" class="form-control flatpickr" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}" placeholder="Select date of birth">
                    @error('date_of_birth')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $user->address) }}</textarea>
                    @error('address')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-start gap-2 mt-3">
                    <button type="submit" class="btn btn-primary col-md-6">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="mb-4">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Current Roles for <span class="text-primary">{{ $user->name }}</span></h5>
        </div>
        <div class="card-body">
            @if ($user->roles->count() > 0)
                <div class="d-flex flex-wrap gap-2 mb-2">
                @foreach ($user->roles as $role)
                    <form action="{{ route('admin.users.roles.revoke', [$user->id, $role->id]) }}" method="POST" class="position-relative" style="display:inline;" onsubmit="return confirm('Are you sure you want to revoke this role?')">
                        @csrf
                        @method('DELETE')
                        <span class="badge bg-danger px-3 py-2 d-flex align-items-center" style="font-size:1rem; font-weight:500;">
                            {{ $role->name }}
                            <button type="submit" class="btn btn-sm btn-link text-white ms-2 p-0" style="line-height:1;" title="Revoke Role">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </span>
                    </form>
                @endforeach
                </div>
            @else
            <p class="text-muted">No roles found for this user.</p>
            @endif
            @if (session('revoke_success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('revoke_success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
    </div>
    <p class="text-muted m-1 small">Roles can be revoked by clicking the <i class="text-danger bi bi-x-circle-fill"></i> button.</p>
</div>
<div class="mb-4">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Assign Roles to <span class="text-primary">{{ $user->name }}</span></h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.roles.assign', $user->id) }}" method="POST" class="row p-2">
                @csrf
                @if ($roles->count() > 0)
                    @foreach ($roles as $role)
                        <div class="form-check col-md-3 mb-2">
                            <input class="form-check-input" type="checkbox" name="role[]" value="{{ $role->id }}" id="role_{{ $role->id }}">
                            <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-success my-2 col-md-3 offset-md-9">Assign Roles</button>
                @else
                    <p class="text-muted">No roles found to assign.</p>
                @endif
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
            </form>
        </div>
    </div>
</div>

@endsection