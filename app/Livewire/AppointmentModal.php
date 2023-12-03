<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Carbon\Carbon;

class AppointmentModal extends Component
{
    public $employee;
    
    public $appointment;

    public function render()
    {
        return view('livewire.appointment-modal');
    }

    #[On('set-data')]
    public function setData($info = null)
    {
        $this->appointment = $this->employee->appointments()->findOr($info['id'], function() use ($info){
            return $this->employee->schedule()->find($info['id']);
        });

        // $this->date = Carbon::parse($info['dateStr'] ?? $info['startStr'] ?? null);
    }

    public function toDateEventsModal($date)
    {
        $this->dispatch('close-modal', 'AppointmentModal');
        $this->dispatch('set-data', $date)->to(DateEventsModal::class);
        $this->dispatch('open-modal', "DateEventsModal");
    }
}
