<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

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
