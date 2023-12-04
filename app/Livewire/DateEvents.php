<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;

class DateEvents extends Component
{
    public $employee;

    public $date;

    public $events;

    public function mount(Employee $employee, $date = null)
    {
        $schedules = $this->employee->unoccupiedSchedules($this->date)
            ->orderBy('term')
            ->get()
            ->map(function ($schedule){
                $schedule->type = 'schedule';
                return $schedule;
            });

        $appointments = $this->employee->appointments()
            ->where('date', $this->date)
            ->orderBy('term')
            ->get()
            ->map(function ($appointment){
                $appointment->type = 'appointment';
                return $appointment;
            });

        $this->events = $schedules->concat($appointments)->sortBy('term');
    }

    public function render()
    {
        return view('livewire.date-events');
    }
}
