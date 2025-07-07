<?php

namespace App\Http\Controllers;

use App\Models\Paddy;
use Illuminate\Support\Facades\Log;
use App\Models\PaddyType;
use App\Models\User;

class PaddyController extends Controller
{
    public function index()
    {
        try {
            $paddies = Paddy::select('id', 'user_id', 'paddy_type_id', 'bag_quantity', 'moisture_content', 'storage_start_date', 'storage_end_date', 'maximum_storage_duration')
                ->with(['paddy_type:name', 'user:name'])
                ->paginate(5);

            return view('admin.paddies.index', compact('paddies'));
        } catch (\Exception $e) {
            // Handle the exception and return an error message
            Log::error('Failed to retrieve users: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching paddies: ' . $e->getMessage());
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
            Log::error('Failed to retrieve paddy types or users: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching paddy types or users: ' . $e->getMessage());
        }
    }
}
