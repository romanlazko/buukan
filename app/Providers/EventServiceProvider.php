<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\NewAppointmentEvent;
use App\Listeners\SendToUserEmailNewAppointmentNotification;
use App\Listeners\SendToUserTelegramNewAppointmentNotification;
use App\Listeners\SendToAdminTelegramNewAppointmentNotification;

use App\Events\CancelAppointmentEvent;
// use App\Listeners\SendToUserEmailNewAppointmentNotification;
use App\Listeners\SendToUserTelegramCancelAppointmentNotification;
use App\Listeners\SendToAdminTelegramCancelAppointmentNotification;

use App\Events\TomorrowAppointmentsEvent;
use App\Listeners\SendToUserEmailTomorrowAppointmentsNotification;
use App\Listeners\SendToUserTelegramTomorrowAppointmentsNotification;
use App\Listeners\SendToAdminTelegramTomorrowAppointmentsNotification;


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

        NewAppointmentEvent::class => [
            // User listeners
            SendToUserEmailNewAppointmentNotification::class,
            SendToUserTelegramNewAppointmentNotification::class,
            // Admin listeners
            SendToAdminTelegramNewAppointmentNotification::class,
        ],

        CancelAppointmentEvent::class => [
            // User listeners
            // SendToUserEmailNewAppointmentNotification::class,
            SendToUserTelegramCancelAppointmentNotification::class,
            // Admin listeners
            SendToAdminTelegramCancelAppointmentNotification::class,
        ],

        TomorrowAppointmentsEvent::class => [
            // User listeners
            SendToUserEmailTomorrowAppointmentsNotification::class,
            SendToUserTelegramTomorrowAppointmentsNotification::class,
            // Admin listeners
            SendToAdminTelegramTomorrowAppointmentsNotification::class,
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
