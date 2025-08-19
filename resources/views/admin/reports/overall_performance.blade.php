<div class="table-responsive">
    <table class="table table-bordered">
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
</div>
