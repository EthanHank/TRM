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
                        You are about to mark as completed the drying process. This action will send a drying notification to the merchant.
                    </div>

                    <div class="mb-4">
                        <h5>Drying Details</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Appointment Type</th>
                                    <td>{{ $drying->appointment->appointment_type->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Paddy Type</th>
                                    <td>{{ $drying->appointment->paddy->paddy_type->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Merchant</th>
                                    <td>{{ $drying->appointment->paddy->user->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Start Date</th>
                                    <td>{{ $drying->drying_start_date }}</td>
                                </tr>
                                <tr>
                                    <th>End Date</th>
                                    <td>{{ $drying->drying_end_date ?? 'Not yet completed! Gonna be today date ('.date('Y-m-d').')' }}</td>
                                </tr>
                                <tr>
                                    <th>Bag Quantity</th>
                                    <td>{{ $drying->bag_quantity }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $drying->status }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <form action="{{ route('admin.dryings.update', $drying->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <h5>Dried Paddy Results</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr class="text-center align-middle">
                                        <th>Bag Quantity</th>
                                        <td>
                                            <input type="text" name="bag_quantity" class="form-control">
                                            @error('bag_quantity')
                                                <div class="text-danger my-1">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                     <tr class="text-center align-middle">
                                        <th>Bag Weight</th>
                                        <td>
                                            <input type="text" name="bag_weight" class="form-control">
                                            @error('bag_weight')
                                                <div class="text-danger my-1">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Mark as Completed</button>

                        <a href="{{ route('admin.dryings.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection