<!DOCTYPE html>
<html>
<head>
    <title>Milling Prediction Accuracy Report</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Milling Prediction Accuracy Report</h1>
    <table>
        <thead>
            <tr>
                <th>Paddy ID</th>
                <th>Result Type</th>
                <th>Predicted</th>
                <th>Actual</th>
                <th>Error (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($millingPredictionAccuracy as $item)
                @foreach ($item->accuracy as $type => $accuracy)
                    <tr>
                        <td>{{ $item->paddy_id }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $type)) }}</td>
                        <td>{{ $accuracy['predicted'] }}</td>
                        <td>{{ $accuracy['actual'] }}</td>
                        <td>{{ $accuracy['error_percentage'] }}%</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>