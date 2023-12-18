<?php

namespace App\Bots\buukan_bot\Listeners;

use App\Bots\buukan_bot\Commands\UserCommands\MenuCommand;
use App\Bots\buukan_bot\Events\UpdateAppointment;
use Romanlazko\Telegram\App\BotApi;

class SendToUserUpdateAppointmentNotification
{
    /**
     * Handle the event.
     */
    public function handle(UpdateAppointment $event): void
    {
        $appointment = $event->appointment;

        $buttons = BotApi::inlineKeyboard([
            [array(MenuCommand::getTitle('ru'), MenuCommand::$command, '')]
        ]);

        $text = implode("\n", [
            "🕐*Изменена дата записи*🕐"."\n",

            "*{$appointment->service->name}*"."\n",
            ($appointment->subServices->isNotEmpty() ? "Доп услуги: *{$appointment->subServices->pluck('name')->implode(', ')}*\n" : "").
            "Мастер: *{$appointment->employee->first_name}*",
            "Дата и время: *{$appointment->date->format('d.m(D)')}: {$appointment->term->format('H:s')}*"."\n",

            "📍 [{$appointment->employee->company->address}](https://www.google.com/maps?q={$appointment->employee->company->address})",

            "Итоговая стоимость: *{$appointment->total_price}*"
        ]);
        BotApi::sendMessage([
            'text'          =>  $text,
            'chat_id'       =>  $appointment->client->telegram_chat->chat_id,
            'reply_markup'  =>  $buttons,
            'parse_mode'    =>  'Markdown',
        ]);
    }
}
