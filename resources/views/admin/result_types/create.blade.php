@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Result Types Create')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Result Types > Create</h6>
</div>
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="mb-4">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Create New Result Type</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.result_types.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                    @error('name')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                    @error('description')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-2 me-1">Create</button>
                <a href="{{ route('admin.result_types.index') }}" class="btn btn-outline-secondary mt-2">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</div>

@endsection