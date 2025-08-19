<!DOCTYPE html>
<html>
<head>
    <title>Merchant Activity Report</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Merchant Activity Report</h1>
    <table>
        <thead>
            <tr>
                <th>Merchant Name</th>
                <th>Total Appointments</th>
                <th>Total Paddy Enrolled (bags)</th>
                <th>Quality Distribution</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($merchantActivity as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->total_appointments }}</td>
                    <td>{{ number_format($item->total_paddy_supplied_kg, 2) }}</td>
                    <td>
                        @foreach ($item->quality_distribution as $quality => $count)
                            <div>{{ $quality }}: {{ $count }}</div>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>