@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Results Management')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Results</h6>
</div>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row mb-5">
    <div class="col-md-12">
        <form method="GET" action="{{ route('admin.results.index') }}" class="input-group">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search results by paddy type, result type or username..."
                value="{{ request('search') }}"
                aria-label="Search users">
            <button class="btn btn-search me-2" type="submit">
                <i class="bi bi-search"></i> Search
            </button>
        </form>
    </div>
</div>
<!-- Results Table -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Results</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>Result Type</th>
                            <th>Paddy Type</th>
                            <th>Username</th>
                            <th>Bag Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($results->count() == 0)
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No Results found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($results as $result)
                        <tr class="text-center align-middle">
                            <td>{{ $result->result_type->name }}</td>
                            <td>{{ $result->milling->appointment->paddy->paddy_type->name }}</td>
                            <td>{{ $result->user->name }}</td>
                            <td>{{ $result->bag_quantity }}</td>
                            <td>
                                <span class="btn btn-primary mb-1">
                                    <a class="text-white" href="{{ route('admin.results.edit', $result->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </span>
                                <form action="{{ route('admin.results.destroy', $result->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this result?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                @if($results->hasPages())
                {{ $results->links('vendor.pagination.custom-pagination') }}
                @else
                <small class="text-muted">Showing all results ({{ $results->total() }} total)</small>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection