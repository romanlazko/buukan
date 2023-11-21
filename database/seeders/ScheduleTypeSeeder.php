<?php

namespace Database\Seeders;

use App\Models\ScheduleType;
use App\Models\WeekdaySchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScheduleType::create([
            'name' => 'WeekdayBasedSchedule',
            'model' => 'App\Models\WeekdayBasedSchedule'
        ]);

        ScheduleType::create([
            'name' => 'TimeBasedSchedule',
            'model' => 'App\Models\TimeBasedSchedule'
        ]);
    }
}
