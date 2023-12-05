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
use App\Livewire\AppointmentForm;


class AppointmentModal extends Component
{
    public AppointmentForm $form;

    public Employee $employee;
    public Company $company;
    public $isClientFormOpen = false;

    public $employeeId;
    
    public $appointment;
    public $schedules = [];
    public $serviceId;
    public $sub_services = [];
    public $date;
    public $term;
    public $price;
    public $comment;
    public $status = 'new';
    public $total_price = null;

    public $client;
    public $clientId = null;
    public $first_name = null;
    public $last_name = null;
    public $email = null;
    public $phone = null;

    public function mount(Employee $employee, Company $company)
    {
        $this->employee = $employee;
        $this->company = $company;
    }

    public function render()
    {
        $this->reset('client', 'schedules');

        if (!$this->employeeId) {
            $this->employeeId = $this->employee->id;
        }

        if ($this->clientId) {
            $this->client = ClientModel::find($this->clientId);
            $this->first_name = $this->client->first_name;
            $this->last_name = $this->client->last_name;
            $this->email = $this->client->email;
            $this->phone = $this->client->phone;
            if ($telegram_bot = $this->client->telegram_chat?->bot) {
                $bot = new Bot($telegram_bot->token);
    
                $this->client->telegram_chat->photo = $bot::getPhoto(['file_id' => $this->client->telegram_chat->photo]);
            }
        }
        else {
            $this->reset('client', 'clientId', 'first_name', 'last_name', 'email', 'phone');
        }

        if ($this->employee AND $this->serviceId AND $this->date) {
            $this->schedules = GetEmployeeUnoccupiedScheduleAction::handle($this->employee, $this->date, $this->serviceId);
        }

            $service_price = $this->employee->services()->find($this->serviceId);

            $total_price = $service_price?->price?->plus(
                $this->company->sub_services()->whereIn('id', $this->sub_services)->get()->map(function($sub_service){
                    return $sub_service->price->getAmount()->toInt();
                })->sum()
            );

            $this->total_price = $total_price?->getAmount()->toInt()." ".$total_price?->getCurrency()->getCurrencyCode();

            // $service_price = $this->employee->services()->find($this->serviceId)->price->getAmount()->toInt();

            // $sub_services_price = $this->company->sub_services()->whereIn('id', array_values($this->sub_services))->get()->map(function($sub_service){
            //     return $sub_service->price->getAmount()->toInt();
            // })->sum();

            // $this->total_price = $service_price+$sub_services_price;

        return view('livewire.appointment-modal');
    }

    public function setTerm($term)
    {
        $this->term = $term;
    }

    #[On('set-data')]
    public function setData($data = [])
    {
        $this->reset('employeeId', 'appointment', 'schedules', 'serviceId', 'date', 'term', 'client', 'clientId', 'first_name', 'last_name', 'email', 'phone', 'status', 'price', 'comment', 'sub_services', 'isClientFormOpen');

        if ($data['type'] == 'schedule') {
            $this->appointment = $this->employee->schedule()->find($data['id'] ?? null);
        }
        if ($data['type'] == 'appointment') {
            $this->appointment = $this->employee->appointments()->find($data['id'] ?? null);
        }

        $this->clientId = $this->appointment?->client?->id ?? null;
        $this->serviceId = $this->appointment?->service?->id ?? null; 
        $this->date = $this->appointment?->date?->format('Y-m-d') ?? null;
        $this->term = $this->appointment?->term?->format('H:s') ?? null;
        $this->status = $this->appointment?->status ?? 'new';
        $this->price = $this->appointment?->price ?? null;
        $this->comment = $this->appointment?->comment ?? null;
        $this->sub_services = $this->appointment?->subServices?->pluck('id')->toArray() ?? [];
    }

    public function save()
    {
        $employee = $this->employee;

        if (!$employee) {
            return redirect()->back()->with([
                'ok' => false,
                'description' => "Employee shood be selected" 
            ])->withInput();
        }

        $client = $this->company->clients()->updateOrCreate([
            'id' => $this->clientId
        ],[
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);

        $client->appointments()->updateOrCreate([
            'id' => $this->appointment?->id
        ],[
            'employee_id' => $this->employeeId,
            'service_id' => $this->serviceId,
            'date' => $this->date,
            'term' => $this->term,
            'price' => $this->price,
            'comment' => $this->comment,
            'status' => $this->status,
        ])->subServices()->sync($this->sub_services);

        $this->dispatch('reset-events')->to(Calendar::class);
        
        $this->dispatch('close-modal', 'AppointmentModal');

        $this->reset('employeeId', 'appointment', 'clientId', 'client', 'schedules', 'serviceId', 'date', 'term', 'isClientFormOpen');
    }

    public function toDateEventsModal($date)
    {
        $this->dispatch('close-modal', 'AppointmentModal');
        $this->dispatch('set-data', $date)->to(DateEventsModal::class);
        $this->dispatch('open-modal', "DateEventsModal");
    }
}
