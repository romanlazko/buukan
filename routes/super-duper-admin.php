<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SuperDuperAdmin\PermissionController;
use App\Http\Controllers\SuperDuperAdmin\RoleController;
use App\Http\Controllers\SuperDuperAdmin\UserController;
use App\Http\Controllers\SuperDuperAdmin\CompanyController;
use App\Http\Controllers\SuperDuperAdmin\PlanController;


Route::middleware(['auth', 'role:super-duper-admin'])->name('super-duper-admin.')->prefix('super-duper-admin')->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);

    Route::resource('company', CompanyController::class);
});