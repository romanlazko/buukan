<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands\Appointment;

use App\Bots\buukan_bot\Commands\UserCommands\Appointment\AppointmentCommand;
use App\Models\Client;
use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\DB;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;
use App\Models\Company;
use App\Bots\buukan_bot\Events\NewAppointment;

class Appoint extends Command
{
    public static $command = 'appoint';

    public static $title = [
        'ru' => 'Записаться',
        'en' => 'Appoint'
    ];

    public static $usage = ['appoint'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $company = Company::find(DB::getBot()->owner_id);

        $client = $company->clients()->find($updates->getInlineData()->getClientId());
        
        $schedule = $company->employees()
            ->find($updates->getInlineData()->getEmployeeId())
            ->schedule()
            ->find($updates->getInlineData()->getScheduleId());

        if (!$schedule) {
            BotApi::answerCallbackQuery([
                'callback_query_id' => $updates->getCallbackQuery()->getId(),
                'text'              => "Этой записи уже не существует, начнем с начала",
                'show_alert'        => true
            ]);

            return $this->bot->executeCommand(AppointmentCommand::$command);
        }

        $appointment = $client->appointments()->create([
            'employee_id' => $updates->getInlineData()->getEmployeeId(),
            'service_id' => $updates->getInlineData()->getServiceId(),
            'date' => $schedule->date->format('Y-m-d'),
            'term' => $schedule->term->format('H:i'),
            'status' => 'new',
        ]);
        $appointment->sub_services()->sync(array_filter(explode(':', $updates->getInlineData()->getSubServices())));

        if ($appointment) {
            event(new NewAppointment($appointment));
        }
    
        return BotApi::deleteMessage([
            'chat_id'       =>  $updates->getChat()->getId(),
            'message_id'    =>  $updates->getCallbackQuery()?->getMessage()?->getMessageId(),
        ]);
    }
}