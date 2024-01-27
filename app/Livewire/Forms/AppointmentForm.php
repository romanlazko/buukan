<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Appointment;
use App\Models\Schedule;
use Illuminate\Support\Str;


class AppointmentForm extends Form
{
    public $model = null;
    public $client_id = null;
    public $employee_id = null;
    public $service_id;
    public $date;
    public $term;
    public $comment = null;
    public $price;
    public $currency;
    public $status = 'new';
    public $sub_services = [];
    public $key = null;

    public function set($data)
    {
        $this->model = Appointment::findOr($data['appointment_id'] ?? null, function() use($data) {
            return Schedule::find($data['schedule_id'] ?? null);
        });

        $this->client_id        = $this->model?->client_id ?? $data['client_id'] ?? null;
        $this->employee_id      = $this->model?->employee_id ?? $data['employee_id'] ?? null;
        $this->service_id       = $this->model?->service_id ?? $data['service_id'] ?? null;
        $this->date             = $this->model?->date->format('Y-m-d') ?? $data['date'] ?? null;
        $this->term             = $this->model?->term->format('H:i');
        $this->comment          = $this->model?->comment ?? null;
        $this->price            = $this->model?->price_amount ?? $this->model?->total_price_amount ?? null;
        $this->currency         = $this->model?->currency ?? $this->model?->total_price_currency ?? null;
        $this->status           = $this->model?->status ?? 'new';
        $this->sub_services     = $this->model?->sub_services?->pluck('id')->toArray() ?? [];
        $this->key              = Str::random(40);
    }

    public function save()
    {
        $this->validate();
        
        $appointment = ($this->model instanceof Appointment) ? $this->model : new Appointment;

        $appointment->client_id     = $this->client_id;
        $appointment->employee_id   = $this->employee_id;
        $appointment->service_id    = $this->service_id;
        $appointment->date          = $this->date;
        $appointment->term          = $this->term;
        $appointment->comment       = $this->comment;
        $appointment->price         = $this->status == 'done' ? $this->price : null;
        $appointment->currency      = $this->currency;
        $appointment->status        = $this->status;

        $appointment->save();

        $appointment->sub_services()->sync($this->sub_services);
    }

    public function rules()
    {
        return [
            'client_id'   => 'required',
            'employee_id' => 'required',
            'service_id'  => 'required',
            'date'        => 'required',
            'term'        => 'required',
            'comment'     => 'sometimes',
            'price'       => 'required_if:status,done',
            'currency'    => 'required_if:status,done',
            'status'      => 'required',
        ];
    }
}
