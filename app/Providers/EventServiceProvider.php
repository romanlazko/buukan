<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\NewAppointment;
use App\Listeners\SendToUserEmailNewAppointmentNotification;
use App\Listeners\SendToUserTelegramNewAppointmentNotification;
use App\Listeners\SendToAdminTelegramNewAppointmentNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        NewAppointment::class => [
            // User listeners
            SendToUserEmailNewAppointmentNotification::class,
            SendToUserTelegramNewAppointmentNotification::class,
            // Admin listeners
            SendToAdminTelegramNewAppointmentNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
