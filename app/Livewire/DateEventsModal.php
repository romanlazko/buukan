<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

use Carbon\Carbon;

class DateEventsModal extends Component
{
    public $employee;

    public $date;

    #[On('set-data')]
    public function setData($data = [])
    {
        $this->date = Carbon::parse($data['dateStr'] ?? $data['startStr'] ?? null);
    }

    public function createSchedule($params = null)
    {
        $this->dispatch('close-modal', 'DateEventsModal');
        $this->dispatch('set-data', ['dateStr' => $this->date->format('Y-m-d')])->to(CreateEventModal::class);
        $this->dispatch('open-modal', 'CreateEventModal');
    }

    public function editSchedule($params = null)
    {
        $this->dispatch('close-modal', 'DateEventsModal');
        $this->dispatch('set-data', $params)->to(EditEventModal::class);
        $this->dispatch('open-modal', 'EditEventModal');
    }

    public function appointmentModal($params = null)
    {
        $this->dispatch('close-modal', 'DateEventsModal');
        $this->dispatch('set-data', $params)->to(AppointmentModal::class);
        $this->dispatch('open-modal', 'AppointmentModal');
    }

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
                $appointment->type = 'appointment';
                return $appointment;
            });

        $events = $schedules->concat($appointments)->sortBy('term');

        return view('livewire.date-events-modal', compact('events'));
    }
}
