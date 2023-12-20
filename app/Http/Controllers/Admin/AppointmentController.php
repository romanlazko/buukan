<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\StoreRequest;
use App\Models\Appointment;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Company $company)
    {
        $employees = $company->employees->map(function ($employee) {
            $schedules = $employee->unoccupiedSchedules(request('date', now()->format('Y-m-d')))
                ->orderBy('term')
                ->get()
                ->map(function($schedule){
                    return $schedule;
                });

            $appointments = $employee->appointments()
                ->where('date', request('date', now()->format('Y-m-d')))
                ->orderBy('term')
                ->get();

            $employee->events = $schedules->concat($appointments)->sortBy('term');
            
            return $employee;
        });

        return view('admin.company.appointment.index', compact(
            'company',
            'employees'
        ));
    }
}
