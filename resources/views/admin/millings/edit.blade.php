@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Mark as Completed</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        You are about to mark as completed the milling process. This action will send a milling notification to the merchant.
                    </div>

                    <div class="mb-4">
                        <h5>Milling Details</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Appointment Type</th>
                                    <td>{{ $milling->appointment->appointment_type->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Paddy Type</th>
                                    <td>{{ $milling->appointment->paddy->paddy_type->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Merchant</th>
                                    <td>{{ $milling->appointment->paddy->user->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Start Date</th>
                                    <td>{{ $milling->milling_start_date }}</td>
                                </tr>
                                <tr>
                                    <th>End Date</th>
                                    <td>{{ $milling->milling_end_date ?? 'Not yet completed! Gonna be today date ('.date('Y-m-d').')' }}</td>
                                </tr>
                                <tr>
                                    <th>Bag Quantity</th>
                                    <td>{{ $milling->bag_quantity }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $milling->status }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <form action="{{ route('admin.millings.update', $milling->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <h5>Milling Results</h5>
                            @foreach ($result_types as $result_type)
                                <div class="mb-3">
                                    <label for="result_{{ $result_type->id }}" class="form-label">{{ $result_type->name }} (Bag Quantity)</label>
                                    <input type="number" name="results[{{ $result_type->id }}]" id="result_{{ $result_type->id }}" class="form-control @error('results.'.$result_type->id) is-invalid @enderror" value="{{ old('results.'.$result_type->id) }}">
                                    @error('results.'.$result_type->id)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-success">Mark as Completed</button>
                        <a href="{{ route('admin.millings.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection