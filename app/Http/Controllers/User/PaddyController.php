<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Paddy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaddyController extends Controller
{
    public function index(Request $request){

        $user = Auth::user();

        try {
            $paddies = Paddy::select('id', 'user_id', 'paddy_type_id', 'bag_quantity', 'moisture_content', 'storage_start_date', 'storage_end_date', 'maximum_storage_duration')
                ->with(['user:id,name', 'paddy_type:id,name'])
                ->where('user_id', $user->id)
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
}
