<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\AppointmentTypeController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\MillingController;
use App\Http\Controllers\Admin\PaddyController;
use App\Http\Controllers\Admin\PaddyTypeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ResultTypeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DryingController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\AppointmentController;
use App\Http\Controllers\User\DryingResultCalculationController;
use App\Http\Controllers\User\MillingResultCalculationController;
use App\Http\Controllers\User\PaddyController as UserPaddyController;
use App\Http\Controllers\User\ResultController as UserResultController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ReportController as UserReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::middleware('auth')->name('users.')->prefix('users')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard')->middleware('permission:user-dashboard');

    // Paddies
    Route::resource('/paddies', UserPaddyController::class);

    // Appointments
    Route::get('/appointments/{paddy}/check', [AppointmentController::class, 'check'])->name('appointments.check');
    Route::get('/appointments/check-availability', [AppointmentController::class, 'checkAvailability'])->name('appointments.check-availability');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');

    // Explicit edit route for drying result calculation by Paddy
    Route::get('/drying_result_calculations/{paddy}/edit', [DryingResultCalculationController::class, 'edit'])->name('drying_result_calculations.edit');
    Route::post('/drying_result_calculations/calculate', [DryingResultCalculationController::class, 'calculate'])->name('drying_result_calculations.calculate');
    Route::post('/drying_result_calculations', [DryingResultCalculationController::class, 'store'])->name('drying_result_calculations.store');
    Route::delete('/drying_result_calculations/{drying_result_calculation}', [DryingResultCalculationController::class, 'destroy'])->name('drying_result_calculations.destroy');

    // Explicit edit route for milling result calculation by Paddy
    Route::get('/milling_result_calculations/{paddy}/edit', [MillingResultCalculationController::class, 'edit'])->name('milling_result_calculations.edit');
    Route::post('/milling_result_calculations/calculate', [MillingResultCalculationController::class, 'calculate'])->name('milling_result_calculations.calculate');
    Route::post('/milling_result_calculations', [MillingResultCalculationController::class, 'store'])->name('milling_result_calculations.store');
    Route::delete('/milling_result_calculations/{milling_result_calculation}', [MillingResultCalculationController::class, 'destroy'])->name('milling_result_calculations.destroy');

    //Results
    Route::resource('/results', UserResultController::class)->only(['index', 'destroy']);

    // Reports
    Route::get('/reports/appointment-history', [UserReportController::class, 'appointmentHistory'])->name('reports.appointment_history');
    Route::get('/reports/paddy-processing', [UserReportController::class, 'paddyProcessing'])->name('reports.paddy_processing');

    // PDF Exports
    Route::get('/reports/appointment-history/pdf', [UserReportController::class, 'appointmentHistoryPdf'])->name('reports.appointment_history.pdf');
    Route::get('/reports/paddy-processing/pdf', [UserReportController::class, 'paddyProcessingPdf'])->name('reports.paddy_processing.pdf');
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

    // Paddies
    Route::resource('/paddies', PaddyController::class);

    // Appointments
    Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{appointment}/cancel', [AdminAppointmentController::class, 'cancel'])->name('appointments.cancel');
    Route::delete('/appointments/{appointment}', [AdminAppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::get('/appointments/{appointment}', [AdminAppointmentController::class, 'confirm'])->name('appointments.confirm');

    // Milling
    Route::resource('/millings', MillingController::class)->except(['create']);
    Route::get('/millings/create/{appointment}', [MillingController::class, 'create'])->name('millings.create');

    // Drying
    Route::resource('/dryings', DryingController::class)->except(['create']);
    Route::get('/dryings/create/{appointment}', [DryingController::class, 'create'])->name('dryings.create');

    // Results
    Route::resource('/results', ResultController::class)->except(['create','show']);

    // Reports
    Route::get('/reports/overall-performance', [ReportController::class, 'overallPerformance'])->name('reports.overall_performance');
    Route::get('/reports/paddy-type-performance', [ReportController::class, 'paddyTypePerformance'])->name('reports.paddy_type_performance');
    Route::get('/reports/merchant-activity', [ReportController::class, 'merchantActivity'])->name('reports.merchant_activity');
    Route::get('/reports/milling-prediction-accuracy', [ReportController::class, 'millingPredictionAccuracy'])->name('reports.milling_prediction_accuracy');
    Route::get('/reports/appointment-history', [ReportController::class, 'appointmentHistory'])->name('reports.appointment_history');
    Route::get('/reports/paddy-processing', [ReportController::class, 'paddyProcessing'])->name('reports.paddy_processing');

    // PDF Exports
    Route::get('/reports/overall-performance/pdf', [ReportController::class, 'overallPerformancePdf'])->name('reports.overall_performance.pdf');
    Route::get('/reports/paddy-type-performance/pdf', [ReportController::class, 'paddyTypePerformancePdf'])->name('reports.paddy_type_performance.pdf');
    Route::get('/reports/merchant-activity/pdf', [ReportController::class, 'merchantActivityPdf'])->name('reports.merchant_activity.pdf');
    Route::get('/reports/milling-prediction-accuracy/pdf', [ReportController::class, 'millingPredictionAccuracyPdf'])->name('reports.milling_prediction_accuracy.pdf');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
