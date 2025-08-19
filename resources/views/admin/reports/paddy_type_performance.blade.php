<div class="table-responsive">
    <table class="table table-bordered">
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
</div>
{{ $paddyTypePerformance->links('vendor.pagination.custom-pagination') }}
