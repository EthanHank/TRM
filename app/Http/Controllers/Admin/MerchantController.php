<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Merchant\MerchantUpdateRequest;
use App\Mail\MerchantConfirmed;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class MerchantController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using('view-user'), only: ['index']),
            new Middleware(PermissionMiddleware::using('edit-user'), only: ['edit', 'update']),
        ];
    }

    public function index()
    {
        try {
            $merchants = User::select('id', 'name', 'email', 'is_opened', 'status')
                ->where('is_opened', 0)
                ->orderBy('id', 'desc')->paginate(5);

            return view('admin.merchants.index', compact('merchants'));
        } catch (\Exception $e) {
            Log::error('Failed to retrieve merchants: '.$e->getMessage());

            return back()->with('error', 'Failed to load merchants. Please try again.');
        }
    }

    public function edit(User $merchant)
    {
        try {

            $roles = Role::where('name', '!=', 'superadmin')->get();

            return view('admin.merchants.edit', compact('merchant', 'roles'));

        } catch (\Exception $e) {
            Log::error('Failed to load user for edit: '.$e->getMessage());

            return back()->with('error', 'Failed to load user. Please try again.');
        }
    }

    public function update(MerchantUpdateRequest $request, User $merchant)
    {
        try {
            $merchant->update([
                'password' => Hash::make($request->password),
                'is_opened' => 1,
                'status' => 1,
                'email_verified_at' => now(),
            ]);
            $merchant->roles()->sync($request->roles);

            $password = $request->password;

            // Send confirmation email
            Mail::to($merchant->email)->queue(new MerchantConfirmed($merchant, $password));

            return redirect()->route('admin.merchants.index')->with('success', 'Merchant is confirmed successfully');
        } catch (\Exception $e) {
            Log::error('Failed to update merchant: '.$e->getMessage());

            return back()->with('error', 'Failed to update merchant. Please try again.');
        }

    }
}
