<!DOCTYPE html>
<html>
<head>
    <title>Appointment History Report</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Appointment History Report</h1>
    <table>
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
                    <td>{{ ucfirst($appointment->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No appointment history.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>