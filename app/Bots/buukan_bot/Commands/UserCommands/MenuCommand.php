<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands;

use App\Bots\buukan_bot\Commands\UserCommands\Appointment\AppointmentCommand;
use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\DB;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;

class MenuCommand extends Command
{
    public static $command = '/menu';

    public static $title = [
        'ru' => '🏠 Главное меню',
        'en' => '🏠 Menu'
    ];

    public static $usage = ['/menu', 'menu', 'Главное меню', 'Menu'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $updates->getInlineData()->unset();

        $buttons = BotApi::inlineKeyboard([
            [array(AppointmentCommand::getTitle(), AppointmentCommand::$command, '')],
            [array(MyAppointments::getTitle(), MyAppointments::$command, '')],
        ]);
        
        $data = [
            'text'          =>  DB::getBot()->settings->message->ru,
            'chat_id'       =>  $updates->getChat()->getId(),
            'reply_markup'  =>  $buttons,
            'parse_mode'    =>  'Markdown',
            'message_id'    =>  $updates->getCallbackQuery()?->getMessage()->getMessageId(),
            'disable_web_page_preview' => true
        ];

        return BotApi::returnInline($data);
    }
}