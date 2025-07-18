@extends('layouts.user')

@section('title', 'Paddy Details')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4" data-aos="fade-down">Paddy Details</h2>
    <div class="card mb-4 shadow-sm" data-aos="fade-up">
        <div class="card-body">
            <h5 class="card-title">Paddy #{{ $paddy->id }}</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Type:</strong> {{ $paddy->paddy_type->name ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>Bag Quantity:</strong> {{ $paddy->bag_quantity }}</li>
                <li class="list-group-item"><strong>Bag Weight (kg):</strong> {{ $paddy->bag_weight ?? '-' }}</li>
                <li class="list-group-item"><strong>Total Bag Weight (kg):</strong> {{ $paddy->total_bag_weight ?? '-' }}</li>
                <li class="list-group-item"><strong>Moisture Content:</strong> {{ $paddy->moisture_content }}%</li>
                <li class="list-group-item"><strong>Storage Start Date:</strong> {{ $paddy->storage_start_date }}</li>
                <li class="list-group-item"><strong>Storage End Date:</strong> {{ $paddy->storage_end_date }}</li>
                <li class="list-group-item"><strong>Maximum Storage Duration:</strong> {{ $paddy->maximum_storage_duration }}</li>
            </ul>
        </div>
    </div>

    <h4 class="mb-3" id="drying-history" data-aos="fade-right">Drying Result Calculation History</h4>
    @if($dryingResults->isEmpty())
        <div class="alert alert-info">No drying result calculations found.</div>
    @else
        <div class="row">
            @foreach($dryingResults as $result)
                <div class="col-md-6 mb-4" data-aos="fade-up">
                    <div class="card shadow-sm border-0 fade-in-result" style="max-width: 500px; margin: 0 auto; position: relative;">
                        <form action="{{ route('users.drying_result_calculations.destroy', $result->id) }}" method="POST" style="position: absolute; top: 10px; right: 10px; z-index: 2;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this calculation result?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        <div class="card-body">
                            <h5 class="card-title mb-3 text-center" style="color: #667eea;">
                                <i class="bi bi-calculator"></i> Calculation Result
                            </h5>
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-droplet-half me-2 text-primary"></i>Initial Moisture</span>
                                    <span class="fw-bold">{{ $result->initial_moisture_content }}%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-droplet-fill me-2 text-info"></i>Final Moisture</span>
                                    <span class="fw-bold">{{ $result->final_moisture_content }}%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-box-seam me-2 text-success"></i>Initial Bags</span>
                                    <span class="fw-bold">{{ $result->initial_bag_quantity }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-arrow-down-circle me-2 text-danger"></i>Approximate Loss</span>
                                    <span class="fw-bold text-danger">{{ $result->approximate_loss }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-box2-heart me-2 text-warning"></i>Final Bags</span>
                                    <span class="fw-bold text-success">{{ $result->final_bag_quantity }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-bag me-2" style="color: deeppink;"></i>Initial Total Bag Weight (kg)</span>
                                    <span class="fw-bold">{{ $result->initial_total_bag_weight }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-bag-check me-2" style="color: darkblue;"></i>Final Total Bag Weight (kg)</span>
                                    <span class="fw-bold">{{ $result->final_total_bag_weight }}</span>
                                </li>
                            </ul>
                            <div class="text-center mt-2">
                                <span class="badge rounded-pill bg-primary">{{ $result->created_at->format('Y-m-d H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $dryingResults->appends(request()->except('page'))->links('vendor.pagination.bootstrap-4') }}
        </div>
    @endif
    <div class="mt-4">
        <a href="{{ route('users.paddies.index') }}" class="btn btn-outline-dark">Back to Paddies</a>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add hash if missing and page param exists
    if (!window.location.hash && window.location.search.includes('page=')) {
        window.location.hash = '#drying-history';
    }
    if (window.location.hash === '#drying-history') {
        var el = document.getElementById('drying-history');
        if (el) {
            setTimeout(function() {
                var yOffset = -80;
                var y = el.getBoundingClientRect().top + window.pageYOffset + yOffset;
                window.scrollTo({ top: y, behavior: 'smooth' });
            }, 300);
        }
    }
});
</script>
@endsection 