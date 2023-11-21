<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands\Appointment;

use App\Models\Client;
use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\DB;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;

class SaveProfile extends Command
{
    public static $command = 'save_profile';

    public static $usage = ['save_profile'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $notes = $this->getConversation()->notes;

        $fields = ['first_name', 'last_name', 'phone'];

        $array = [];

        foreach ($fields as $field) {
            if (empty($notes[$field])) {
                return BotApi::answerCallbackQuery([
                    'callback_query_id' => $updates->getCallbackQuery()->getId(),
                    'text'              => 'Пожалуйста, заполни все поля.',
                    'show_alert'        => true
                ]);
            }
            else {
                $array[$field] = $notes[$field];
            }
        }


        $client = DB::getBot()->company->clients()->updateOrCreate([
                'telegram_chat_id' => DB::getChat($updates->getChat()->getId())->id,
            ],
            $array
        );

        $updates->getInlineData()->getClientId($client->id);

        return $this->bot->executeCommand(ChooseEmployee::$command);
    }
}
