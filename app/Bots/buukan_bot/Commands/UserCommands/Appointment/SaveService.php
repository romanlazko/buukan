<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands\Appointment;

use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;

class SaveService extends Command
{
    public static $command = 'save_service';

    public static $usage = ['save_service'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        return $this->bot->executeCommand(ChooseDateByWeek::$command);
    }
}
