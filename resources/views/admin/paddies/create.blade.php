@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Paddies Create')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Paddies > Create</h6>
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
            <h5 class="card-title mb-0">Create New Paddy</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.paddies.store') }}" method="POST" class="row">
                @csrf
                <div class="col-md-6 mb-3">
                    <label for="paddy_type" class="form-label">Paddy Type</label>
                    <select class="form-select select2" id="paddy_type" name="paddy_type_id">
                        @foreach ($paddy_types as $paddy_type)
                            <option value="{{ $paddy_type->id }}">{{ $paddy_type->name }}</option>
                        @endforeach
                    </select>
                    @error('paddy_type_id')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="user" class="form-label">Merchant</label>
                    <select class="form-select select2" id="user" name="user_id">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="bag_quantity" class="form-label">Bag Quantity</label>
                    <input type="text" class="form-control" id="bag_quantity" name="bag_quantity" placeholder="Enter bag quantity">
                    @error('bag_quantity')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="moisture_content" class="form-label">Moisture Content</label>
                    <input type="text" class="form-control" id="moisture_content" name="moisture_content" placeholder="Enter moisture content">
                    @error('moisture_content')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-start gap-2 mt-3">
                    <button type="submit" class="btn btn-primary col-md-6">Create</button>
                    <a href="{{ route('admin.paddies.index') }}" class="btn btn-outline-secondary col-md-6">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection