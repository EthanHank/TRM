<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using('view-user'), only: ['index', 'show']),
            new Middleware(PermissionMiddleware::using('create-user'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('edit-user'), only: ['edit', 'update', 'changeStatus', 'revokeRole', 'assignRole']),
            new Middleware(PermissionMiddleware::using('delete-user'), only: ['destroy']),

        ];
    }

    public function dashboard()
    {
        return view('users.dashboard');
    }

    public function index(Request $request)
    {
        try {
            $users = User::select('id', 'name', 'email', 'is_opened', 'status')
                ->with('roles:id,name')
                ->whereDoesntHave('roles', function ($query) {
                    $query->whereIn('name', ['superadmin']);
                })
                ->where('is_opened', 1)
                ->when($request->input('search'), function ($query, $search) {
                    $query->search($search);
                })
                ->orderBy('id', 'desc')->paginate(5)->withQueryString();

            return view('admin.users.index', compact('users'));
        } catch (\Exception $e) {
            Log::error('Failed to retrieve users: '.$e->getMessage());

            return back()->with('error', 'Failed to load users. Please try again.');
        }
    }

    public function create()
    {
        try {
            $roles = Role::where('name', '!=', 'superadmin')->get();

            return view('admin.users.create', compact('roles'));
        } catch (\Exception $e) {
            Log::error('Failed to load roles: '.$e->getMessage());

            return back()->with('error', 'Failed to load roles. Please try again.');
        }
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $user = User::create($request->validated());
            $user->password = Hash::make($request->password);
            $user->email_verified_at = now();
            $user->status = true; // Assuming new users are active by default
            $user->save();

            // Convert role IDs to names
            $roleNames = Role::whereIn('id', $request->role)->pluck('name')->toArray();
            $user->assignRole($roleNames);

            return redirect()->route('admin.users.index')->with('success', 'User is created successfully');
        } catch (\Exception $e) {
            Log::error('Failed to create user: '.$e->getMessage());

            return back()->withInput()->with('error', 'Failed to create user. Please try again.');
        }
    }

    public function edit(User $user)
    {
        try {
            $roles = Role::whereDoesntHave('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })->where('name', '!=', 'superadmin')->get();

            $userRoles = $user->roles->pluck('id')->toArray();

            return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
        } catch (\Exception $e) {
            Log::error('Failed to load user for edit: '.$e->getMessage());

            return back()->with('error', 'Failed to load user. Please try again.');
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->update($request->validated());

            return redirect()->route('admin.users.index')->with('success', 'User is updated successfully');
        } catch (\Exception $e) {
            Log::error('Failed to update user: '.$e->getMessage());

            return back()->withInput()->with('error', 'Failed to update user. Please try again.');
        }
    }

    public function revokeRole(User $user, Role $role)
    {
        try {
            $user->removeRole($role->name);

            return back()->with('revoke_success', 'Role revoked successfully');
        } catch (\Exception $e) {
            Log::error('Failed to revoke role: '.$e->getMessage());

            return back()->with('error', 'Failed to revoke role. Please try again.');
        }
    }

    public function assignRole(Request $request, User $user)
    {
        try {
            if ($request->has('role')) {
                $roleNames = Role::whereIn('id', $request->role)->pluck('name')->toArray();
                $user->assignRole($roleNames);

                return back()->with('success', 'Role assigned successfully');
            }

            return back()->with('error', 'No roles selected');
        } catch (\Exception $e) {
            Log::error('Failed to assign role: '.$e->getMessage());

            return back()->with('error', 'Failed to assign role. Please try again.');
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->is_opened = false;
            $user->status = false;
            $user->save();
            $user->delete();

            return redirect()->route('admin.users.index')->with('success', 'User is deleted successfully');
        } catch (\Exception $e) {
            Log::error('Failed to delete user: '.$e->getMessage());

            return back()->with('error', 'Failed to delete user. Please try again.');
        }
    }

    public function changeStatus(User $user)
    {
        try {
            if ($user->status == true) {
                $user->status = false;
            } else {
                $user->status = true;
            }
            $user->save();

            return back()->with('success', 'User status is changed successfully');
        } catch (\Exception $e) {
            Log::error('Failed to change user status: '.$e->getMessage());

            return back()->with('error', 'Failed to change user status. Please try again.');
        }
    }

    public function register(RegisterUserRequest $request)
    {
        try {
            User::create($request->all());

            return back()->with('success', 'Merchant is registered successfully');
        } catch (\Exception $e) {
            Log::error('Failed to register merchant: '.$e->getMessage());

            return back()->with('error', 'Failed to register merchant. Please try again.');
        }
    }
}
