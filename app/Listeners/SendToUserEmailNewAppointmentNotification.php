<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\NewAppointmentEmailNotification;
use Illuminate\Support\Facades\Mail;
use App\Events\NewAppointmentEvent;

class SendToUserEmailNewAppointmentNotification
{
    /**
     * Handle the event.
     */
    public function handle(NewAppointmentEvent $event): void
    {
        if ($event->appointment?->client?->email) {
            Mail::to($event->appointment?->client?->email)->send(new NewAppointmentEmailNotification($event->appointment));
        }
    }
}
