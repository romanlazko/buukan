<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;

class EmployeeEvents extends Component
{
    public $employee;

    #[Reactive]
    public $date = null;

    #[On('reset-events')]
    public function render()
    {
        $schedules = $this->employee->unoccupiedSchedules($this->date ?? now()->format('Y-m-d'))
            ->orderBy('term')
            ->get()
            ->map(function($schedule){
                return $schedule;
            });

        $appointments = $this->employee->appointments()
            ->where('date', $this->date ?? now()->format('Y-m-d'))
            ->orderBy('term')
            ->get();

        $events = $schedules->concat($appointments)->sortBy('term');

        return view('livewire.events', compact('events'));
    }
}
