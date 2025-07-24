<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResultType\CreateResultTypeRequest;
use App\Http\Requests\ResultType\UpdateResultTypeRequest;
use App\Models\ResultType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Middleware\PermissionMiddleware;

class ResultTypeController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using('view-result-type'), only: ['index']),
            new Middleware(PermissionMiddleware::using('create-result-type'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('edit-result-type'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('delete-result-type'), only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        try {
            // Retrieve all result types with selected fields and paginate
            $result_types = ResultType::select('id', 'name', 'description')
                ->when($request->input('search'), function ($query, $search) {
                    $query->search($search);
                })
                ->orderBy('id', 'desc')
                ->paginate(5)->withQueryString();

            // Logic to retrieve and display result types
            return view('admin.result_types.index', compact('result_types'));
        } catch (\Exception $e) {
            // Log the error and return an error message
            Log::error('Failed to retrieve result types: '.$e->getMessage());

            return back()->with('error', 'Failed to load result types. Please try again.');
        }
    }

    public function create()
    {
        // Logic to show the form for creating a new result type
        return view('admin.result_types.create');
    }

    public function store(CreateResultTypeRequest $request)
    {
        try {
            // Create a new result type with validated data
            ResultType::create($request->validated());

            return redirect()->route('admin.result_types.index')->with('success', 'Result Type is created successfully');
        } catch (\Exception $e) {
            // Log the error and return an error message
            Log::error('Failed to create result type: '.$e->getMessage());

            return back()->withInput()->with('error', 'Failed to create result type. Please try again.');
        }
    }

    public function edit(ResultType $result_type)
    {
        // Logic to show the form for editing an existing result type
        return view('admin.result_types.edit', compact('result_type'));
    }

    public function update(UpdateResultTypeRequest $request, ResultType $result_type)
    {
        try {
            // Update the result type with validated data
            $result_type->update($request->validated());

            return redirect()->route('admin.result_types.index')->with('success', 'Result Type is updated successfully');
        } catch (\Exception $e) {
            // Log the error and return an error message
            Log::error('Failed to update result type: '.$e->getMessage());

            return back()->withInput()->with('error', 'Failed to update result type. Please try again.');
        }
    }

    public function destroy(ResultType $result_type)
    {
        try {
            // Soft delete the result type
            $result_type->delete();

            return redirect()->route('admin.result_types.index')->with('success', 'Result Type is deleted successfully');
        } catch (\Exception $e) {
            // Log the error and return an error message
            Log::error('Failed to delete result type: '.$e->getMessage());

            return back()->with('error', 'Failed to delete result type. Please try again.');
        }
    }
}
