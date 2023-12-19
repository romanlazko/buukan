<?php

namespace App\Bots\buukan_bot\Http\Controllers;

use App\Bots\buukan_bot\Events\TomorrowAppointment;
use App\Bots\buukan_bot\Services\CalendarService;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Romanlazko\Telegram\App\Bot;

class CronController extends Controller
{
    public function __invoke()
    {
        $companies = Company::all()->each(function ($company) {

            // dd($company->telegram_bots->first()?->token);
            if ($company->telegram_bots->first()){
                new Bot($company->telegram_bots->first()?->token);

                $appointments = $company->appointments()
                    ->where('status', 'new')
                    ->where('date', now()->addDay()->format('Y-m-d'))
                    ->get()
                    // dd($appointments);
                    ->each(function ($appointment) {
                        event(new TomorrowAppointment($appointment));
                    });
            }
        });
    }
}
