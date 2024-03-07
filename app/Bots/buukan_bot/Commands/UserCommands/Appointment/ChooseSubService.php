<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands\Appointment;

use App\Bots\buukan_bot\Commands\UserCommands\MenuCommand;
use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\DB;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;
use App\Models\Company;
use App\Models\Employee;

class ChooseSubService extends Command
{
    public static $command = 'choose_sub_service';

    public static $usage = ['choose_sub_service'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $employee = Employee::find($updates->getInlineData()->getEmployeeId());

        $sub_services = $employee->sub_services;

        if ($sub_services->isNotEmpty()) {
            $sub_services_buttons = $sub_services->map(function ($sub_service) {
                $service_name = $sub_service->name . ": " . (isset($sub_service->settings->is_price_from) ? 'от ' : '') . $sub_service->price;
    
                return [array($service_name, ChooseSubService::$command, $sub_service->id)];
            });

            $buttons = BotApi::inlineCheckbox([
                ...$sub_services_buttons,
                [array("Продолжить", SaveSubService::$command, '')],
                [array("👈 Назад", ChooseService::$command, '')]
            ], 'sub_services');
    
            return BotApi::returnInline([
                'text'          =>  "*Выбери дополнительную услугу:*",
                'chat_id'       =>  $updates->getChat()->getId(),
                'reply_markup'  =>  $buttons,
                'parse_mode'    =>  'Markdown',
                'message_id'    =>  $updates->getCallbackQuery()?->getMessage()?->getMessageId(),
            ]);
        }

        return $this->bot->executeCommand(SaveSubService::$command);
    }
}
