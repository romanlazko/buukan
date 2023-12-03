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

            $employee->appointments = $schedules->concat($appointments)->sortBy('term');
            // Верните измененный объект сотрудника
            return $employee;
        });

        return view('admin.company.appointment.index', compact(
            'company',
            'employees'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Company $company)
    {
        $employee = Employee::find($request->employee);

        if (!$employee) {
            return redirect()->back()->with([
                'ok' => false,
                'description' => "Employee shood be selected" 
            ])->withInput();
        }

        $client = $company->clients()->updateOrCreate([
            'id'    => $request->client,
        ],[
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        $client->appointments()->create([
            'employee_id' => $request->employee,
            'service_id' => $request->service,
            'date' => $request->date,
            'term' => $request->term,
            'price' => $request->price,
            'comment' => $request->comment,
            'status' => $request->status,
        ])->subServices()->sync($request->sub_services);

        return redirect()->back()->with([
            'ok' => true,
            'description' => "Appointment succesfuly create"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company, Appointment $appointment)
    {
        $employee = Employee::find($request->employee);

        if (!$employee) {
            return redirect()->back()->with([
                'ok' => false,
                'description' => "Employee shood be selected" 
            ])->withInput();
        }

        $client = $company->clients()->find($request->client);

        $client->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        $appointment = $client->appointments()->find($appointment->id);

        $appointment->update([
            'employee_id' => $request->employee,
            'service_id' => $request->service,
            'date' => $request->date,
            'term' => $request->term,
            'price' => $request->price,
            'comment' => $request->comment,
            'status' => $request->status,
        ]);
        $appointment->subServices()->sync($request->sub_services);

        return redirect()->back()->with([
            'ok' => true,
            'description' => "Appointment succesfuly update"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, Appointment $appointment)
    {
        //
    }
}
