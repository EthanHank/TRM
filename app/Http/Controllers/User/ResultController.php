<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class ResultController extends Controller
{
    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using('user-dashboard'), only: ['index', 'destroy']),
        ];
    }
    public function index()
    {
        $user = Auth::user();
        $search = request()->input('search');

        $results  = Result::with('result_type:id,name', 'milling.appointment.paddy.paddy_type:id,name')->where('user_id', $user->id)
        ->when($search, fn ($query, $search) => $query->adminSearch($search))
        ->orderBy('id', 'desc')
        ->paginate(10)->withQueryString();

        return view('users.results.index', compact('results'));
    }

    public function destroy(Result $result)
    {
        if($result->user_id != Auth::user()->id){
            return redirect()->route('users.results.index')->with('error', 'You are not authorized to delete this result');
        }
        
        $result->delete();

        return redirect()->route('users.results.index')->with('success', 'Result is deleted successfully');
    }
}
