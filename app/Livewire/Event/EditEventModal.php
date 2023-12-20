<?php

namespace App\Livewire\Event;

use Livewire\Component;
use Livewire\Attributes\On;
use Carbon\Carbon;
use App\Livewire\Traits\Modal;
use App\Models\Schedule;
use App\Models\Employee;

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
    public function setData($data)
    {
        $this->reset();

        $this->schedule     = Schedule::find($data['schedule_id']);
        $this->employee     = $this->schedule->employee;
        $this->date         = $this->schedule?->date->format('Y-m-d');
        $this->term         = $this->schedule?->term->format('H:i');
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

        $this->dispatch('reset-events');
        
        $this->openModal('DateEventsModal', [
            'dateStr' => $this->date
        ]);

        $this->reset('schedule', 'date', 'term', 'active', 'service_id');
    }

    public function delete()
    {
        $this->schedule->delete();

        $this->dispatch('reset-events');

        $this->openModal('DateEventsModal', [
            'dateStr' => $this->date
        ]);
    }

    public function render()
    {
        return view('livewire.event.edit-modal');
    }
}
