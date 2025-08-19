<!DOCTYPE html>
<html>
<head>
    <title>Overall Performance Report</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Overall Performance Report</h1>
    <table>
        <thead>
            <tr>
                <th>Metric</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Appointments</td>
                <td>{{ $data['total_appointments'] }}</td>
            </tr>
            <tr>
                <td>Total Paddy Quantity (bags)</td>
                <td>{{ number_format($data['total_paddy_weight'], 2) }}</td>
            </tr>
            @foreach ($data['total_yields'] as $resultType => $total)
                <tr>
                    <td>Total {{ $resultType }} (kg)</td>
                    <td>{{ number_format($total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>