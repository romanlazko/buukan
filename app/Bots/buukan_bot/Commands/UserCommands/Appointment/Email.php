<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands\Appointment;

use App\Bots\buukan_bot\Commands\UserCommands\MenuCommand;
use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;

class Email extends Command
{
    public static $command = 'email';

    public static $usage = ['email'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $updates->getFrom()->setExpectation(AwaitEmail::$expectation);

        $buttons = BotApi::inlineKeyboard([
            [
                array("👈 Назад", CreateProfile::$command, ''),
                array(MenuCommand::getTitle('ru'), MenuCommand::$command, ''),
            ]
        ]);

        $text = implode("\n", [
            "*Напиши свой e-mail:*"."\n",
		    "*Пример*: valiliipupkin@site.com",
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