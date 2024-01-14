<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewAppointmentEvent;
use Romanlazko\Telegram\App\Bot;

class SendToAdminTelegramNewAppointmentNotification
{
    /**
     * Handle the event.
     */
    public function handle(NewAppointmentEvent $event): void
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
                "✅*Новая запись на услугу*✅",
                "Через: #{$appointment->via}"."\n",

                "#{$appointment->date->format('D')}{$appointment->date->format('dmY')}"."\n",

                "*{$appointment->service->name}*"."\n",
                ($appointment->sub_services->isNotEmpty() ? "Доп услуги: *{$appointment->sub_services->pluck('name')->implode(', ')}*\n" : "").
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
