@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Permissions Update')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Permissions > Update</h6>
</div>

<div class="mb-4">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Update Permission</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}">
                </div>
                @error('name')
                    <div class="text-danger my-1">{{ $message }}</div>
                @enderror
                <div class="mb-2">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="category" name="category" value="{{ $permission->category }}">
                </div>
                @error('category')
                    <div class="text-danger my-1">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary mt-2 me-1">Update</button>
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary mt-2">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</div>

@endsection