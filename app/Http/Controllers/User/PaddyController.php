<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Paddy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaddyController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();

        try {
            $paddies = Paddy::select('id', 'user_id', 'paddy_type_id', 'bag_quantity', 'bag_weight', 'total_bag_weight', 'moisture_content', 'storage_start_date', 'storage_end_date', 'maximum_storage_duration')
                ->with(['user:id,name', 'paddy_type:id,name'])
                ->where('user_id', $user->id)
                ->when($request->input('search'), function ($query, $search) {
                    $query->userSearch($search);
                })
                ->orderBy('id', 'desc')
                ->paginate(5)->withQueryString();

            return view('users.paddies.index', compact('paddies'));
        } catch (\Exception $e) {
            // Handle the exception and return an error message
            Log::error('Failed to retrieve users: '.$e->getMessage());

            return back()->with('error', 'An error occurred while fetching paddies: '.$e->getMessage());
        }
    }

    public function show(Paddy $paddy, Request $request)
    {
        try {
            $dryingResults = $paddy->drying_result_calculations()
                ->orderBy('created_at', 'desc')
                ->paginate(2, ['*'], 'drying_page')
                ->withQueryString();

            $millingResults = $paddy->milling_result_calculations()
                ->orderBy('created_at', 'desc')
                ->paginate(2, ['*'], 'milling_page')
                ->withQueryString();

            $appointments = $paddy->appointments()
                ->with('appointment_type:id,name')
                ->orderBy('created_at', 'desc')
                ->paginate(2, ['*'], 'appointments_page')
                ->withQueryString();

            return view('users.paddies.show', compact('paddy', 'dryingResults', 'millingResults', 'appointments'));
        } catch (\Exception $e) {
            // Handle the exception and return an error message
            Log::error('Failed to retrieve paddy details: '.$e->getMessage());

            return back()->with('error', 'An error occurred while fetching paddy details: '.$e->getMessage());
        }
    }
}
