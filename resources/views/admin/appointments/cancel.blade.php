@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Cancel Appointment</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        You are about to cancel this appointment. This action will send a cancellation notification to the merchant.
                    </div>

                    <div class="mb-4">
                        <h5>Appointment Details</h5>
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
                                    <td>{{ $appointment->appointment_start_date ? \Carbon\Carbon::parse($appointment->appointment_start_date)->format('F j, Y') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>End Date</th>
                                    <td>{{ $appointment->appointment_end_date ? \Carbon\Carbon::parse($appointment->appointment_end_date)->format('F j, Y') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Bag Quantity</th>
                                    <td>{{ $appointment->bag_quantity }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $appointment->status }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3">
                            <label for="cancel_reason" class="form-label">Cancellation Reason <span class="text-danger">*</span></label>
                            <textarea
                                class="form-control @error('cancel_reason') is-invalid @enderror"
                                id="cancel_reason"
                                name="cancel_reason"
                                rows="5"
                                placeholder="Please provide a detailed reason for cancelling this appointment. This will be sent to the merchant."
                            >{{ old('cancel_reason') }}</textarea>
                            @error('cancel_reason')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                <i class="fas fa-times-circle me-1"></i> Cancel Appointment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
