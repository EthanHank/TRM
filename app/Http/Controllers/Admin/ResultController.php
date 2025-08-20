<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Http\Requests\Result\ResultUpdateRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class ResultController extends Controller
{
    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using('view-result'), only: ['index']),
            new Middleware(PermissionMiddleware::using('edit-result'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('delete-result'), only: ['destroy']),
        ];
    }
    public function index()
    {
        $search = request()->input('search');

        $results  = Result::with('result_type:id,name', 'milling.appointment.paddy.paddy_type:id,name', 'user:id,name')
        ->when($search, fn ($query, $search) => $query->adminSearch($search))
        ->orderBy('id', 'desc')
        ->paginate(10)
        ->withQueryString();

        return view('admin.results.index', compact('results'));
    }

    public function edit(Result $result)
    {
        return view('admin.results.edit', compact('result'));
    }

    public function update(ResultUpdateRequest $request, Result $result)
    {
        $result->update($request->validated());

        return redirect()->route('admin.results.index')->with('success', 'Result is updated successfully');
    }

    public function destroy(Result $result)
    {
        $result->delete();

        return redirect()->route('admin.results.index')->with('success', 'Result is deleted successfully');
    }
}
