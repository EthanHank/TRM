@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Paddy Types Update')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Results > Update</h6>
</div>
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.results.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Results
    </a>
</div>
<div class="mb-4">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">
                Update Result
                (<span class="text-primary"># {{ $result->id }}</span>)
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.results.update', $result) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <i class="bi bi-backpack4-fill"></i> Paddy Type: {{ $result->milling->appointment->paddy->paddy_type->name }}
                </div>
                <div class="mb-3">
                    <i class="bi bi-boxes"></i> Result Type: {{ $result->result_type->name }}
                </div>
                <div class="mb-3">
                    <i class="bi bi-person-square"></i> Username: {{ $result->user->name }}
                </div>
                <div class="mb-2">
                    <label for="bag_quantity" class="form-label">Bag Quantity</label>
                    <input type="text" class="form-control" id="bag_quantity" name="bag_quantity" value="{{ $result->bag_quantity }}">
                    @error('bag_quantity')
                    <div class="text-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection