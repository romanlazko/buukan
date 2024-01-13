<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewAppointment;
use Romanlazko\Telegram\App\BotApi;

class SendToAdminTelegramNewAppointmentNotification
{
    /**
     * Handle the event.
     */
    public function handle(NewAppointment $event): void
    {
        $appointment = $event->appointment;

        if ($appointment->client->telegram_bot) {
            $bot = new Bot($appointment->client->telegram_bot->token);

            $admins = $bot->getAdmins()->toArray();

            $buttons = $bot::inlineKeyboardWithLink(
                array('text' => 'Контакт', 'url'  => "tg://user?id={$appointment->client?->telegram_chat?->chat_id}")
            );

            $text = implode("\n", [
                "✅*Новая запись на услугу*✅"."\n",

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
