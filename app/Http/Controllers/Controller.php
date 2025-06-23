<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function userIndex()
    {
        return view('users.dashboard');
    }

    public function adminIndex()
    {
        return view('admin.dashboard');
    }
}
