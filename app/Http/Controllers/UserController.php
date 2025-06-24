<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('users.dashboard');
    }

    public function index()
    {
        $users = User::select('id', 'name', 'email', 'is_opened', 'created_at', 'updated_at')
            ->with('roles:id,name')
            ->whereDoesntHave('roles', function($query) {
                $query->where('name', 'superadmin');
            })
            ->where('is_opened', 1)
            ->orderBy('id', 'desc')->paginate(5);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'superadmin')->get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->save();

        // Convert role IDs to names
        $roleNames = Role::whereIn('id', $request->role)->pluck('name')->toArray();
        $user->assignRole($roleNames);

        return redirect()->route('admin.users.index')->with('success', 'User is created successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::whereDoesntHave('users', function($query) use ($user) {
            $query->where('users.id', $user->id);
        })->where('name', '!=', 'superadmin')->get();

        $userRoles = $user->roles->pluck('id')->toArray();
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()->route('admin.users.index')->with('success', 'User is updated successfully');
    }

    public function revokeRole(User $user, Role $role)
    {
        $user->removeRole($role->name);

        return back()->with('revoke_success', 'Role revoked successfully');
    }

    public function assignRole(Request $request, User $user)
    {
        if ($request->has('role')) {
            $roleNames = Role::whereIn('id', $request->role)->pluck('name')->toArray();
            $user->assignRole($roleNames);

            return back()->with('success', 'Role assigned successfully');
        }

        return back()->with('error', 'No roles selected');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User is deleted successfully');
    }
}
