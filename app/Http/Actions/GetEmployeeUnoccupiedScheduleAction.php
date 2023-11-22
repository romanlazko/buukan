<?php

namespace App\Http\Actions;

use App\Models\Employee;
use Illuminate\Http\Request;

class GetEmployeeUnoccupiedScheduleAction
{
    public static function handle(Request $request)
    {
        $employee = Employee::find($request->employee);

        if ($employee) {
            return $employee->unoccupiedSchedules($request->date ?? null)
                ->orderBy('term')
                ->get()
                ->when($request->service, function($collection) use($request){
                    return $collection->whereIn('service_id', [$request->service, null]);
                });
        }
    }
}