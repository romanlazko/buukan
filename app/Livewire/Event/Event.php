<?php

namespace App\Livewire\Event;

use Livewire\Component;

class Event extends Component
{
    public $event;

    public function render()
    {
        return view('livewire.event.event');
    }

    public function changeStatus($status)
    {
        if ($this->event->status != $status){
            $this->event->update([
                'price'  => $status == 'done' ? $this->event->total_price_amount : null,
                'currency' => $status == 'done' ? $this->event->total_price_currency : null,
                'status' => $status,
            ]);
            $this->dispatch('reset-events');
        }
    }
}
