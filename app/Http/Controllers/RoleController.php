<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\CreateRoleRequest;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(CreateRoleRequest $request)
    {
        $role = $request->validated();

        Role::create($role);

        return redirect()->route('admin.roles.index')->with('role-created', 'Role is created successfully');
    }
}
