<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SubServiceController;
use App\Http\Controllers\Admin\WebAppController;
use App\Http\Controllers\Api\v1\GetClientData;
use App\Http\Controllers\Api\v1\GetEmployeeService;
use App\Http\Controllers\Api\v1\GetEmployeeUnoccupiedSchedule;
use App\Http\Controllers\Client\AppointmentController as ClientAppointmentController;
use App\Http\Controllers\Client\EmailController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Telegram\TelegramAdvertisementController;
use App\Http\Controllers\Telegram\TelegramChatController;
use App\Http\Controllers\Telegram\TelegramController;
use App\Livewire\WebApp\WebApp;
use Illuminate\Support\Facades\Route;
use Romanlazko\Slurp\App\Http\Controllers\PermissionController;
use Romanlazko\Slurp\App\Http\Controllers\RoleController;
use Romanlazko\Slurp\App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/app/{company}', function (Company $company) {
//     return response()->view('admin.company.web_app.show', compact(
//         'company'
//     ));
// });

// Route::name('user.client.')->group(function () {
//     Route::get('/app/{web_app}', [EmailController::class, 'create'])->name('email');
//     Route::post('/app/{web_app}', [EmailController::class, 'store'])->name('email.store');

//     Route::get('/app/{web_app}/register', [RegisterController::class, 'create'])->name('register.create');
//     Route::post('/app/{web_app}/register', [RegisterController::class, 'store'])->name('register.store');
//     Route::get('/app/{web_app}/register/{client}', [RegisterController::class, 'edit'])->name('register.edit');
//     Route::post('/app/{web_app}/register/{client}', [RegisterController::class, 'update'])->name('register.update');

//     Route::get('/app/{web_app}/login', [LoginController::class, 'create'])->name('login.create');
//     Route::post('/app/{web_app}/login', [LoginController::class, 'store'])->name('login.store');


//     Route::middleware('checkTemporaryUrl')->get('/app/{web_app}/{client}', WebApp::class)->name('appointment.create')->lazy();

//     // Route::middleware('checkTemporaryUrl')->get('/app/{web_app}/{client}', [ClientAppointmentController::class, 'create'])->name('appointment.create');
//     Route::middleware('checkTemporaryUrl')->post('/app/{web_app}/{client}/store', [ClientAppointmentController::class, 'store'])->name('appointment.store');
//     Route::middleware('checkTemporaryUrl')->delete('/app/{web_app}/{client}/{appointment}', [ClientAppointmentController::class, 'destroy'])->name('appointment.destroy');
// });

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware([])->name('admin.')->group(function () {
        
        Route::middleware(['role:admin'])->group(function () {
            Route::resource('company', CompanyController::class);
        });
    
        // Route::middleware(['checkEmployeeRole:admin|administrator'])->group(function () {
            Route::get('company/{company}/client/{client}/telegram_chat', [ClientController::class, 'telegram_chat'])->name('company.client.telegram.chat');
            Route::resource('company.client', ClientController::class);
            Route::resource('company.employee', EmployeeController::class);
            Route::resource('company.service', ServiceController::class);
            Route::resource('company.sub_service', SubServiceController::class);
            Route::resource('company.appointment', AppointmentController::class);
            
            Route::resource('company.telegram_bot', TelegramController::class);
            Route::resource('company.telegram_bot.chat', TelegramChatController::class);
            Route::resource('company.telegram_bot.advertisement', TelegramAdvertisementController::class);

            Route::resource('company.web_app', WebAppController::class);

        // });
        
        // Route::middleware(['checkEmployeeRole:admin|administrator|employee'])->group(function () {
            Route::resource('company.employee.schedule', ScheduleController::class);
        // });
    });
});

Route::middleware(['web', 'auth', 'role:super-duper-admin'])->name('super-duper-admin.user.')->prefix('super-duper-admin')->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
});


Route::middleware(['web'])->get('api/v1/get-employee-unoccupied-schedule', GetEmployeeUnoccupiedSchedule::class)->name('get-employee-unoccupied-schedule');
Route::middleware(['web'])->post('api/v1/get-employee-unoccupied-schedule', GetEmployeeUnoccupiedSchedule::class)->name('get-employee-unoccupied-schedule');
Route::middleware(['web'])->post('api/v1/get-employee-service', GetEmployeeService::class)->name('get-employee-service');
Route::middleware(['web'])->post('api/v1/get-client-data', GetClientData::class)->name('get-client-data');


require __DIR__.'/auth.php';
