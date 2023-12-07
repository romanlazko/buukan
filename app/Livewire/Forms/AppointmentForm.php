<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Appointment;
use App\Models\TimeBasedSchedule;

class AppointmentForm extends Form
{
    public $model = null;
    public $client_id = null;
    public $employee_id = null;
    public $service_id;
    public $date;
    public $term;
    public $comment;
    public $price;
    public $status = 'new';
    public $sub_services = [];

    public function set($data)
    {
        $this->model = Appointment::findOr($data['appointment_id'] ?? null, function() use($data) {
            return TimeBasedSchedule::find($data['schedule_id'] ?? null);
        });

        $this->client_id        = $this->model?->client_id;
        $this->employee_id      = $this->model?->employee_id;
        $this->service_id       = $this->model?->service_id;
        $this->date             = $this->model?->date->format('Y-m-d');
        $this->term             = $this->model?->term->format('H:s');
        $this->comment          = $this->model?->comment;
        $this->price            = $this->model?->price;
        $this->status           = $this->model?->status ?? 'new';
        $this->sub_services     = $this->model?->subServices?->pluck('id')->toArray() ?? [];
    }

    public function save()
    {
        $appointment = ($this->model instanceof Appointment) ? $this->model : new Appointment;

        $appointment->client_id     = $this->client_id;
        $appointment->employee_id   = $this->employee_id;
        $appointment->service_id    = $this->service_id;
        $appointment->date          = $this->date;
        $appointment->term          = $this->term;
        $appointment->comment       = $this->comment;
        $appointment->price         = $this->price;
        $appointment->status        = $this->status;

        $appointment->save();

        $appointment->subServices()->sync($this->sub_services);
    }
}
