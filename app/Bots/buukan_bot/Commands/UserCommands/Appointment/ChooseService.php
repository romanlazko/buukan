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

        $services_buttons = $company->services()
            ?->active()
            ?->whereJsonContains('settings->is_available_on_telegram', 'on')
            ?->get()
            ?->map(function ($service) {
                $service_name = $service->name . ": " . (isset($service->settings->is_price_from) ? 'от ' : '') . $service->price;

                return [array($service_name, SaveService::$command, $service->id)];
            });
        
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
    }
}
