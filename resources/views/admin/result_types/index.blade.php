@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Result Types Management')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Result Types</h6>
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
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.result_types.create') }}" class="btn btn-success"> + Add Result Type</a>
</div>
<!-- Roles Table -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Current Result Types</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($result_types->count() == 0)
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No result types found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($result_types as $result_type)
                        <tr class="text-center align-middle">
                            <td>{{ $result_type->name }}</td>
                            <td>{{ $result_type->description }}</td>
                            <td>
                                <span class="btn btn-primary mb-1">
                                    <a class="text-white" href="{{ route('admin.result_types.edit', $result_type->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </span>
                                <form action="{{ route('admin.result_types.destroy', $result_type->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this result type?')">
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
                    @if($result_types->hasPages())
                        {{ $result_types->links('vendor.pagination.custom-pagination') }}
                    @else
                        <small class="text-muted">Showing all results ({{ $result_types->total() }} total)</small>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection