<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Calendar\LivewireCalendar;
use App\Models\Employee;
use Carbon\Carbon;

class AppointmentComponent extends LivewireCalendar
{
    public $employee;

    public function events()
    {
        $schedules = $this->employee->unoccupiedSchedules()
            ->orderBy('date')
            ->get();

        $appointments = $this->employee->appointments()
            ->orderBy('date')
            ->get();

        return $schedules->concat($appointments)
        ->map(function ($schedule) {
            return [
                'id' => $schedule->id,
                'title' => $schedule->client?->first_name,
                'date' => $schedule->date,
                'term' => $schedule->term->format('H:s'),
                'description' => $schedule->service?->name
            ];
        });

        return $schedules->concat($appointments)->sortBy('term');
    }

    public function onDayClick($year, $month, $day)
    {
        $data = [
            'date' => Carbon::parse("$year-$month-$day")
        ];

        $this->openModal('DateEventsModal', $data);
    }

    public function onEventClick($eventId)
    {
        $data = [
            'date' => Carbon::parse("$year-$month-$day")
        ];

        $this->openModal('CreateAppointmentModal', $data);
    }

    public function openModal($modal, $params = [])
    {
        $this->dispatch('set-data', $params)->to($modal);
        $this->dispatch('open')->to($modal);
        $this->dispatch('open-modal', $modal);
    }
}
