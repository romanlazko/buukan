<?php

namespace App\Livewire\Calendar;

use Livewire\Component;
use Livewire\Attributes\On;
use Carbon\Carbon;
use App\Livewire\Traits\Modal;

class CreateEventModal extends Component
{
    use Modal;

    public $employee;

    public $start_date = ''; 

    public $end_date = '';

    public $terms = [
        [
            'hours' => '00',
            'minutes' => '00'
        ]
    ];

    public $service_id = null;

    #[On('set-data')]
    public function setData($data = [])
    {
        $this->start_date   = Carbon::parse($data['dateStr'] ?? $data['startStr'] ?? null)->format('Y-m-d');
        $this->end_date     = isset($data['endStr']) 
            ? Carbon::parse($data['endStr'])->subDay()->format('Y-m-d') 
            : $this->start_date;
    }

    public function addTerm()
    {
        $this->terms[] = [
            'hours' => '00',
            'minutes' => '00'
        ];
    }

    public function removeTerm($index)
    {
        unset($this->terms[$index]);
        $this->terms = array_values($this->terms);
    }

    public function store()
    {
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
        $currentDate = $startDate->copy();

        while ($currentDate->lte($endDate)) {
            foreach ($this->terms as $index => $term) {
                $schedule = $this->employee->schedule()->updateOrCreate([
                    'date' => $currentDate->format('Y-m-d'),
                    'term' => $term['hours'] .':'. $term['minutes'],
                    'service_id' => !empty($this->service_id) ? $this->service_id : null,
                ]);
            }
            $currentDate->addDay();
        }

        $this->dispatch('reset-events');
        
        $this->openModal('DateEventsModal', [
            'dateStr' => $this->start_date
        ]);

        $this->reset('start_date', 'end_date', 'terms', 'service_id');
    }

    public function render()
    {
        return view('livewire.calendar.create-event-modal');
    }
}
