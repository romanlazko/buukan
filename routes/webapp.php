<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Client\EmailController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\RegisterController;
use App\Http\Controllers\Client\AppointmentController as ClientAppointmentController;

Route::domain('webapp.buukan.com')->group(function () {
    Route::get('/app/{web_app}', [EmailController::class, 'create'])->name('email');
    Route::post('/app/{web_app}', [EmailController::class, 'store'])->name('email.store');

    Route::get('/app/{web_app}/register', [RegisterController::class, 'create'])->name('register.create');
    Route::post('/app/{web_app}/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/app/{web_app}/register/{client}', [RegisterController::class, 'edit'])->name('register.edit');
    Route::post('/app/{web_app}/register/{client}', [RegisterController::class, 'update'])->name('register.update');

    Route::get('/app/{web_app}/login', [LoginController::class, 'create'])->name('login.create');
    Route::post('/app/{web_app}/login', [LoginController::class, 'store'])->name('login.store');


    Route::middleware('checkTemporaryUrl')->get('/app/{web_app}/{client}', WebApp::class)->name('appointment.create')->lazy();

    // Route::middleware('checkTemporaryUrl')->get('/app/{web_app}/{client}', [ClientAppointmentController::class, 'create'])->name('appointment.create');
    Route::middleware('checkTemporaryUrl')->post('/app/{web_app}/{client}/store', [ClientAppointmentController::class, 'store'])->name('appointment.store');
    Route::middleware('checkTemporaryUrl')->delete('/app/{web_app}/{client}/{appointment}', [ClientAppointmentController::class, 'destroy'])->name('appointment.destroy');
});