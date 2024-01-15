<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use Romanlazko\Telegram\App\Bot;
use App\Events\TomorrowAppointmentsEvent;
use App\Models\Company;

class TomorrowAppointmentsController extends Controller
{
    public function __invoke()
    {
        $companies = Company::all()->each(function ($company) {
            event(new TomorrowAppointmentsEvent($company));
        });
    }
}
