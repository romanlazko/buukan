<?php

namespace App\Livewire\Calendar;

use Livewire\Component;
use Livewire\Attributes\Reactive;

class Events extends Component
{
    public $events;
    
    #[Reactive]
    public $date;

    public function render()
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
                return $appointment;
            });

        $events = $schedules->concat($appointments)->sortBy('term');

        return view('livewire.events');
    }
}
