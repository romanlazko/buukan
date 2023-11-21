<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class GetEmployeeUnoccupiedSchedule extends Controller
{
    public function __invoke(Request $request)
    {
        $employee = Employee::find($request->employee);

        if ($employee) {
            $schedules = $employee->unoccupiedSchedules($request->date)
                ->orderBy('term')
                ->get()
                ->when($request->service, function($collection) use($request){
                    return $collection->where('service_id', $request->service);
                })
                ->pluck('term')
                ->map(function($term){
                    return $term->format('H:s');
                });
    
            return $schedules->toJson();
        }

        return [];
    }
}
