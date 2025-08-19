<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Paddy ID</th>
                <th>Paddy Type</th>
                <th>Drying Info</th>
                <th>Milling Info</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($paddyProcessing as $paddy)
                <tr>
                    <td>#{{ $paddy->id }}</td>
                    <td>{{ $paddy->paddy_type->name }}</td>
                    <td>
                        @if ($paddy->appointments->count() > 0 && $paddy->appointments->first()->drying)
                            Start: {{ $paddy->appointments->first()->drying->drying_start_date }} <br>
                            End: {{ $paddy->appointments->first()->drying->drying_end_date }} <br>
                            Status: {{ $paddy->appointments->first()->drying->status }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if ($paddy->appointments->count() > 0 && $paddy->appointments->first()->milling)
                            Start: {{ $paddy->appointments->first()->milling->milling_start_date }} <br>
                            End: {{ $paddy->appointments->first()->milling->milling_end_date }} <br>
                            Status: {{ $paddy->appointments->first()->milling->status }} <br>
                            <strong>Results:</strong><br>
                            @foreach ($paddy->appointments->first()->milling->results as $result)
                                &nbsp;&nbsp;- {{ $result->result_type->name }}: {{ $result->bag_quantity }} bags<br>
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No paddy processing history.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $paddyProcessing->links('vendor.pagination.custom-pagination') }}