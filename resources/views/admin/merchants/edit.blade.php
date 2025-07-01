@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Merchants Management')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Merchants > Confirm</h6>
</div>
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.merchants.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Merchants
    </a>
</div>
<div class="mb-4">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">
                Update Merchants 
                (<span class="text-primary">{{ $merchant->name }}</span>)
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.merchants.update', $merchant) }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password', $merchant->password) }}">
                    @error('password')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="role" class="form-label">Roles</label>
                    <select class="form-select select2" id="role" name="roles[]" multiple>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $merchant->roles->pluck('id')->contains($role->id) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('roles')
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
@endsection