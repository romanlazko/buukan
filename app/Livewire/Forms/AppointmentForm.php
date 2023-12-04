<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Client;
use App\Models\Appointment;

class AppointmentForm extends Form
{
    public Client $client;
    public $client_id;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;

    public Appointment $appointment;
    public $appointment_id;
    public $date;
    public $term;
    public $service_id;
    public $employee_id;
    public $comment;
    public $price;
    public $status;

    public function store()
    {
        Appointment::create($this->all());
    }
}
