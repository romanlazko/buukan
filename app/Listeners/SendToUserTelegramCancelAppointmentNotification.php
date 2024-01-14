<?php

namespace App\Listeners;

use App\Bots\buukan_bot\Commands\UserCommands\Appointment\AppointmentCommand;
use App\Bots\buukan_bot\Commands\UserCommands\MenuCommand;
use App\Events\CancelAppointmentEvent;
use Romanlazko\Telegram\App\Bot;

class SendToUserTelegramCancelAppointmentNotification
{
    /**
     * Handle the event.
     */
    public function handle(CancelAppointmentEvent $event): void
    {
        $appointment = $event->appointment;
        
        if ($telegram_bot = $appointment->company->telegram_bots->first()) {
            $bot = new Bot($telegram_bot->token);

            $buttons = $bot::inlineKeyboard([
                [array("Записаться на другую дату", AppointmentCommand::$command, '')],
                [array(MenuCommand::getTitle('ru'), MenuCommand::$command, '')]
            ]);

            $bot::sendMessage([
                'text'          =>  "❌*Запись успешно отменена*❌",
                'chat_id'       =>  $appointment->client?->chat_id,
                'reply_markup'  =>  $buttons,
                'parse_mode'    =>  'Markdown',
            ]);
        }
    }
}
