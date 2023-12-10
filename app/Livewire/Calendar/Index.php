<?php

namespace App\Livewire\Calendar;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Traits\Modal;

class Index extends Component
{
    use Modal;
    
    public $employee;

    public $company;
    
    public $events = [];

    public $activeModal;

    public function mount()
    {
        $this->company  = $this->employee->company;
        $this->events   = $this->setEvents();
    }

    private function setEvents()
    {
        $appointments   = $this->employee->appointments;
        $schedules      = $this->employee->schedule()->unoccupied()->get();
        $events         = [];

        $statusColorMap = [
            'new' => 'default',
            'done' => 'green',
            'no_done' => 'red',
            'canceled' => 'red'
        ];

        foreach ($schedules as $schedule) {
            $events[] = [
                'id' => 'schedule_'.$schedule->id,
                'start' => $schedule->date->format('Y-m-d') . " " . $schedule->term->format('H:i'),
                'color' => 'gray',
                'extendedProps' => $schedule->resource->toArray(),
                "borderColor" => null,
                'classNames' => "text-[6px] text-[8px] sm:text-sm my-1 p-0.5 sm:py-2 sm:p-1 border-none schedule transform transition-all duration-200",
            ];
        }

        foreach ($appointments as $appointment) {
            $events[] = [
                'id' => 'appointment_'.$appointment->id,
                'start' => $appointment->date->format('Y-m-d') . " " . $appointment->term->format('H:i'),
                'color' => isset($statusColorMap[$appointment->status]) ? $statusColorMap[$appointment->status] : 'gray',
                'extendedProps' => $appointment->resource->toArray(),
                "borderColor" => null,
                'classNames' => "text-[6px] text-[8px] sm:text-sm my-1 p-0.5 sm:py-2 sm:p-1 border-none",
            ];
        }

        return $events;
    }

    #[On('reset-events')]
    public function resetEvents()
    {
        $this->reset('events');

        $this->events = $this->setEvents();

        $this->dispatch('resetEvents', $this->setEvents());
    }

    public function render()
    {
        return view('livewire.calendar.index');
    }
}
