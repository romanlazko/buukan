<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebApp\Auth\AuthenticatedSessionController;
use App\Http\Controllers\WebApp\Auth\RegisteredUserController;

use App\Http\Controllers\Client\EmailController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\RegisterController;
use App\Http\Controllers\Client\AppointmentController as ClientAppointmentController;
use App\Livewire\WebApp\WebApp;

Route::get('/', function () {
    return 'hello from web app';
});

Route::name('webapp.')->group(function () {
    Route::middleware('webapp.guest:user')->group(function () {
        Route::get('/{web_app}/register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('/{web_app}/register', [RegisteredUserController::class, 'store']);
        Route::get('/{web_app}/login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/{web_app}/login', [AuthenticatedSessionController::class, 'store']);
    });

    Route::middleware('user.auth')->prefix('{web_app}')->group(function () {
        Route::get('/', WebApp::class)->name('index')->lazy();
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });

    

    // Route::middleware('checkTemporaryUrl')->get('/{web_app}/{client}', [ClientAppointmentController::class, 'create'])->name('appointment.create');

    // Route::middleware('checkTemporaryUrl')->post('/{web_app}/{client}/store', [ClientAppointmentController::class, 'store'])->name('appointment.store');

    // Route::middleware('checkTemporaryUrl')->delete('/{web_app}/{client}/{appointment}', [ClientAppointmentController::class, 'destroy'])->name('appointment.destroy');
});



// Route::name('user.client.')->group(function () {
//     Route::get('/{web_app}', [EmailController::class, 'create'])->name('email');
//     Route::post('/{web_app}', [EmailController::class, 'store'])->name('email.store');

//     Route::get('/{web_app}/register', [RegisterController::class, 'create'])->name('register.create');
//     Route::post('/{web_app}/register', [RegisterController::class, 'store'])->name('register.store');
//     Route::get('/{web_app}/register/{client}', [RegisterController::class, 'edit'])->name('register.edit');
//     Route::post('/{web_app}/register/{client}', [RegisterController::class, 'update'])->name('register.update');

//     Route::get('/{web_app}/login', [LoginController::class, 'create'])->name('login.create');
//     Route::post('/{web_app}/login', [LoginController::class, 'store'])->name('login.store');


//     Route::middleware('checkTemporaryUrl')->get('/{web_app}/{client}', WebApp::class)->name('appointment.create')->lazy();

//     // Route::middleware('checkTemporaryUrl')->get('/{web_app}/{client}', [ClientAppointmentController::class, 'create'])->name('appointment.create');
//     Route::middleware('checkTemporaryUrl')->post('/{web_app}/{client}/store', [ClientAppointmentController::class, 'store'])->name('appointment.store');
//     Route::middleware('checkTemporaryUrl')->delete('/{web_app}/{client}/{appointment}', [ClientAppointmentController::class, 'destroy'])->name('appointment.destroy');
// });