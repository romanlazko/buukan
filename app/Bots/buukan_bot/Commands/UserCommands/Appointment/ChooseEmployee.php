<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands\Appointment;

use App\Bots\buukan_bot\Commands\UserCommands\MenuCommand;
use App\Models\User as Master;
use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\DB;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;
use App\Models\Company;

class ChooseEmployee extends Command
{
    public static $command = 'choose_employee';

    public static $usage = ['choose_employee'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $company = Company::find(DB::getBot()->owner_id);

        $employees = $company->employees()
            ?->whereIn('id', DB::getBot()->settings->employees ?? [])
            ?->whereHas('services', function($query) use ($updates){
                return $query->where('service_id', $updates->getInlineData()->getServiceId());
            })
            ?->get();

        $employees_buttons = $employees->map(function ($employee) {
            return [array($employee->user->first_name, SaveEmployee::$command, $employee->id)];
        });

        if (count($employees_buttons) > 1) {
            $buttons = BotApi::inlineKeyboard([
                ...$employees_buttons,
                [array("👈 Назад", ChooseService::$command, '')]
            ], 'employee_id');

            return BotApi::returnInline([
                'text'          =>  "*Выбери работника:*".json_encode(array_filter(explode(':', $updates->getInlineData()->getSubServices()))),
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
