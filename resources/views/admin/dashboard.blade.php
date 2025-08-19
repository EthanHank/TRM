@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Admin Dashboard')

@section('content')
    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Our Merchants</h6>
                            <h3 class="mb-0">{{ $merchantCount }}</h3>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Appointments</h6>
                            <h3 class="mb-0">{{ $appointmentCount }}</h3>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Paddy Quantity (bags)</h6>
                            <h3 class="mb-0">{{ number_format($totalPaddyWeight, 2) }}</h3>
                        </div>
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-inbox"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports -->
    <div class="card">
        <div class="card-header bg-white">
            <ul class="nav nav-tabs card-header-tabs" id="reportsTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="overall-performance-tab" data-bs-toggle="tab" data-bs-target="#overall-performance" type="button" role="tab" aria-controls="overall-performance" aria-selected="true">Overall Performance</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="paddy-type-performance-tab" data-bs-toggle="tab" data-bs-target="#paddy-type-performance" type="button" role="tab" aria-controls="paddy-type-performance" aria-selected="false">Paddy Type Performance</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="merchant-activity-tab" data-bs-toggle="tab" data-bs-target="#merchant-activity" type="button" role="tab" aria-controls="merchant-activity" aria-selected="false">Merchant Activity</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="milling-prediction-accuracy-tab" data-bs-toggle="tab" data-bs-target="#milling-prediction-accuracy" type="button" role="tab" aria-controls="milling-prediction-accuracy" aria-selected="false">Milling Prediction Accuracy</button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="reportsTabContent">
                <div class="tab-pane fade show active" id="overall-performance" role="tabpanel" aria-labelledby="overall-performance-tab">
                    <a href="{{ route('admin.reports.overall_performance.pdf') }}" class="btn btn-primary mb-3 btn-sm">Export to <i class="bi bi-filetype-pdf"></i></a>
                    @include('admin.reports.overall_performance', ['data' => $overallPerformance])
                </div>
                <div class="tab-pane fade" id="paddy-type-performance" role="tabpanel" aria-labelledby="paddy-type-performance-tab">
                    <a href="{{ route('admin.reports.paddy_type_performance.pdf') }}" class="btn btn-primary btn-sm mb-3">Export to <i class="bi bi-filetype-pdf"></i></a>
                    @include('admin.reports.paddy_type_performance', ['paddyTypePerformance' => $paddyTypePerformance])
                </div>
                <div class="tab-pane fade" id="merchant-activity" role="tabpanel" aria-labelledby="merchant-activity-tab">
                    <a href="{{ route('admin.reports.merchant_activity.pdf') }}" class="btn btn-primary btn-sm mb-3">Export to <i class="bi bi-filetype-pdf"></i></a>
                    @include('admin.reports.merchant_activity', ['merchantActivity' => $merchantActivity])
                </div>
                <div class="tab-pane fade" id="milling-prediction-accuracy" role="tabpanel" aria-labelledby="milling-prediction-accuracy-tab">
                    <a href="{{ route('admin.reports.milling_prediction_accuracy.pdf') }}" class="btn btn-primary btn-sm mb-3">Export to <i class="bi bi-filetype-pdf"></i></a>
                    @include('admin.reports.milling_prediction_accuracy', ['millingPredictionAccuracy' => $millingPredictionAccuracy])
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        // Tab persistence with URL parameters
        var url = new URL(window.location.href);
        var activeTab = url.searchParams.get("tab");
        if(activeTab){
            $('#reportsTab button[data-bs-target="#' + activeTab + '"]').tab('show');
        }

        $('button[data-bs-toggle="tab"]').on('click', function(e) {
            e.preventDefault();
            var tab = $(this).attr('data-bs-target').substring(1);
            var url = new URL(window.location.href);
            url.searchParams.set("tab", tab);
            // Clear other page parameters
            url.searchParams.delete('paddy_type_page');
            url.searchParams.delete('merchant_page');
            url.searchParams.delete('milling_accuracy_page');
            window.location.href = url.href;
        });
    });
</script>
@endpush
