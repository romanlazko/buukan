<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Actions\GetEmployeeUnoccupiedScheduleAction;

class GetEmployeeUnoccupiedSchedule extends Controller
{
    public function __invoke(Request $request)
    {
        $employee = Employee::find($request->employee);

        if ($employee) {
            $schedules = GetEmployeeUnoccupiedScheduleAction::handle($request)
                ->pluck('term')
                ->map(function($term){
                    return $term->format('H:s');
                });
    
            return $schedules->toJson();
        }
        return [];
    }
}
