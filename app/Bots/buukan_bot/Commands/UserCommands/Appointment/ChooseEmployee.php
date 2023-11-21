<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands\Appointment;

use App\Bots\buukan_bot\Commands\UserCommands\MenuCommand;
use App\Models\User as Master;
use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\DB;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;

class ChooseEmployee extends Command
{
    public static $command = 'choose_employee';

    public static $usage = ['choose_employee'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $employees = DB::getBot()->company->employees
            ->filter(function ($employee) {
                if (DB::getBot()->settings->employees->{$employee->id} ?? null) {
                    return $employee;
                }
            });

        $employees_buttons = $employees->map(function ($employee) {
            return [array($employee->user->first_name, SaveEmployee::$command, $employee->id)];
        });

        if (count($employees_buttons) > 1) {
            $buttons = BotApi::inlineKeyboard([
                ...$employees_buttons,
                [array("👈 Назад", MenuCommand::$command, '')]
            ], 'employee_id');

            return BotApi::returnInline([
                'text'          =>  "*Выбери работника:*",
                'chat_id'       =>  $updates->getChat()->getId(),
                'reply_markup'  =>  $buttons,
                'parse_mode'    =>  'Markdown',
                'message_id'    =>  $updates->getCallbackQuery()?->getMessage()?->getMessageId(),
            ]);
        }

        $updates->getInlineData()->getEmployeeId($employees->first()->id);

        return $this->bot->executeCommand(SaveEmployee::$command);
    }
}
