<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Paddy\CreatePaddyRequest;
use App\Mail\PaddyEnrolled;
use App\Models\Paddy;
use App\Models\PaddyType;
use App\Models\User;
use App\Services\PaddyService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Middleware\PermissionMiddleware;

class PaddyController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using('view-paddy'), only: ['index']),
            new Middleware(PermissionMiddleware::using('create-paddy'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('edit-paddy'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('delete-paddy'), only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        try {
            $paddies = Paddy::select('id', 'user_id', 'paddy_type_id', 'bag_quantity', 'bag_weight', 'total_bag_weight', 'moisture_content', 'storage_start_date', 'storage_end_date', 'maximum_storage_duration')
                ->with(['user:id,name,deleted_at', 'paddy_type:id,name,deleted_at'])
                ->when($request->input('search'), function ($query, $search) {
                    $query->search($search);
                })
                ->orderBy('id', 'desc')
                ->paginate(5)->withQueryString();

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
            $data['total_bag_weight'] = $data['bag_quantity'] * $data['bag_weight'];
            $storageData = $paddyService->getStorageData(null, $data['moisture_content']);

            $paddy = Paddy::create(array_merge($data, $storageData));

            // Send email notification to the user
            $user = User::find($data['user_id']);
            Mail::to($user->email)->queue(new PaddyEnrolled($user, $paddy));

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
            $data['total_bag_weight'] = $data['bag_quantity'] * $data['bag_weight'];
            $storageData = $paddyService->getStorageData($paddy, $data['moisture_content']);

            $paddy->update(array_merge($data, $storageData));

            return redirect()->route('admin.paddies.index')->with('success', 'Paddy is updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update paddy: '.$e->getMessage());

            return back()->with('error', 'An error occurred while updating the paddy: '.$e->getMessage());
        }
    }

    public function destroy(Paddy $paddy)
    {
        try {
            $paddy->delete();

            return redirect()->route('admin.paddies.index')->with('success', 'Paddy is deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete paddy: '.$e->getMessage());

            return back()->with('error', 'An error occurred while deleting the paddy: '.$e->getMessage());
        }
    }
}
