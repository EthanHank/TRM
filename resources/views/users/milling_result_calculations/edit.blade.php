@extends('layouts.user')

@section('title', 'Tun Rice Milling - Milling Result Calculation')

@section('content')
<div>
    <h6 class="text-muted mb-4" data-aos="fade-right">User &gt; My Paddies &gt; Milling Result Calculation</h6>
</div>

@if(session('millingResult') && !session('success'))
    @php
        $millingResult = session('millingResult');
    @endphp
    <div class="mt-5 fade-in-result" data-aos="fade-up">
        <div class="card shadow-sm border-0" style="max-width: 500px; margin: 0 auto;">
            <div class="card-body">
                <h4 class="card-title mb-4 text-center" style="color: #667eea;">
                    <i class="bi bi-calculator"></i> Milling Calculation Result
                </h4>
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-droplet-half me-2 text-primary"></i>Initial Moisture</span>
                        <span class="fw-bold">{{ $millingResult->initial_moisture_content }}%</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-droplet-fill me-2 text-info"></i>Final Moisture</span>
                        <span class="fw-bold">{{ $millingResult->final_moisture_content }}%</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-box-seam me-2 text-success"></i>Initial Bags</span>
                        <span class="fw-bold">{{ $millingResult->initial_bag_quantity }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-bag me-2 text-secondary"></i>Adjusted Weight (kg)</span>
                        <span class="fw-bold">{{ $millingResult->adjusted_weight }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-box2-heart me-2 text-warning"></i>White Rice (bags)</span>
                        <span class="fw-bold">{{ $millingResult->white_rice_bags }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-box2-heart me-2 text-danger"></i>Broken Rice (bags)</span>
                        <span class="fw-bold">{{ $millingResult->broken_rice_bags }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-box2-heart me-2 text-info"></i>Bran (bags)</span>
                        <span class="fw-bold">{{ $millingResult->bran_bags }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-box2-heart me-2 text-dark"></i>Husk (bags)</span>
                        <span class="fw-bold">{{ $millingResult->husk_bags }}</span>
                    </li>
                </ul>
                <div class="text-center mt-3">
                    <form method="POST" action="{{ route('users.milling_result_calculations.store') }}">
                        @csrf
                        <input type="hidden" name="paddy_id" value="{{ $millingResult->paddy_id }}">
                        <input type="hidden" name="initial_moisture_content" value="{{ $millingResult->initial_moisture_content }}">
                        <input type="hidden" name="final_moisture_content" value="{{ $millingResult->final_moisture_content }}">
                        <input type="hidden" name="initial_bag_quantity" value="{{ $millingResult->initial_bag_quantity }}">
                        <input type="hidden" name="adjusted_weight" value="{{ $millingResult->adjusted_weight }}">
                        <input type="hidden" name="white_rice_bags" value="{{ $millingResult->white_rice_bags }}">
                        <input type="hidden" name="broken_rice_bags" value="{{ $millingResult->broken_rice_bags }}">
                        <input type="hidden" name="bran_bags" value="{{ $millingResult->bran_bags }}">
                        <input type="hidden" name="husk_bags" value="{{ $millingResult->husk_bags }}">
                        <button type="submit" class="btn btn-primary">Save Result</button>
                        <a href="{{ route('users.milling_result_calculations.edit', $millingResult->paddy_id) }}" class="btn btn-outline-danger ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="container mt-5" data-aos="fade-up">
    <h4 class="mb-3" data-aos="fade-down">Calculate Milling Result</h4>
    @if(session('success')) 
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('users.milling_result_calculations.calculate') }}">
        @csrf
        <input type="hidden" name="paddy_id" value="{{ old('paddy_id', $paddy->id ?? '') }}">
        <div class="mb-3">
            <label for="initial_moisture_content" class="form-label">Initial Moisture Content (%)</label>
            <input type="text" class="form-control" id="initial_moisture_content" name="initial_moisture_content" value="{{ old('initial_moisture_content', $paddy->moisture_content ?? '') }}" required readonly>
        </div>
        <div class="mb-3">
            <label for="final_moisture_content" class="form-label">Final Moisture Content (%)</label>
            <input type="text" class="form-control" id="final_moisture_content" name="final_moisture_content" value="{{ old('final_moisture_content', '14') }}" required readonly>
        </div>
        <div class="mb-3">
            <label for="initial_bag_quantity" class="form-label">Initial Bag Quantity</label>
            <input type="text" class="form-control" id="initial_bag_quantity" name="initial_bag_quantity" value="{{ old('initial_bag_quantity', $paddy->bag_quantity ?? '') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Calculate</button>
        <a href="{{ route('users.paddies.index') }}" class="btn btn-outline-dark">Back to Paddies</a>
    </form>
</div>
@endsection
