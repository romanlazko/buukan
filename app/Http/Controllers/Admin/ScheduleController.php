<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Schedule\ScheduleStoreRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(Company $company, Employee $employee)
    {
        if ($employee->hasRole('employee') OR $employee->hasRole('admin') OR $employee->hasRole('administrator')) {
            return view('admin.company.employee.schedule.index', compact(
                'company',
                'employee'
            ));
        }
        
        return redirect()->route('admin.company.employee.show', [$company, $employee])->with([
            'ok' => false,
            'description' => 'Employee should have `employee` role'
        ]);
    }
}
