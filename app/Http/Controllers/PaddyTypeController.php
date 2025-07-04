<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaddyType\CreatePaddyTypeRequest;
use App\Http\Requests\PaddyType\UpdatePaddyTypeRequest;
use App\Models\PaddyType;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class PaddyTypeController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using('view-paddy-type'), only: ['index']),
            new Middleware(PermissionMiddleware::using('create-paddy-type'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('edit-paddy-type'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('delete-paddy-type'), only: ['destroy']),
        ];
    }
    
    public function index()
    {
        try {
            $paddy_types = PaddyType::select('id', 'name', 'description')->paginate(5);

            return view('admin.paddy_types.index', compact('paddy_types'));
        } catch (\Exception $e) {
            Log::error('Failed to retrieve paddy types: ' . $e->getMessage());
            return back()->with('error', 'Failed to load paddy types. Please try again.');
        }
    }

    public function create()
    {
        return view('admin.paddy_types.create');
    }

    public function store(CreatePaddyTypeRequest $request)
    {
        try {
            PaddyType::create($request->validated());
            return redirect()->route('admin.paddy_types.index')->with('success', 'Paddy Type is created successfully');
        } catch (\Exception $e) {
            Log::error('Failed to create paddy type: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create paddy type. Please try again.');
        }
    }

    public function edit(PaddyType $paddy_type)
    {
        return view('admin.paddy_types.edit', compact('paddy_type'));
    }

    public function update(UpdatePaddyTypeRequest $request, PaddyType $paddy_type)
    {
        try {
            $paddy_type->update($request->validated());
            return redirect()->route('admin.paddy_types.index')->with('success', 'Paddy Type is updated successfully');
        } catch (\Exception $e) {
            Log::error('Failed to update paddy type: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update paddy type. Please try again.');
        }
    }

    public function destroy(PaddyType $paddy_type)
    {
        try {
            $paddy_type->delete();
            return redirect()->route('admin.paddy_types.index')->with('success', 'Paddy Type is deleted successfully');
        } catch (\Exception $e) {
            Log::error('Failed to delete paddy type: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete paddy type. Please try again.');
        }
    }
}
