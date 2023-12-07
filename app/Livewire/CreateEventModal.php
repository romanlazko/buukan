<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Carbon\Carbon;

class CreateEventModal extends Component
{
    public $employee;

    public $start_date = ''; 

    public $end_date = '';

    public $hours = '00';

    public $minutes = '00';

    public $service_id = null;

    #[On('set-data')]
    public function setData($info = [])
    {
        $this->start_date   = Carbon::parse($info['dateStr'] ?? $info['startStr'] ?? null)->format('Y-m-d');
        $this->end_date     = isset($info['endStr']) 
            ? Carbon::parse($info['endStr'])->subDay()->format('Y-m-d') 
            : $this->start_date;
    }

    public function toDateEventsModal($date)
    {
        $this->dispatch('close-modal', 'CreateEventModal');
        $this->dispatch('set-data', $date)->to(DateEventsModal::class);
        $this->dispatch('open-modal', "DateEventsModal");
    }

    public function store()
    {
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
        $currentDate = $startDate->copy();

        while ($currentDate->lte($endDate)) {
            $schedule = $this->employee->schedule()->updateOrCreate([
                'date' => $currentDate->format('Y-m-d'),
                'term' => "$this->hours:$this->minutes",
                'service_id' => !empty($this->service_id) ? $this->service_id : null,
            ]);

            $currentDate->addDay();
        }

        $this->dispatch('reset-events')->to(Calendar::class);
        
        $this->dispatch('close-modal', 'CreateEventModal');

        $this->reset('start_date', 'end_date', 'hours', 'minutes', 'service_id');
    }

    public function render()
    {
        return view('livewire.create-event-modal');
    }
}
