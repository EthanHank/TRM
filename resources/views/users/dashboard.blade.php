@extends('layouts.user')

@section('header')
    User Dashboard
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm mb-4" data-aos="fade-up">
            <div class="card-body">
                <h4 class="card-title mb-3" data-aos="fade-down">Welcome, {{ Auth::user()->name }}!</h4>
                <p class="card-text text-muted">Here is a summary of your activity.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card stat-card mb-4" data-aos="fade-right">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Paddy Enrolled (bags)</h6>
                        <h3 class="mb-0">{{ number_format($totalPaddySupplied, 2) }}</h3>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-inbox"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card stat-card mb-4" data-aos="fade-left">
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
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card" data-aos="fade-down">
            <div class="card-header bg-white">
                <ul class="nav nav-tabs card-header-tabs" id="reportsTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="appointment-history-tab" data-bs-toggle="tab" data-bs-target="#appointment-history" type="button" role="tab" aria-controls="appointment-history" aria-selected="true">Appointment History</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="paddy-processing-tab" data-bs-toggle="tab" data-bs-target="#paddy-processing" type="button" role="tab" aria-controls="paddy-processing" aria-selected="false">Paddy Processing</button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="reportsTabContent">
                    <div class="tab-pane fade show active" id="appointment-history" role="tabpanel" aria-labelledby="appointment-history-tab">
                        <a href="{{ route('users.reports.appointment_history.pdf') }}" class="btn btn-primary btn-sm mb-3">Export to <i class="bi bi-filetype-pdf"></i></a>
                        @include('users.reports.appointment_history', ['appointmentHistory' => $appointmentHistory])
                    </div>
                    <div class="tab-pane fade" id="paddy-processing" role="tabpanel" aria-labelledby="paddy-processing-tab">
                        <a href="{{ route('users.reports.paddy_processing.pdf') }}" class="btn btn-primary btn-sm mb-3">Export to <i class="bi bi-filetype-pdf"></i></a>
                        @include('users.reports.paddy_processing', ['paddyProcessing' => $paddyProcessing])
                    </div>
                </div>
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
            url.searchParams.delete('appointment_history_page');
            url.searchParams.delete('paddy_processing_page');
            window.location.href = url.href;
        });
    });
</script>
@endpush
