@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Make Milling</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        You are about to make the milling process. This action will send a milling notification to the merchant.
                    </div>

                    <div class="mb-4">
                        <h5>Milling Details</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Appointment Type</th>
                                    <td>{{ $appointment->appointment_type->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Paddy Type</th>
                                    <td>{{ $appointment->paddy->paddy_type->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Merchant</th>
                                    <td>{{ $appointment->paddy->user->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Start Date</th>
                                    <td>{{ date('Y-m-d') }}</td>
                                </tr>
                                <tr>
                                    <th>Bag Quantity</th>
                                    <td>{{ $appointment->bag_quantity }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>In Progress</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <form action="{{ route('admin.millings.store') }}" method="POST">
                        @csrf
                        <input type="text" name="appointment_id" value="{{ $appointment->id }}" hidden>
                        <button type="submit" class="btn btn-success">Start Milling</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection