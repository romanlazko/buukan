<?php

namespace App\Livewire;

use Livewire\Component;

class ScheduleModal extends Component
{
    public $windows = [
        'date-events',
        'edit-event',
        'create-event',
        'appointment'
    ];

    public $params = [];

    public $activeWindow = 'date-events';

    public function setParamsForWindow()
    {
        $this->params = [
            'date-events' => [
                'employee' => $this->employee,
                'date' => $this->date
            ]
        ];
    }

    public function setActiveWindow($window)
    {
        $this->activeWindow = $window;
    }

    public function render()
    {
        return view('livewire.schedule-modal');
    }
}
