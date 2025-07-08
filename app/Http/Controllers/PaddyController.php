<?php

namespace App\Http\Controllers;

use App\Http\Requests\Paddy\CreatePaddyRequest;
use App\Models\Paddy;
use App\Models\PaddyType;
use App\Models\User;
use App\Services\PaddyService;
use Illuminate\Support\Facades\Log;

class PaddyController extends Controller
{
    public function index()
    {
        try {
            $paddies = Paddy::select('id', 'user_id', 'paddy_type_id', 'bag_quantity', 'moisture_content', 'storage_start_date', 'storage_end_date', 'maximum_storage_duration')
                ->with(['user:id,name', 'paddy_type:id,name'])
                ->orderBy('id', 'desc')
                ->paginate(5);

            return view('admin.paddies.index', compact('paddies'));
        } catch (\Exception $e) {
            // Handle the exception and return an error message
            Log::error('Failed to retrieve users: '.$e->getMessage());

            return back()->with('error', 'An error occurred while fetching paddies: '.$e->getMessage());
        }
    }

    public function create()
    {
        try {
            $paddy_types = PaddyType::select('id', 'name')->get();
            $users = User::select('id', 'name')->whereHas('roles', function ($query) {
                $query->where('name', 'merchant');
            })->get();

            return view('admin.paddies.create', compact('paddy_types', 'users'));
        } catch (\Exception $e) {
            Log::error('Failed to retrieve paddy types or users: '.$e->getMessage());

            return back()->with('error', 'An error occurred while fetching paddy types or users: '.$e->getMessage());
        }
    }

    public function store(CreatePaddyRequest $request, PaddyService $paddyService)
    {
        try {
            $data = $request->validated();
            $storageData = $paddyService->getStorageData(null, $data['moisture_content']);

            Paddy::create(array_merge($data, $storageData));

            return redirect()->route('admin.paddies.index')->with('success', 'Paddy is created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create paddy: '.$e->getMessage());

            return back()->with('error', 'An error occurred while creating the paddy: '.$e->getMessage());
        }
    }

    public function edit(Paddy $paddy)
    {
        try {
            $paddy_types = PaddyType::select('id', 'name')->get();
            $users = User::select('id', 'name')->whereHas('roles', function ($query) {
                $query->where('name', 'merchant');
            })->get();

            return view('admin.paddies.edit', compact('paddy', 'paddy_types', 'users'));
        } catch (\Exception $e) {
            Log::error('Failed to load paddy for edit: '.$e->getMessage());

            return back()->with('error', 'An error occurred while loading the paddy: '.$e->getMessage());
        }
    }

    public function update(CreatePaddyRequest $request, Paddy $paddy, PaddyService $paddyService)
    {
        try {
            $data = $request->validated();
            $storageData = $paddyService->getStorageData($paddy, $data['moisture_content']);

            $paddy->update(array_merge($data, $storageData));

            return redirect()->route('admin.paddies.index')->with('success', 'Paddy is updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update paddy: '.$e->getMessage());

            return back()->with('error', 'An error occurred while updating the paddy: '.$e->getMessage());
        }
    }
}
