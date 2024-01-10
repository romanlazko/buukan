<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\NewAppointmentEmailNotification;
use Illuminate\Support\Facades\Mail;

class SendToUserEmailNewAppointmentNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Mail::to($event->appointment->client->email)->send(new NewAppointmentEmailNotification($event->appointment));
    }
}
