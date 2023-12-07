<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client as ClientModel;
use Livewire\Attributes\On;
use Carbon\Carbon;
use App\Models\Company;
use App\Http\Actions\GetEmployeeUnoccupiedScheduleAction;
use App\Livewire\Forms\AppointmentForm;

use Romanlazko\Telegram\App\Bot;

class AppointmentModal extends Component
{
    public Company $company;

    public AppointmentForm $appointmentForm;

    public $employee;
    public $isClientFormOpen = false;

    public $schedules = [];
    public $total_price = null;

    public $formDisabled = true;

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

        $this->toggleFormDisabled();

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

        return view('livewire.appointment-modal');
    }

    #[On('setClient')]
    public function setClient($client_id)
    {
        $this->appointmentForm->client_id = $client_id;
    }

    
    public function toggleFormDisabled()
    {
        $this->formDisabled = (!$this->appointmentForm->client_id || $this->isClientFormOpen);
    }

    #[On('toggleIsClientFormOpen')]
    public function toggleIsClientFormOpen($isClientFormOpen)
    {
        $this->isClientFormOpen = $isClientFormOpen;
    }

    #[On('set-data')]
    public function setData($data = [])
    {
        $this->appointmentForm->reset();

        $this->appointmentForm->set($data);
    }

    public function save()
    {
        $this->appointmentForm->save();

        $this->dispatch('reset-events')->to(Calendar::class);
        
        $this->dispatch('close-modal', 'AppointmentModal');

        $this->reset('schedules');
    }

    public function toDateEventsModal($data)
    {
        dd('work');
        $this->dispatch('close-modal', 'AppointmentModal');
        $this->dispatch('set-data', $data)->to(DateEventsModal::class);
        $this->dispatch('open-modal', "DateEventsModal");
    }
}
