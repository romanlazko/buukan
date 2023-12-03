<?php

namespace App\Bots\buukan_bot;

use Carbon\Carbon;

class Config
{
    public static function getConfig()
    {
        return [
            'inline_data'       => [
                'client_id' => null,
                'employee_id' => null,
                'service_id' => null,
                'sub_services' => null,
                'count' => 0,
                'date' => now()->format('Y-m-d'),
                'schedule_id' => null,
                'appointment_id' => null,
            ],
            'lang'              => 'ru',
            'admin_ids'         => [
            ],
        ];
    }
}
