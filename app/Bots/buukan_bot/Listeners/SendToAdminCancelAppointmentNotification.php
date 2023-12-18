<?php

namespace App\Bots\buukan_bot\Listeners;

use App\Bots\buukan_bot\Events\CancelAppointmentEvent;
use Romanlazko\Telegram\App\BotApi;

class SendToAdminCancelAppointmentNotification
{
    /**
     * Handle the event.
     */
    public function handle(CancelAppointmentEvent $event): void
    {
        $appointment = $event->appointment;

        $buttons = BotApi::inlineKeyboardWithLink(
            array('text' => 'Контакт', 'url'  => "tg://user?id={$appointment->client?->telegram_chat?->chat_id}")
        );

        $text = implode("\n", [
            "❌*Отмена записи*❌"."\n",

            "#{$appointment->date->format('D')}{$appointment->date->format('dmY')}"."\n",

            "Мастер: *{$appointment->employee->first_name} {$appointment->employee->last_name}*",
            "Дата и время: *{$appointment->date->format('d.m(D)')}: {$appointment->term->format('H:s')}*",
            "Имя фамилия: *{$appointment->client?->first_name} {$appointment->client?->last_name}*",
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
