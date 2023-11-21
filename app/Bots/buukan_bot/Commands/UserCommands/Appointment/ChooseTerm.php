<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands\Appointment;

use Carbon\Carbon;
use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\DB;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;

class ChooseTerm extends Command
{
    public static $command = 'choose_term';

    public static $usage = ['choose_term'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $date = $updates->getInlineData()->getDate();
        
        $carbonDate = Carbon::parse($date);

        $schedules = DB::getBot()->company->employees()->find($updates->getInlineData()->getEmployeeId())->schedule()
            ->unoccupied($carbonDate->format('Y-m-d'))
            ->get()
            ->sortBy('term')
            ->map(function ($schedule) {
                return [array($schedule->term->format('H:i'), ConfirmAppointCommand::$command, $schedule->id)];
            })
            ->toArray();

        $buttons = BotApi::inlineKeyboard([
            ...$schedules,
            [array("👈 Назад", ChooseDateByWeek::$command, '')]
        ], 'schedule_id');

        return BotApi::returnInline([
            'text'          =>  "*Выбери время:*",
            'chat_id'       =>  $updates->getChat()->getId(),
            'reply_markup'  =>  $buttons,
            'parse_mode'    =>  'Markdown',
            'message_id'    =>  $updates->getCallbackQuery()?->getMessage()?->getMessageId(),
        ]);
    }
}
