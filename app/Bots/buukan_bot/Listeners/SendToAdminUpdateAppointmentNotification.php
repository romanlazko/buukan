<?php

namespace App\Bots\buukan_bot\Listeners;

use App\Bots\buukan_bot\Events\UpdateAppointment;
use Romanlazko\Telegram\App\BotApi;

class SendToAdminUpdateAppointmentNotification
{
    /**
     * Handle the event.
     */
    public function handle(UpdateAppointment $event): void
    {
        $appointment = $event->appointment;

        $buttons = BotApi::inlineKeyboardWithLink(
            array('text' => 'Контакт', 'url'  => "tg://user?id={$appointment->client?->telegram_chat?->chat_id}")
        );

        $text = implode("\n", [
            "🕐*Изменена дата записи*🕐"."\n",

            "#{$appointment->date->format('D')}{$appointment->date->format('dmY')}"."\n",

            "*{$appointment->service->name}*"."\n",
            ($appointment->sub_services->isNotEmpty() ? "Доп услуги: *{$appointment->sub_services->pluck('name')->implode(', ')}*\n" : "").
            "Специалист: *{$appointment->employee->first_name} {$appointment->employee->last_name}*",
            "Дата и время: *{$appointment->date->format('d.m(D)')}: {$appointment->term->format('H:i')}*",
            "Клиент: *{$appointment->client?->first_name} {$appointment->client?->last_name}*",
            "Телефон: [{$appointment->client?->phone}]()"
        ]);
        
        if ($appointment->employee->telegram_chat) {
            BotApi::sendMessage([
                'text'          =>  $text,
                'chat_id'       =>  $appointment->employee?->telegram_chat?->chat_id,
                'reply_markup'  =>  $buttons,
                'parse_mode'    =>  'Markdown',
            ]);
        }
    }
}
