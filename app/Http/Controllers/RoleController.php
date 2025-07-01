<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using('view-role'), only: ['index']),
            new Middleware(PermissionMiddleware::using('create-role'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('edit-role'), only: ['edit', 'update', 'assignPermissions', 'revokePermissions']),
            new Middleware(PermissionMiddleware::using('delete-role'), only: ['destroy']),
        ];
    }
    public function index()
    {
        $roles = Role::whereNotIn('name', ['superadmin'])->orderBy('id', 'desc')->paginate(5);

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(CreateRoleRequest $request)
    {
        Role::create($request->validated());

        return redirect()->route('admin.roles.index')->with('success', 'Role is created successfully');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::whereDoesntHave('roles', function ($query) use ($role) {
            $query->where('roles.id', $role->id);
        })->get();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        return redirect()->route('admin.roles.index')->with('success', 'Role is updated successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('success', 'Role is deleted successfully');
    }

    public function assignPermissions(Request $request, Role $role)
    {
        if ($request->has('permissions')) 
        {
            $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');
            $role->givePermissionTo($permissions);

            return back()->with('success', 'Permissions are assigned successfully');
        }

        return back()->with('error', 'No permissions selected');
    }

    public function revokePermissions(Role $role, Permission $permission)
    {
        $role->revokePermissionTo($permission->name);

        return back()->with('revoke_success', 'Permission revoked successfully');

    }
}

