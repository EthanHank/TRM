<div class="table-responsive">
    <table class="table table-bordered">
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
</div>
{{ $millingPredictionAccuracy->links('vendor.pagination.custom-pagination') }}
