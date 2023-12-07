<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Appointment;

class AppointmentForm extends Form
{
    public $appointment_id;
    public $client_id = null;
    public $employee_id = null;
    public $service_id;
    public $date;
    public $term;
    public $comment;
    public $price;
    public $status = 'new';
    public $sub_services = [];

    public function set($appointment)
    {
        $this->appointment_id  = $appointment->get('appointment_id') ?? null;
        $this->client_id    = $appointment->get('client')['id'] ?? null;
        $this->employee_id  = $appointment->get('employee')['id'] ?? null;
        $this->service_id   = $appointment->get('service')['id'] ?? null;
        $this->date         = $appointment->get('date');
        $this->term         = $appointment->get('term');
        $this->comment      = $appointment->get('comment');
        $this->price        = $appointment->get('price');
        $this->status       = $appointment->get('status') ?? 'new';
    }

    public function store()
    {
        return Appointment::create([
            'client_id'     => $this->client_id,
            'employee_id'   => $this->employee_id,
            'service_id'    => $this->service_id,
            'date'          => $this->date,
            'term'          => $this->term,
            'comment'       => $this->comment,
            'price'         => $this->price,
            'status'        => $this->status,
        ])->subServices()->sync($this->sub_services);
    }

    public function update()
    {
        $appointment = Appointment::find($this->appointment_id);

        $appointment->update([
            'client_id'     => $this->client_id,
            'employee_id'   => $this->employee_id,
            'service_id'    => $this->service_id,
            'date'          => $this->date,
            'term'          => $this->term,
            'comment'       => $this->comment,
            'price'         => $this->price,
            'status'        => $this->status,
        ]);
        
        $appointment->subServices()->sync($this->sub_services);
    }
}
