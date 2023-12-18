<?php

namespace App\Bots\buukan_bot\Listeners;

use App\Bots\buukan_bot\Commands\UserCommands\Appointment\AppointmentCommand;
use App\Bots\buukan_bot\Commands\UserCommands\MenuCommand;
use App\Bots\buukan_bot\Events\CancelAppointmentEvent;
use Romanlazko\Telegram\App\BotApi;

class SendToUserCancelAppointmentNotification
{
    /**
     * Handle the event.
     */
    public function handle(CancelAppointmentEvent $event): void
    {
        $appointment = $event->appointment;

        $buttons = BotApi::inlineKeyboard([
            [array("Записаться на другую дату", AppointmentCommand::$command, '')],
            [array(MenuCommand::getTitle('ru'), MenuCommand::$command, '')]
        ]);

        BotApi::sendMessage([
            'text'          =>  "❌*Запись успешно отменена*❌",
            'chat_id'       =>  $appointment->client?->telegram_chat?->chat_id,
            'reply_markup'  =>  $buttons,
            'parse_mode'    =>  'Markdown',
        ]);
    }
}
