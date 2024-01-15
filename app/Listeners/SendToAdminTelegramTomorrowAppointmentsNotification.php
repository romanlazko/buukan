<?php

namespace App\Listeners;

use App\Events\TomorrowAppointmentsEvent;

class SendToAdminTelegramTomorrowAppointmentsNotification
{
    /**
     * Handle the event.
     */
    public function handle(TomorrowAppointmentsEvent $event): void
    {
        $appointments   = $event->appointments;
        $bot            = $event->bot;

        $admins = $appointments->first()->company->employees->map(function ($employee) {
            return $employee->chat_id;
        })->toArray();

        $appointmentsText = $appointments->map(function ($appointment) {
            return implode("\n", [
                "{$appointment->employee->first_name} {$appointment->employee->last_name}: *{$appointment->service->name}*",
                ($appointment->sub_services->isNotEmpty() ? "Доп услуги: *{$appointment->sub_services->pluck('name')->implode(', ')}*\n" : "") .
                "{$appointment->client->first_name} {$appointment->client->last_name}: *{$appointment->term->format('H:i')}*",
                "Cтоимость: *{$appointment->total_price}*"
            ]);
        });

        $text = implode("\n", [
            "⚠️Напоминание о записях *{$appointments->first()->date->format('d.m(D)')}*⚠️"."\n",
            $appointmentsText->implode("\n\n")
        ]);

        $bot::sendMessages([
            'reply_markup'  => null,
            'text'          =>  $text,
            'chat_ids'      =>  $admins,
            'parse_mode'    =>  'Markdown',
        ]);
    }
}
