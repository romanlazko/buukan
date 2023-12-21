<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands\Appointment;

use App\Models\Client;
use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\DB;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;
use Romanlazko\Telegram\App\Entities\InlineData;

class AppointmentCommand extends Command
{
    public static $command = 'appointment';

    public static $title = [
        'ru' => 'Записаться на услугу',
        'en' => 'Appointment'
    ];

    public static $usage = ['appointment'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $this->getConversation()->clear();

        $client = Client::where('telegram_chat_id', DB::getChat($updates->getChat()->getId())->id)->first();

        if ($client) {
            $appointments = $client
                ->appointments()
                ->where('status', 'new')
                ->where('date', '>', now())
                ->get();

            if ($appointments->count() >= (DB::getBot()->settings->max_active_appointments ?? 1)) {
                return BotApi::answerCallbackQuery([
                    'callback_query_id' => $updates->getCallbackQuery()->getId(),
                    'text'              => "Что бы записаться на новый термин, нужно отменить старую запись",
                    'show_alert'        => true
                ]);
            }
    
            $this->getConversation()->update(
                $client?->toArray() ?? []
            );
        }
    
        return $this->bot->executeCommand(CreateProfile::$command);
    }
}