<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands\Appointment;

use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\DB;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;
use App\Models\Company;

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
        $company = Company::find(DB::getBot()->owner_id);

        $service = $company->services()->find($updates->getInlineData()->getServiceId());

        $sub_services = $company->sub_services()->whereIn('id', [array_filter(explode(':', $updates->getInlineData()->getsub_services()))])->get();

        $employee = $company->employees()->find($updates->getInlineData()->getEmployeeId());

        $schedule = $employee->schedule()->find($updates->getInlineData()->getScheduleId());

        if (!$schedule) {
            BotApi::answerCallbackQuery([
                'callback_query_id' => $updates->getCallbackQuery()->getId(),
                'text'              => "Этой записи уже не существует, начни с начала",
                'show_alert'        => true
            ]);

            return $this->bot->executeCommand(AppointmentCommand::$command);
        }
    
        $buttons = BotApi::inlineKeyboard([
            [array("👌 Подтвердить", Appoint::$command, '')],
            [array("👈 Назад", ChooseTerm::$command, '')]
        ]);

        $text = implode("\n", [
            "*Пожалуйста, проверь все данные, и подтверди запись:*"."\n",
            "*{$service->name}*"."\n",
            ($sub_services->isNotEmpty() ? "Доп услуги: *{$sub_services->pluck('name')->implode(', ')}*\n" : "").
            "Мастер: *{$employee->first_name} {$employee->last_name}*",
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