<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\PaddyTypeController;
use App\Http\Controllers\ResultTypeController;
use App\Http\Controllers\AppointmentTypeController;

Route::get('/', function () {
    return view('home');
});
Route::post('/register', [UserController::class, 'register'])->name('register');


Route::middleware('auth')->name('users.')->prefix('users')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard')->middleware('permission:user-dashboard');
});

Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('permission:admin-dashboard');
    // Users
    Route::resource('/users', UserController::class);
    Route::post('/users/{user}/roles/assign', [UserController::class, 'assignRole'])->name('users.roles.assign');
    Route::delete('/users/{user}/roles/{role}', [UserController::class, 'revokeRole'])->name('users.roles.revoke');
    Route::get('/users/{user}', [UserController::class, 'changeStatus'])->name('users.changeStatus');
    // Permissions
    Route::resource('/permissions', PermissionController::class)->only(['index']);
    // Roles
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions/assign', [RoleController::class, 'assignPermissions'])->name('roles.permissions.assign');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermissions'])->name('roles.permissions.revoke');
    // Merchants
    Route::resource('/merchants', MerchantController::class);
    // PaddyTypes
    Route::resource('/paddy_types', PaddyTypeController::class);
    // ResultTypes
    Route::resource('/result_types', ResultTypeController::class);
    // AppointmentTypes
    Route::resource('/appointment_types', AppointmentTypeController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
