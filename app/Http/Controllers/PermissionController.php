<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using('view-permission'), only: ['index']),
        ];
    }

    public function index()
    {
        $permissions = Permission::orderBy('id', 'desc')->paginate(8);

        return view('admin.permissions.index', compact('permissions'));
    }
}
