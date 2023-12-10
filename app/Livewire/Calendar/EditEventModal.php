<?php

namespace App\Livewire\Calendar;

use Livewire\Component;
use Livewire\Attributes\On;
use Carbon\Carbon;
use App\Livewire\Traits\Modal;

class EditEventModal extends Component
{
    use Modal;

    public $employee;

    public $date = '';

    public $term = '';

    public $service_id = null;

    public $active;

    public $schedule;

    #[On('set-data')]
    public function setData($schedule_id)
    {
        $this->reset('service_id', 'schedule', 'date', 'term', 'active');

        $this->schedule     = $this->employee->schedule()->find($schedule_id);
        $this->date         = $this->schedule?->date->format('Y-m-d');
        $this->term         = $this->schedule?->term->format('H:s');
        $this->service_id   = $this->schedule?->service?->id ?? null;
        $this->active       = $this->schedule?->active;
    }

    public function update()
    {
        $this->schedule->update([
            'date' => $this->date,
            'term' => $this->term,
            'service_id' => !empty($this->service_id) ? $this->service_id : null,
            'active' => $this->active,
        ]);

        $this->dispatch('reset-events')->to(Index::class);
        
        $this->openModal('DateEventsModal', [
            'dateStr' => $this->date
        ]);

        $this->reset('schedule', 'date', 'term', 'active', 'service_id');
    }

    public function delete()
    {
        $this->schedule->delete();
    }

    public function render()
    {
        return view('livewire.calendar.edit-event-modal');
    }
}
