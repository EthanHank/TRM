@extends('layouts.admin')

@section('title', 'Tun Rice Milling - Paddy Types Management')

@section('content')
<div>
    <h6 class="text-muted mb-4">Admin > Paddy Types</h6>
</div>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.paddy_types.create') }}" class="btn btn-success"> + Add Paddy Type</a>
</div>
<!-- Roles Table -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Current Paddy Types</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($paddy_types->count() == 0)
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No paddy types found! T_T</td>
                        </tr>
                        @endif
                        @foreach ($paddy_types as $paddy_type)
                        <tr>
                            <td>{{ $paddy_type->name }}</td>
                            <td>{{ $paddy_type->description }}</td>
                            <td>
                                <span class="btn btn-primary">
                                    <a class="text-white" href="{{ route('admin.paddy_types.edit', $paddy_type->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </span>
                                <form action="{{ route('admin.paddy_types.destroy', $paddy_type->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this paddy type?')">
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
                    @if($paddy_types->hasPages())
                        {{ $paddy_types->links('vendor.pagination.custom-pagination') }}
                    @else
                        <small class="text-muted">Showing all results ({{ $paddy_types->total() }} total)</small>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection