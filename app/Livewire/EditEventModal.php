<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Carbon\Carbon;

class EditEventModal extends Component
{
    public $employee;

    public $date = '';

    public $term = '';

    public $service_id = null;

    public $active;

    public $schedule;

    #[On('set-data')]
    public function setData($schedule_id)
    {
        $this->schedule     = $this->employee->schedule()->find($schedule_id);
        $this->date         = $this->schedule->date->format('Y-m-d');
        $this->term         = $this->schedule->term->format('H:s');
        $this->service_id   = $this->schedule?->service?->id ?? null;
        $this->active       = $this->schedule->active;
    }

    public function toDateEventsModal($date)
    {
        $this->dispatch('close-modal', 'EditEventModal');
        $this->dispatch('set-data', $date)->to(DateEventsModal::class);
        $this->dispatch('open-modal', "DateEventsModal");
    }

    public function update()
    {
        $this->schedule->update([
            'date' => $this->date,
            'term' => $this->term,
            'service_id' => !empty($this->service_id) ? $this->service_id : null,
            'active' => $this->active,
        ]);

        $this->dispatch('reset-events')->to(Calendar::class);
        
        $this->dispatch('close-modal', 'EditEventModal');

        $this->reset('schedule', 'date', 'term', 'active', 'service_id');
    }

    public function render()
    {
        return view('livewire.edit-event-modal');
    }
}
