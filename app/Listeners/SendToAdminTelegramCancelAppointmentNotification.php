<?php

namespace App\Listeners;

use App\Events\CancelAppointmentEvent;
use Romanlazko\Telegram\App\Bot;

class SendToAdminTelegramCancelAppointmentNotification
{
    /**
     * Handle the event.
     */
    public function handle(CancelAppointmentEvent $event): void
    {
        $appointment = $event->appointment;

        if ($telegram_bot = $appointment->company->telegram_bots?->first()) {
            $bot = new Bot($telegram_bot->token);

            $admins = $appointment->company->employees->map(function ($employee) {
                return $employee->chat_id;
            })->toArray();

            $buttons = $bot::inlineKeyboardWithLink(
                array(
                    'text' => 'Контакт', 
                    'url'  => $appointment->client?->chat_id 
                        ? "tg://user?id={$appointment->client?->chat_id }"
                        : route('admin.company.client.show', [$appointment->company, $appointment->client])
                )
            );

            $text = implode("\n", [
                "❌*Отмена записи*❌"."\n",

                "#{$appointment->date->format('D')}{$appointment->date->format('dmY')}"."\n",

                "Специалист: *{$appointment->employee->first_name} {$appointment->employee->last_name}*",
                "Дата и время: *{$appointment->date->format('d.m(D)')}: {$appointment->term->format('H:i')}*",
                "Клиент: *{$appointment->client?->first_name} {$appointment->client?->last_name}*",
                "Телефон: [{$appointment->client?->phone}]()"
            ]);

            $bot::sendMessages([
                'text'          =>  $text,
                'chat_ids'      =>  $admins,
                'reply_markup'  =>  $buttons,
                'parse_mode'    =>  'Markdown',
            ]);
        }
    }
}
