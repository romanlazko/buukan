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
        if ($employee->schedule_model == 'App\Models\TimeBasedSchedule') {

            $appointments = $employee->appointments;

            $schedules = $employee->schedule()->unoccupied()
                ->get();

            $events = [];

            foreach ($schedules as $schedule) {
                $events[] = [
                    'id' => $schedule->id,
                    'start' => $schedule->date->format('Y-m-d') . " " . $schedule->term->format('H:i'),
                    'color' => 'gray',
                    'extendedProps' => $schedule->resource()->toArray(),
                    "borderColor" => null,
                    'classNames' => "text-[6px] text-[8px] sm:text-sm my-1 p-0.5 sm:py-2 sm:p-1 border-none schedule transform transition-all duration-200",
                ];
            }

            foreach ($appointments as $appointment) {
                $statusColorMap = [
                    'new' => 'default',
                    'done' => 'green',
                    'no_done' => 'red',
                    'canceled' => 'red'
                ];

                $color = isset($statusColorMap[$appointment->status]) ? $statusColorMap[$appointment->status] : 'gray';
                    
                $events[] = [
                    'id' => $appointment->id,
                    // 'title' => "({$appointment->service->name})",
                    'start' => $appointment->date->format('Y-m-d') . " " . $appointment->term->format('H:i'),
                    'color' => $color,
                    'extendedProps' => $appointment->resource()->toArray(),
                    "borderColor" => null,
                    'classNames' => "text-[6px] text-[8px] sm:text-sm my-1 p-0.5 sm:py-2 sm:p-1 border-none",
                ];
            }

            return view('admin.company.employee.schedule.index', compact(
                'events',
                'company',
                'employee'
            ));
        }

        if ($employee->schedule_model == 'App\Models\WeekdayBasedSchedule') {
            $schedule = $employee->schedule;

            return view('admin.company.employee.schedule.weekday', compact(
                'company',
                'employee'
            ));
        }
    }

    public function exampleSchedule(Company $company, Employee $employee)
    {
        if ($employee->schedule_model == 'App\Models\TimeBasedSchedule') {

            // $appointments = $employee->appointments;

            // $schedules = $employee->schedule()->unoccupied()
            //     ->get();

            // $events = [];

            // foreach ($schedules as $schedule) {
            //     $events[] = [
            //         'id' => $schedule->id,
            //         'start' => $schedule->date->format('Y-m-d') . " " . $schedule->term->format('H:i'),
            //         'color' => 'gray',
            //         'extendedProps' => $schedule->resource()->toArray(),
            //         "borderColor" => null,
            //         'classNames' => "text-[6px] text-[8px] sm:text-sm my-1 p-0.5 sm:py-2 sm:p-1 border-none schedule transform transition-all duration-200",
            //     ];
            // }

            // foreach ($appointments as $appointment) {
            //     $statusColorMap = [
            //         'new' => 'default',
            //         'done' => 'green',
            //         'no_done' => 'red',
            //         'canceled' => 'red'
            //     ];

            //     $color = isset($statusColorMap[$appointment->status]) ? $statusColorMap[$appointment->status] : 'gray';
                    
            //     $events[] = [
            //         'id' => $appointment->id,
            //         // 'title' => "({$appointment->service->name})",
            //         'start' => $appointment->date->format('Y-m-d') . " " . $appointment->term->format('H:i'),
            //         'color' => $color,
            //         'extendedProps' => $appointment->resource()->toArray(),
            //         "borderColor" => null,
            //         'classNames' => "text-[6px] text-[8px] sm:text-sm my-1 p-0.5 sm:py-2 sm:p-1 border-none",
            //     ];
            // }

            return view('admin.company.employee.schedule.example', compact(
                'company',
                'employee'
            ));
        }

        if ($employee->schedule_model == 'App\Models\WeekdayBasedSchedule') {
            $schedule = $employee->schedule;

            return view('admin.company.employee.schedule.weekday', compact(
                'company',
                'employee'
            ));
        }
    }

    public function store(Request $request, Company $company, Employee $employee)
    {
        if ($employee->schedule_model == 'App\Models\WeekdayBasedSchedule') {

            $start_time = Carbon::parse($request->start_time);
            $end_time = Carbon::parse($request->end_time);

            $employee->schedule()->updateOrCreate([
                'weekday' => $request->weekday,
                'start_time' => $start_time->format('H:s'),
                'end_time' => $end_time->format('H:s'),
            ]);
        }

        if ($employee->schedule_model == 'App\Models\TimeBasedSchedule') {
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date ?? $request->start_date);

            $currentDate = $startDate->copy();

            while ($currentDate->lte($endDate)) {
                $employee->schedule()->updateOrCreate([
                    'date' => $currentDate->format('Y-m-d'),
                    'term' => "$request->hours:$request->minutes",
                    'service_id' => $request->service,
                ]);
                $currentDate->addDay();
            }
        }

        return redirect()->route('admin.company.employee.schedule.index', [
            'employee' => $employee, 
            'company' => $company
        ]);
    }

    public function update(Request $request, Company $company, Employee $employee, $schedule)
    {
        $schedule = $employee->schedule->find($schedule);

        $schedule->update([
            'term' => $request->term,
            'date' => $request->date,
            'service_id' => $request->service,
            'active' => $request->active,
        ]);

        return redirect()->route('admin.company.employee.schedule.index', [
            'employee' => $employee->id, 
            'company' => $company
        ]);
    }

    public function destroy(Company $company, Employee $employee, $schedule)
    {
        $schedule = $employee->schedule->find($schedule);

        $schedule->delete();

        return redirect()->route('admin.company.employee.schedule.index', [
            'employee' => $employee, 
            'company' => $company
        ]);
    }
}
