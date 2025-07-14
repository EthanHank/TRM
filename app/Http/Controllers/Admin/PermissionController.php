<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using('view-permission'), only: ['index']),
        ];
    }

    public function index(Request $request)
    {
        $permissions = Permission::select('name', 'category', 'created_at', 'updated_at')
            ->when($request->input('search'), function ($query, $search) {
                $query->search($search);
            })
            ->orderBy('id', 'desc')
            ->paginate(8)->withQueryString();

        return view('admin.permissions.index', compact('permissions'));
    }
}
