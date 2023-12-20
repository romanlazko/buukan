<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands;

use App\Models\Appointment;
use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;
use Romanlazko\Telegram\App\DB;

class ShowMyAppointment extends Command
{
    public static $command = 'show_my_appointment';

    public static $usage = ['show_my_appointment'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $appointment = Appointment::find($updates->getInlineData()->getAppointmentId());
        
        if (!$appointment) {
            BotApi::answerCallbackQuery([
                'callback_query_id' => $updates->getCallbackQuery()->getId(),
                'text'              => "Не могу найти эту запись, давай попробуем с начала",
                'show_alert'        => true
            ]);

            return $this->bot->executeCommand(MenuCommand::$command);
        }

        $buttons = BotApi::inlineKeyboard([
            isset(DB::getBot()->settings->can_client_cancel_appointment) ? [array(CancelAppointmentCommand::getTitle(), CancelAppointmentCommand::$command, '')] : [],
            [array(MenuCommand::getTitle(), MenuCommand::$command, '')]
        ]);

        $text = implode("\n", [
            "*{$appointment->service->name}*"."\n",
            ($appointment->sub_services->isNotEmpty() ? "Доп услуги: *{$appointment->sub_services->pluck('name')->implode(', ')}*\n" : "").
            "Мастер: *{$appointment->employee->first_name}*",
            "Дата и время: *{$appointment->date->format('d.m(D)')}: {$appointment->term->format('H:i')}*"."\n",

            "📍 [{$appointment->employee->company->address}](https://www.google.com/maps?q={$appointment->employee->company->address})",

            "Итоговая стоимость: *{$appointment->total_price}*"
        ]);

        return BotApi::returnInline([
            'text'          =>  $text,
            'chat_id'       =>  $updates->getChat()->getId(),
            'reply_markup'  =>  $buttons,
            'parse_mode'    =>  'Markdown',
            'message_id'    =>  $updates->getCallbackQuery()?->getMessage()->getMessageId(),
        ]);
    }
}