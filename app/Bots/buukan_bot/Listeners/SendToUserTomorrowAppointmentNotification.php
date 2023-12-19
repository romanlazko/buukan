<?php

namespace App\Bots\buukan_bot\Listeners;

use App\Bots\buukan_bot\Commands\UserCommands\MenuCommand;
use App\Bots\buukan_bot\Events\TomorrowAppointment;
use Romanlazko\Telegram\App\BotApi;

class SendToUserTomorrowAppointmentNotification
{
    /**
     * Handle the event.
     */
    public function handle(TomorrowAppointment $event): void
    {
        $appointment = $event->appointment;

        $text = implode("\n", [
            "Завтра, *{$appointment->date->format('d.m(D)')}* -> *{$appointment->term->format('H:s')}* Вы записаны на услугу."."\n",

            "*{$appointment->service->name}*"."\n",
            ($appointment->subServices->isNotEmpty() ? "Доп услуги: *{$appointment->subServices->pluck('name')->implode(', ')}*\n" : "").
            "Мастер: *{$appointment->employee->first_name}*",

            "📍 [{$appointment->employee->company->address}](https://www.google.com/maps?q={$appointment->employee->company->address})",

            "Итоговая стоимость: *{$appointment->total_price}*"
        ]);

        if ($appointment->client->telegram_chat) {
            BotApi::sendMessage([
                'text'          =>  $text,
                'chat_id'       =>  $appointment?->client?->telegram_chat?->chat_id,
                'parse_mode'    =>  'Markdown',
            ]);
        }
    }
}
