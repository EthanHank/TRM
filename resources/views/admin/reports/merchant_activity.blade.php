<div class="table-responsive">
    <table class="table table-bordered">
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
</div>
{{ $merchantActivity->links('vendor.pagination.custom-pagination') }}
