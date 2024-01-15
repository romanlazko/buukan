<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use Romanlazko\Telegram\App\Bot;
use App\Events\TomorrowAppointmentsEvent;
use App\Models\Company;

class CronController extends Controller
{
    public function __invoke()
    {
        $companies = Company::all()->each(function ($company) {
            if ($telegram_bot = $company->telegram_bots->first()){
                $bot = new Bot($telegram_bot->token);

                $appointments = $company->appointments()
                    ->where('status', 'new')
                    ->where('date', "2024-01-15")
                    ->orderBy('term')
                    ->get();

                event(new TomorrowAppointmentsEvent($appointments, $bot));
            }
        });
    }
}
