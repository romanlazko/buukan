<?php

namespace App\Listeners;

use App\Events\TomorrowAppointmentsEvent;
use Romanlazko\Telegram\App\Bot;

class SendToUserTelegramTomorrowAppointmentsNotification
{
    /**
     * Handle the event.
     */
    public function handle(TomorrowAppointmentsEvent $event): void
    {
        $company = $event->company;

        if ($telegram_bot = $company->telegram_bots->first()){
            $bot = new Bot($telegram_bot->token);

            $appointments = $company->appointments()
                ->where('status', 'new')
                ->where('date', now()->addDay()->format('Y-m-d'))
                ->orderBy('term')
                ->get();

            if ($appointments->isNotEmpty()) {
                $appointments->each(function ($appointment) use ($bot){
                    
                    if ($appointment->client?->telegram_chat) {
                        $text = implode("\n", [
                            "✅*Напоминание о записи*✅"."\n",

                            "*{$appointment->service->name}*"."\n",
                            ($appointment->sub_services->isNotEmpty() ? "Доп услуги: *{$appointment->sub_services->pluck('name')->implode(', ')}*\n" : "").
                            "Специалист: *{$appointment->employee->first_name} {$appointment->employee->last_name}*",
                            "Дата и время: *{$appointment->date->format('d.m(D)')}: {$appointment->term->format('H:i')}*"."\n",
                
                            "📍 [{$appointment->company->address}](https://www.google.com/maps?q={$appointment->company->address})",
                
                            "Итоговая стоимость: *{$appointment->total_price}*"
                        ]);

                        $bot::sendMessage([
                            'text'          =>  $text,
                            'chat_id'       =>  $appointment->client->chat_id,
                            'parse_mode'    =>  'Markdown',
                        ]);
                    }
                });
            }
        }
    }
}
