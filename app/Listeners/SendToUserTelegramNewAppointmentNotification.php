<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewAppointment;
use Romanlazko\Telegram\App\BotApi;
use App\Bots\buukan_bot\Commands\UserCommands\MenuCommand;

class SendToUserTelegramNewAppointmentNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewAppointment $event): void
    {
        $appointment = $event->appointment;

        if ($appointment->client->telegram_bot) {
            $bot = new Bot($appointment->client->telegram_bot->token);

            $buttons = $bot::inlineKeyboard([
                [array(MenuCommand::getTitle('ru'), MenuCommand::$command, '')]
            ]);
    
            $text = implode("\n", [
                "✅*Запись успешна*✅"."\n",
    
                "*{$appointment->service->name}*"."\n",
                ($appointment->sub_services->isNotEmpty() ? "Доп услуги: *{$appointment->sub_services->pluck('name')->implode(', ')}*\n" : "").
                "Специалист: *{$appointment->employee->first_name}*",
                "Дата и время: *{$appointment->date->format('d.m(D)')}: {$appointment->term->format('H:i')}*"."\n",
    
                "📍 [{$appointment->employee->company->address}](https://www.google.com/maps?q={$appointment->employee->company->address})",
    
                "Итоговая стоимость: *{$appointment->total_price}*"
            ]);
            
            $bot::sendMessage([
                'text'          =>  $text,
                'chat_id'       =>  $appointment->client?->telegram_chat?->chat_id,
                'reply_markup'  =>  $buttons,
                'parse_mode'    =>  'Markdown',
            ]);
        }
    }
}
