@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Roles Create')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Roles > Create</h6>
</div>

<div class="mb-4">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Create New Role</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                <div class="mb-2">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                @error('name')
                    <div class="text-danger my-1">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary mt-2">Create</button>
            </form>
        </div>
    </div>
</div>

@endsection