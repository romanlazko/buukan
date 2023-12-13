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

        $employees_buttons = $company->employees()
            ?->whereJsonContains('settings->is_available_on_telegram', 'on')
            ?->whereHas('services', function($query) use($updates){
                return $query->where('service_id', $updates->getInlineData()->getServiceId());
            })
            ?->get()
            ?->map(function ($employee) {
                return [array("$employee->first_name $employee->last_name", SaveEmployee::$command, $employee->id)];
            });

        $buttons = BotApi::inlineKeyboard([
            ...$employees_buttons,
            [array("👈 Назад", ChooseService::$command, '')]
        ], 'employee_id');

        return BotApi::returnInline([
            'text'          =>  "*Выбери мастера:*",
            'chat_id'       =>  $updates->getChat()->getId(),
            'reply_markup'  =>  $buttons,
            'parse_mode'    =>  'Markdown',
            'message_id'    =>  $updates->getCallbackQuery()?->getMessage()?->getMessageId(),
        ]);
    }
}
