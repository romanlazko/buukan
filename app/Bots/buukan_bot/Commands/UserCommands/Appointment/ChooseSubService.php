<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands\Appointment;

use App\Bots\buukan_bot\Commands\UserCommands\MenuCommand;
use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\DB;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;
use App\Models\Company;

class ChooseSubService extends Command
{
    public static $command = 'choose_sub_service';

    public static $usage = ['choose_sub_service'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $company = Company::find(DB::getBot()->owner_id);

        $sub_services = $company->sub_services;
            // ->filter(function ($sub_service) {
            //     if (DB::getBot()->settings?->sub_services->{$sub_service->id} ?? null) {
            //         return $sub_service;
            //     }
            // });

        $sub_services_buttons = $sub_services->map(function ($sub_service) {
            return [array($sub_service->name, ChooseSubService::$command, $sub_service->id)];
        });
        
        // if ($services->count() > 1) {
            $buttons = BotApi::inlineCheckbox([
                ...$sub_services_buttons,
                [array("Продолжить", SaveSubService::$command, '')],
                [array("👈 Назад", ChooseService::$command, '')]
            ], 'sub_services');
    
            return BotApi::returnInline([
                'text'          =>  "*Выбери дополнительную услугу:*".json_encode(explode(':', $updates->getInlineData()->getSubServices())),
                'chat_id'       =>  $updates->getChat()->getId(),
                'reply_markup'  =>  $buttons,
                'parse_mode'    =>  'Markdown',
                'message_id'    =>  $updates->getCallbackQuery()?->getMessage()?->getMessageId(),
            ]);
        // }

        // $updates->getInlineData()->getServiceId($services->first()->id);

        // return $this->bot->executeCommand(SaveService::$command);
    }
}
