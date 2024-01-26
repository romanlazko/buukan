<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Company;
use Laravel\Cashier\Cashier;
use App\Models\Product;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Interfaces\ScheduleInterface',
            'App\Models\TimeBasedSchedule'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Cashier::useCustomerModel(Company::class);

        Blade::if('subscribed', function (array|null $types = null) {
            return request()->company?->subscribed($types);
        });
    }
}
