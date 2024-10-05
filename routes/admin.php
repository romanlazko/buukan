<?php

use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

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
use App\Http\Controllers\Cron\TomorrowAppointmentsController;
use App\Http\Controllers\Admin\StripeController;
use App\Http\Controllers\Admin\SubscriptionController;
use Laravel\Cashier\Cashier;

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
    return view('welcome.welcome');
})->name('welcome');

Route::get('/contacts', function () {
    return view('welcome.contacts');
})->name('contacts');

Route::get('/prices', function () {
    $stripe = Cashier::stripe();
    $products = $stripe->products->all();

    foreach ($products['data'] as $product) {
        $plans = $stripe->plans->all(['product' => $product->id, 'active' => true]);
        $product->plans = collect($plans['data']);
    }

    $products = collect($products['data'])->sort();

    return view('welcome.prices', compact('products'));
})->name('prices');

Route::get('setlocale/{locale}', function ($locale) {
    session(['locale' => $locale]);

    return back();
})->name('setlocale');

Route::middleware('guest')->name('admin.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->name('admin.')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    // Route::put('password', [PasswordController::class, 'update'])->name('password.update');
        
    Route::middleware(['checkEmployeeRole:admin|super-duper-admin|administrator'])->group(function () {
        Route::resource('company', CompanyController::class);

        Route::middleware(['subscribed:premium,standard'])->group(function () {
            Route::get('company/{company}/client/{client}/telegram_chat', [ClientController::class, 'telegram_chat'])->name('company.client.telegram.chat');
            Route::resource('company.client', ClientController::class);

            Route::resource('company.employee', EmployeeController::class);
            Route::resource('company.service', ServiceController::class);
            
            Route::resource('company.appointment', AppointmentController::class);
            
            Route::middleware(['subscribed:premium'])->group(function () {
                Route::resource('company.sub_service', SubServiceController::class);
                
                Route::resource('company.telegram_bot', TelegramController::class);
                Route::resource('company.telegram_bot.chat', TelegramChatController::class);
                Route::resource('company.telegram_bot.advertisement', TelegramAdvertisementController::class);

                Route::resource('company.web_app', WebAppController::class);
            });
        });
    });

    Route::name('company.subscription.')->group(function () {
        Route::get('company/{company}/subscription/index', [SubscriptionController::class, 'index'])->name('index');
        Route::get('company/{company}/subscription/billing', [SubscriptionController::class, 'billing'])->name('billing');
        Route::post('company/{company}/subscription/checkout', [SubscriptionController::class, 'checkout'])->name('checkout');
        Route::get('company/{company}/subscription/success', [SubscriptionController::class, 'success'])->name('success');
    });
    
    Route::middleware(['checkEmployeeRole:admin|administrator|employee|super-duper-admin'])->group(function () {
        Route::resource('company.employee.schedule', ScheduleController::class);
    });
});

Route::middleware(['web'])->get('/cron', TomorrowAppointmentsController::class); 
// require __DIR__.'/auth.php';
