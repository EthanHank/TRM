<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home');
});

// Route::get('/users', function () {
//     return view('users.dashboard');
// })->middleware(['auth', 'verified', 'role:merchant'])->name('users.dashboard');

// Route::get('/admin', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified', 'role:superadmin'])->name('admin.dashboard');

Route::get('/users/dashboard', [UserController::class, 'index'])->name('users.dashboard');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
