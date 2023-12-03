<?php 
namespace App\Bots\buukan_bot\Commands\UserCommands\Appointment;

use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;

class AwaitEmail extends Command
{
    public static $expectation = 'await_email';

    public static $pattern = '/^await_email$/';

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $text = $updates->getMessage()?->getText();

        if ($text === null) {
            $this->handleError("*Пришлите пожалуйста e-mail в виде текста.*");
            return $this->bot->executeCommand(Email::$command);
        }

        if (!filter_var($text, FILTER_VALIDATE_EMAIL)) {
            $this->handleError("*Не верный формат e-mail.*");
            return $this->bot->executeCommand(Email::$command);
        }

        if (iconv_strlen($text) > 36){
            $this->handleError("*Слишком много символов*");
            return $this->bot->executeCommand(Email::$command);
        }

        $this->getConversation()->update([
            'email' => $text
        ]);
        return $this->bot->executeCommand(CreateProfile::$command);
    }
}