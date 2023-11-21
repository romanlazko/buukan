<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands\Appointment;

use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\DB;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;

class ConfirmAppointCommand extends Command
{
    public static $command = 'confirm_appoint';

    public static $title = [
        'ru' => '✅ Подтвердить запись',
        'en' => '✅ Confirm appoint'
    ];

    public static $usage = ['confirm_appoint'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $schedule = DB::getBot()->company->employees()
            ->find($updates->getInlineData()->getEmployeeId())
            ->schedule()
            ->find($updates->getInlineData()->getScheduleId());

        if (!$schedule) {
            BotApi::answerCallbackQuery([
                'callback_query_id' => $updates->getCallbackQuery()->getId(),
                'text'              => "Этой записи уже не существует, начни с начала",
                'show_alert'        => true
            ]);

            return $this->bot->executeCommand(AppointmentCommand::$command);
        }

        // if ($schedule?->appointments) {
        //     foreach ($schedule->appointments as $appointment) {
        //         if ($appointment->status == 'new') {
        //             BotApi::answerCallbackQuery([
        //                 'callback_query_id' => $updates->getCallbackQuery()->getId(),
        //                 'text'              => "Это место уже занято, начни с начала",
        //                 'show_alert'        => true
        //             ]);

        //             return $this->bot->executeCommand(AppointmentCommand::$command);
        //         }
        //     }
        // }
    
        $buttons = BotApi::inlineKeyboard([
            [array("👌 Подтвердить", Appoint::$command, '')],
            [array("👈 Назад", ChooseTerm::$command, '')]
        ]);

        $text = implode("\n", [
            "*Пожалуйста, проверь все данные, и подтверди запись:*"."\n",
            "Мастер: *{$schedule->employee->user->first_name} {$schedule->employee->user->last_name}*",
            "Дата и время: *{$schedule->date->format('d.m(D)')}: {$schedule->term->format('H:i')}*"."\n",
            "Если все правильно, нажми на кнопку *«Подтвердить»*"
        ]);

        return BotApi::returnInline([
            'text'          =>  $text,
            'chat_id'       =>  $updates->getChat()->getId(),
            'reply_markup'  =>  $buttons,
            'parse_mode'    =>  'Markdown',
            'message_id'    =>  $updates->getCallbackQuery()?->getMessage()?->getMessageId(),
        ]);
    }
}