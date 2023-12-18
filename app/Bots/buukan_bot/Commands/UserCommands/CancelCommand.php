<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands;

use App\Bots\buukan_bot\Events\CancelAppointmentEvent;
use App\Models\Appointment;
use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;

class CancelCommand extends Command
{
    public static $command = 'cancel';

    public static $usage = ['cancel'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $appointment = Appointment::find($updates->getInlineData()->getAppointmentId());
        
        if (!$appointment) {
            BotApi::answerCallbackQuery([
                'callback_query_id' => $updates->getCallbackQuery()->getId(),
                'text'              => "Не могу найти эту запись, пропробуй с начала.",
                'show_alert'        => true
            ]);

            return $this->bot->executeCommand(MenuCommand::$command);
        }

        $appointment->cancel();

        if ($appointment) {
            event(new CancelAppointmentEvent($appointment));
        }
    
        return BotApi::deleteMessage([
            'chat_id'       =>  $updates->getChat()->getId(),
            'message_id'    =>  $updates->getCallbackQuery()?->getMessage()?->getMessageId(),
        ]);
    }
}