<?php

namespace App\Http\Actions;

use App\Models\Employee;
use Illuminate\Http\Request;

class GetEmployeeUnoccupiedScheduleAction
{
    public static function handle(Employee|null $employee = null, $date = null, $service = null)
    {
        if ($employee) {
            return $employee->unoccupiedSchedules($date)
                ->orderBy('term')
                ->get()
                ->where('active', 1)
                ->when($service, function($collection) use($service){
                    return $collection->whereIn('service_id', [$service, null]);
                });
        }
    }
}