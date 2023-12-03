<?php 

namespace App\Bots\buukan_bot\Commands\UserCommands\Appointment;

use Carbon\Carbon;
use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\DB;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;
use App\Models\Company;
use App\Http\Actions\GetEmployeeUnoccupiedScheduleAction;

class ChooseDateByWeek extends Command
{
    public static $command = 'choose_date_by_week';

    public static $usage = ['choose_date_by_week'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $date = $updates->getInlineData()->getDate();

        $carbonDate = Carbon::parse($date);

        $startOfWeek    = $carbonDate->clone()->startOfWeek();
        $endOfWeek      = $carbonDate->clone()->endOfWeek();

        $company = Company::find(DB::getBot()->owner_id);

        $schedules  = GetEmployeeUnoccupiedScheduleAction::handle(
                $company->employees()->find($updates->getInlineData()->getEmployeeId()),
                null, 
                $updates->getInlineData()->getServiceId()
            )
            ->where('date', '>=', $startOfWeek)
            ->where('date', '<=', $endOfWeek)
            ->where('date', '>', now())
            ?->sortBy('date')
            ->groupBy(function ($schedule) {
                return $schedule->date;
            })
            ->map(function ($daySchedules, $dayKey) {
                $date = Carbon::parse($dayKey);
                return [array($date->format('d.m (D)'), ChooseTerm::$command, $date->format('Y-m-d'))];
            })
            ->toArray();

        $buttons = BotApi::inlineKeyboard([
            [
				array('<', 'choose_date_by_week', $startOfWeek->clone()->modify('-1 week')->format('Y-m-d')), 
				array("{$startOfWeek->format('d.m')} - {$endOfWeek->format('d.m')}", 'button', ''), 
				array('>', 'choose_date_by_week', $startOfWeek->clone()->modify('+1 week')->format('Y-m-d'))
			],
            ...$schedules,
            [array("👈 Назад", ChooseSubService::$command, '')]
        ], 'date');

        return BotApi::returnInline([
            'text'          =>  "*Выбери день:*".json_encode($updates->getInlineData()->getSubServices()),
            'chat_id'       =>  $updates->getChat()->getId(),
            'reply_markup'  =>  $buttons,
            'parse_mode'    =>  'Markdown',
            'message_id'    =>  $updates->getCallbackQuery()?->getMessage()?->getMessageId(),
        ]);
    }
}
