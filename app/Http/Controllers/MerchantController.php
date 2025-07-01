<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\Merchant\MerchantUpdateRequest;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class MerchantController extends Controller
{
    public function index()
    {
        try {
            $merchants = User::select('id', 'name', 'email', 'is_opened', 'status')
                ->where('is_opened', 0)
                ->orderBy('id', 'desc')->paginate(5);

            return view('admin.merchants.index', compact('merchants'));
        } catch (\Exception $e) {
            Log::error('Failed to retrieve merchants: ' . $e->getMessage());
            return back()->with('error', 'Failed to load merchants. Please try again.');
        }
    }

    public function edit(User $merchant)
    {
        try {

            $roles = Role::where('name', '!=', 'superadmin')->get();

            return view('admin.merchants.edit', compact('merchant', 'roles'));

        } catch (\Exception $e) {
            Log::error('Failed to load user for edit: ' . $e->getMessage());
            return back()->with('error', 'Failed to load user. Please try again.');
        }
    }

    public function update(MerchantUpdateRequest $request, User $merchant)
    {
        try {
            $merchant->update([
                'password' => Hash::make($request->password),
                'is_opened' => 1,
            ]);
            $merchant->roles()->sync($request->roles);
            return redirect()->route('admin.merchants.index')->with('success', 'Merchant is confirmed successfully');
        } catch (\Exception $e) {
            Log::error('Failed to update merchant: ' . $e->getMessage());
            return back()->with('error', 'Failed to update merchant. Please try again.');
        }
            
    }
}
