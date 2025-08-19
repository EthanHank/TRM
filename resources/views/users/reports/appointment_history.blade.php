<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Appointment ID</th>
                <th>Paddy Type</th>
                <th>Bag Quantity</th>
                <th>Appointment Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($appointmentHistory as $appointment)
                <tr>
                    <td>#{{ $appointment->id }}</td>
                    <td>{{ $appointment->paddy->paddy_type->name }}</td>
                    <td>{{ $appointment->bag_quantity }}</td>
                    <td>{{ $appointment->appointment_type->name }}</td>
                    <td>{{ $appointment->appointment_start_date }}</td>
                    <td>{{ $appointment->appointment_end_date }}</td>
                    <td><span class="badge bg-{{ $appointment->status == 'completed' ? 'success' : 'warning' }}">{{ ucfirst($appointment->status) }}</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No appointment history.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $appointmentHistory->links('vendor.pagination.custom-pagination') }}