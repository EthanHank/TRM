<!DOCTYPE html>
<html>
<head>
    <title>Paddy Type Performance Report</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Paddy Type Performance Report</h1>
    <table>
        <thead>
            <tr>
                <th>Paddy Type</th>
                <th>Avg. Drying Time (seconds)</th>
                <th>Avg. Milling Yield (%)</th>
                <th>Quality Distribution</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paddyTypePerformance as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->average_drying_time_seconds, 2) }}</td>
                    <td>{{ number_format($item->average_milling_yield_percentage, 2) }}</td>
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