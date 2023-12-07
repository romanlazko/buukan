<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Company;
use App\Models\Client as ClientModel;
use Romanlazko\Telegram\App\Bot;
use App\Http\Actions\GetEmployeeUnoccupiedScheduleAction;
use App\Livewire\Forms\AppointmentForm;
use Livewire\Attributes\Modelable;

class CreateAppointmentModal extends Component
{
    public Company $company;

    public AppointmentForm $appointmentForm;

    public $employee;
    public $isClientFormOpen = false;

    public $schedules = [];
    public $total_price = null;

    public function mount(Company $company)
    {
        $this->company = $company;
    }

    public function render()
    {
        $this->reset('schedules');

        $this->employee = $this->company->employees()->find($this->appointmentForm->employee_id);

        if ($this->employee AND $this->appointmentForm->service_id AND $this->appointmentForm->date) {
            $this->schedules = GetEmployeeUnoccupiedScheduleAction::handle($this->employee, $this->appointmentForm->date, $this->appointmentForm->service_id);
        }

        $total_price = $this->company->services()
            ->find($this->appointmentForm->service_id)
            ?->price
            ?->plus(
                $this->company->sub_services()->whereIn('id', $this->appointmentForm->sub_services)
                    ->get()
                    ->map(function($sub_service){
                        return $sub_service->price->getAmount()->toInt();
                    })->sum()
            );

        $this->total_price = $total_price?->getAmount()->toInt()." ".$total_price?->getCurrency()->getCurrencyCode();

        return view('livewire.create-appointment-modal');
    }

    #[On('setClient')]
    public function setClient($client_id)
    {
        $this->appointmentForm->client_id = $client_id;
    }

    #[On('set-data')]
    public function setData($data = [])
    {
        $this->appointmentForm->reset();

        $this->appointmentForm->set(collect($data));
    }

    public function save()
    {
        if ($this->appointmentForm->appointment_id) {
            $this->appointmentForm->update();
        }
        else {
            $this->appointmentForm->store();
        }

        $this->dispatch('reset-events')->to(Calendar::class);
        
        $this->dispatch('close-modal', 'CreateAppointmentModal');

        $this->reset('schedules');
    }

    public function toDateEventsModal($date)
    {
        $this->dispatch('close-modal', 'CreateAppointmentModal');
        $this->dispatch('set-data', $date)->to(DateEventsModal::class);
        $this->dispatch('open-modal', "DateEventsModal");
    }
}
