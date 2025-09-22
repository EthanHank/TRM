@extends('layouts.user')

@section('title', 'Tun Rice Milling - Drying Result Calculation')

@section('content')
<div>
    <h6 class="text-muted mb-4" data-aos="fade-right">User &gt; My Paddies &gt; Drying Result Calculation</h6>
</div>

@if(session('dryingResult') && !session('success'))
    @php
        $dryingResult = session('dryingResult');
    @endphp
    <div class="mt-5 fade-in-result" data-aos="fade-up">
        <div class="card shadow-sm border-0" style="max-width: 500px; margin: 0 auto;">
            <div class="card-body">
                <h4 class="card-title mb-4 text-center" style="color: #667eea;">
                    <i class="bi bi-calculator"></i> Calculation Result
                </h4>
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-droplet-half me-2 text-primary"></i>Initial Moisture</span>
                        <span class="fw-bold">{{ $dryingResult->initial_moisture_content }}%</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-droplet-fill me-2 text-info"></i>Final Moisture</span>
                        <span class="fw-bold">{{ $dryingResult->final_moisture_content }}%</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-box-seam me-2 text-success"></i>Initial Bags</span>
                        <span class="fw-bold">{{ $dryingResult->initial_bag_quantity }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-arrow-down-circle me-2 text-danger"></i>Approximate Loss</span>
                        <span class="fw-bold text-danger">{{ $dryingResult->approximate_loss }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-box2-heart me-2 text-warning"></i>Final Bags</span>
                        <span class="fw-bold text-success">{{ $dryingResult->final_bag_quantity }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-bag me-2" style="color: deeppink;"></i>Initial Total Bag Weight (kg)</span>
                        <span class="fw-bold">{{ $dryingResult->initial_total_bag_weight }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-bag-check me-2" style="color: darkblue;"></i>Final Total Bag Weight (kg)</span>
                        <span class="fw-bold">{{ $dryingResult->final_total_bag_weight }}</span>
                    </li>
                </ul>
                <div class="text-center mt-3">
                    <form method="POST" action="{{ route('users.drying_result_calculations.store') }}">
                        @csrf
                        <input type="hidden" name="paddy_id" value="{{ $dryingResult->paddy_id }}">
                        <input type="hidden" name="initial_moisture_content" value="{{ $dryingResult->initial_moisture_content }}">
                        <input type="hidden" name="final_moisture_content" value="{{ $dryingResult->final_moisture_content }}">
                        <input type="hidden" name="initial_bag_quantity" value="{{ $dryingResult->initial_bag_quantity }}">
                        <input type="hidden" name="initial_total_bag_weight" value="{{ $dryingResult->initial_total_bag_weight }}">
                        <input type="hidden" name="final_total_bag_weight" value="{{ $dryingResult->final_total_bag_weight }}">
                        <button type="submit" class="btn btn-primary">Save Result</button>
                        <a href="{{ route('users.drying_result_calculations.edit', $dryingResult->paddy_id) }}" class="btn btn-outline-danger ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="container mt-5" data-aos="fade-up">
    <h4 class="mb-3" data-aos="fade-down">Calculate Drying Result</h4>
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
    <form method="POST" action="{{ route('users.drying_result_calculations.calculate') }}">
        @method('POST')
        @csrf
        <input type="hidden" name="paddy_id" value="{{ old('paddy_id', $paddy->id ?? '') }}">
        <div class="mb-3">
            <label for="initial_moisture_content" class="form-label">Initial Moisture Content (%)</label>
            <input type="text" class="form-control" id="initial_moisture_content" name="initial_moisture_content" value="{{ old('initial_moisture_content', $paddy->moisture_content ?? '') }}" required readonly>
        </div>
        <div class="mb-3">
            <label for="final_moisture_content" class="form-label">Final Moisture Content (%)</label>
            <input type="text" class="form-control" id="final_moisture_content" name="final_moisture_content" value="{{ old('final_moisture_content', '14') }}">
        </div>
        <div class="mb-3">
            <label for="initial_bag_quantity" class="form-label">Initial Bag Quantity</label>
            <input type="text" class="form-control" id="initial_bag_quantity" name="initial_bag_quantity" value="{{ old('initial_bag_quantity', $paddy->bag_quantity ?? '') }}">
        </div>
        <button type="submit" class="btn btn-primary">Calculate</button>
        <a href="{{ route('users.paddies.index') }}" class="btn btn-outline-dark">Back to Paddies</a>
    </form>
</div>
@endsection
