<?php

namespace App\Livewire;

use App\Livewire\CreateEventModal;
use App\Livewire\DateEventsModal;
use Livewire\Component;
use Livewire\Attributes\On;

class Calendar extends Component
{
    public $employee;

    public $company;
    
    public $events = [];

    public $activeModal;

    public function mount()
    {
        $this->company  = $this->employee->company;
        $appointments   = $this->employee->appointments;
        $schedules      = $this->employee->schedule()->unoccupied()->get();

        foreach ($schedules as $schedule) {
            $this->events[] = [
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
                
            $this->events[] = [
                'id' => $appointment->id,
                'start' => $appointment->date->format('Y-m-d') . " " . $appointment->term->format('H:i'),
                'color' => $color,
                'extendedProps' => $appointment->resource()->toArray(),
                "borderColor" => null,
                'classNames' => "text-[6px] text-[8px] sm:text-sm my-1 p-0.5 sm:py-2 sm:p-1 border-none",
            ];
        }
    }

    #[On('reset-events')]
    public function setEvents()
    {
        $this->reset('events');
        $appointments   = $this->employee->appointments;
        $schedules      = $this->employee->schedule()->unoccupied()->get();

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
                'start' => $appointment->date->format('Y-m-d') . " " . $appointment->term->format('H:i'),
                'color' => $color,
                'extendedProps' => $appointment->resource()->toArray(),
                "borderColor" => null,
                'classNames' => "text-[6px] text-[8px] sm:text-sm my-1 p-0.5 sm:py-2 sm:p-1 border-none",
            ];
        }

        $this->dispatch('resetEvents', $events);
    }

    #[On('openModal')]
    public function openModal($modal, $params = [])
    {
        
        $this->dispatch('set-data', $params)->to($modal);
        $this->dispatch('open')->to($modal);
        $this->dispatch('open-modal', $modal);
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
