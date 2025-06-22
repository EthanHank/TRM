<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
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
        return view('admin.roles.edit', compact('role'));
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
}
