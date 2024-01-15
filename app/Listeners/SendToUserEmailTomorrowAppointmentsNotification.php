<?php

namespace App\Listeners;

use App\Events\TomorrowAppointmentsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\TomorrowAppointmentEmailNotification;
use Illuminate\Support\Facades\Mail;

class SendToUserEmailTomorrowAppointmentsNotification
{
    /**
     * Handle the event.
     */
    public function handle(TomorrowAppointmentsEvent $event): void
    {
        $company = $event->company;

        $appointments = $company->appointments()
            ->where('status', 'new')
            ->where('date', now()->addDay()->format('Y-m-d'))
            ->orderBy('term')
            ->get();

        if ($appointments->isNotEmpty()) {
            $appointments->each(function ($appointment) {
                if ($appointment->client?->email) {
                    Mail::to($appointment->client?->email)->send(new TomorrowAppointmentEmailNotification($appointment));
                }
            });
        }
    }
}
