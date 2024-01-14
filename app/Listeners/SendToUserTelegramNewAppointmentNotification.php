<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewAppointmentEvent;
use Romanlazko\Telegram\App\Bot;
use App\Bots\buukan_bot\Commands\UserCommands\MenuCommand;

class SendToUserTelegramNewAppointmentNotification
{
    /**
     * Handle the event.
     */
    public function handle(NewAppointmentEvent $event): void
    {
        $appointment = $event->appointment;

        if ($telegram_bot = $appointment->company->telegram_bots->first() AND $appointment->client?->chat_id) {
            $bot = new Bot($telegram_bot->token);

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
                'chat_id'       =>  $appointment->client?->chat_id,
                'reply_markup'  =>  $buttons,
                'parse_mode'    =>  'Markdown',
            ]);
        }
    }
}
