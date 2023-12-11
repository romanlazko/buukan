<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class ClientEvents extends Component
{
    public $client;

    #[On('reset-events')]
    public function render()
    {
        $events = $this->client->appointments->sortBy('date');

        return view('livewire.event.show', compact('events'));
    }
}
