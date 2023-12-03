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

class ChooseService extends Command
{
    public static $command = 'choose_service';

    public static $usage = ['choose_service'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $company = Company::find(DB::getBot()->owner_id);

        // $services = $company->services
        //     ->map(function ($service) use ($updates){
        //         // if ($master->just_ref) {
        //         //     if ($master->telegram_chat_id == $updates->getChat()->getReferal()) {
        //         //         return [array($master->name, SaveMaster::$command, $master->id)];
        //         //     }
        //         //     
        //         // }
        //         if (DB::getBot()->settings->services->{$service->id} ?? null) {
        //             return [array($service->name, SaveService::$command, $service->id)];
        //         }

        //         return [];
        //     });

        // $services = $company->services
        //     ->filter(function ($service) {
        //         if (DB::getBot()->settings->services->{$service->id} ?? null) {
        //             return $service;
        //         }
        //     });

        $services = $company->services()
            ->whereIn('id', DB::getBot()->settings->services ?? [])
            ?->get();

        $services_buttons = $services->map(function ($service) {
            return [array($service->name, SaveService::$command, $service->id)];
        });
        
        // if ($services->count() > 1) {
            $buttons = BotApi::inlineKeyboard([
                ...$services_buttons,
                [array("👈 Назад", CreateProfile::$command, '')]
            ], 'service_id');
    
            return BotApi::returnInline([
                'text'          =>  "*Выбери услугу:*",
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
