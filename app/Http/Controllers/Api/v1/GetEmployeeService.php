<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class GetEmployeeService extends Controller
{
    public function __invoke(Request $request)
    {
        $employee = Employee::find($request->employee);

        if ($employee) {
            $services = $employee->services->map(function($service){
                $service->total_price = $service->price->getAmount()->toInt();
                return $service;
            });

            return $services->toJson();
        }

        return [];
    }
}
