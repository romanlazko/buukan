<?php

namespace App\Livewire\Calendar;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Traits\Modal;
use Carbon\Carbon;

class DateEventsModal extends Component
{
    use Modal;

    public $employee;

    public $date = null;

    #[On('set-data')]
    public function setData($params = [])
    {
        $this->date = Carbon::parse($params['dateStr'] ?? $params['startStr'] ?? null);
    }

    public function render()
    {
        return view('livewire.calendar.date-events-modal');
    }
}
