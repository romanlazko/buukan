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
            if ($telegram_bot = $this->client->telegram_chat?->bot) {
                $bot = new Bot($telegram_bot->token);
    
                $this->client->telegram_chat->photo = $bot::getPhoto(['file_id' => $this->client->telegram_chat->photo]);
            }
        }

        if ($this->employee AND $this->serviceId AND $this->date) {
            $this->schedules = GetEmployeeUnoccupiedScheduleAction::handle($this->employee, $this->date, $this->serviceId);
        }

        return view('livewire.appointment-modal');
    }

    public function setTerm($term)
    {
        $this->term = $term;
    }

    #[On('set-data')]
    public function setData($data = [])
    {
        $this->reset('employeeId', 'appointment', 'clientId', 'client', 'schedules', 'serviceId', 'date', 'term');

        $this->appointment = $this->employee->appointments()->findOr($data['id'] ?? null, function() use ($data){
            return $this->employee->schedule()->find($data['id'] ?? null);
        });

        $this->clientId = $this->appointment?->client?->id ?? null;
        $this->serviceId = $this->appointment?->service?->id ?? null; 
        $this->date = $this->appointment?->date?->format('Y-m-d') ?? null;
        $this->term = $this->appointment?->term?->format('H:s') ?? null;
        $this->status = $this->appointment?->status ?? 'new';
        $this->price = $this->appointment?->price ?? null;
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

        $client = $this->company->clients()->find($this->clientId);

        if (!$client) {
            $client = $this->company->clients()->create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'phone' => $this->phone,
                'email' => $this->email,
            ]);
        }

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

        $this->reset('employeeId', 'appointment', 'clientId', 'client', 'schedules', 'serviceId', 'date', 'term');
    }

    public function toDateEventsModal($date)
    {
        $this->dispatch('close-modal', 'AppointmentModal');
        $this->dispatch('set-data', $date)->to(DateEventsModal::class);
        $this->dispatch('open-modal', "DateEventsModal");
    }
}
