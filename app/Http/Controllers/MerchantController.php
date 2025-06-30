<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class MerchantController extends Controller
{
    public function index()
    {
        try {
            $users = User::select('id', 'name', 'email', 'is_opened', 'status')
                ->where('is_opened', 0)
                ->orderBy('id', 'desc')->paginate(5);

            return view('admin.merchants.index', compact('users'));
        } catch (\Exception $e) {
            Log::error('Failed to retrieve merchants: ' . $e->getMessage());
            return back()->with('error', 'Failed to load merchants. Please try again.');
        }
    }
}
