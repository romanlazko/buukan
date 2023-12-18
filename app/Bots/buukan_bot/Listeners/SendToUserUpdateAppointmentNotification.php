<?php

namespace App\Bots\valeri_beautybar_bot\Listeners;

use App\Bots\valeri_beautybar_bot\Commands\UserCommands\MenuCommand;
use App\Bots\valeri_beautybar_bot\Events\UpdateAppointment;
use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Telegram;

class SendToUserUpdateAppointmentNotification
{

    /**
     * Create the event listener.
     */
    public function __construct(private Telegram $telegram)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(UpdateAppointment $event): void
    {
        $appointment = $event->appointment;

        $buttons = $this->telegram::inlineKeyboard([
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
        $this->telegram::sendMessage([
            'text'          =>  $text,
            'chat_id'       =>  $appointment->client->telegram_chat->chat_id,
            'reply_markup'  =>  $buttons,
            'parse_mode'    =>  'Markdown',
        ]);
    }
}
