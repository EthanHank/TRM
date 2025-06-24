@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Users Create')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Users > Create</h6>
</div>

<div class="mb-4">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Create New User</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST" class="row">
                @csrf
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" class="form-control" id="name" name="name">
                    @error('name')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name">
                    @error('full_name')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                    @error('phone')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                    @error('email')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nrc" class="form-label">NRC</label>
                    <input type="text" class="form-control" id="nrc" name="nrc">
                    @error('nrc')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    @error('gender')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="text" class="form-control flatpickr" id="date_of_birth" name="date_of_birth" placeholder="Select date of birth">
                    @error('date_of_birth')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="is_opened" class="form-label">Is Opened</label>
                    <select class="form-select" id="is_opened" name="is_opened">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    @error('is_opened')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select select2" id="role" name="role[]" multiple>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                    @error('address')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-start gap-2 mt-3">
                    <button type="submit" class="btn btn-primary col-md-6">Create</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary col-md-6">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection