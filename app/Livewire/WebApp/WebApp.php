<?php

namespace App\Livewire\WebApp;

use App\Models\User;
use App\Models\Employee;
use App\Models\Service;
use App\Models\WebApp as ModelsWebApp;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Http\Actions\GetEmployeeUnoccupiedScheduleAction;
use App\Events\NewAppointment;

#[Layout('layouts.web-app')]
class WebApp extends Component
{
    public ModelsWebApp $web_app;

    public $client;

    public $sub_services = [];

    public $services;

    public $employees;

    public $currentStep = 0;

    public $steps = [
        'appointments',
        'services',
        'employees',
        'dateterm',
    ];

    public $serviceId;
    public $employeeId;
    public $date;
    public $term;
    public $unnocupiedDates;
    public $schedules;
    public $appointments;

    // public function mount()
    // {
    //     $this->client = $this->web_app->company->clients()->where('user_id', auth('user')->user()->id);
    // }
    
    public function nextStep()
    {
        $this->currentStep++;

        if ($this->steps[$this->currentStep] == 'services') {
            $this->reset('serviceId', 'employeeId', 'date', 'term', 'sub_services');
        }

        if ($this->steps[$this->currentStep] == 'employees') {
            $this->reset('employeeId', 'date', 'term');
        }

        if ($this->steps[$this->currentStep] == 'dateterm') {
            $this->reset('date', 'term');
        }
    }

    public function prevStep()
    {
        if ($this->currentStep > 0) {
            $this->currentStep--;
        }

        if ($this->steps[$this->currentStep] == 'services') {
            $this->reset('employeeId', 'date', 'term');
        }

        if ($this->steps[$this->currentStep] == 'employees') {
            $this->reset('employeeId', 'date', 'term');
        }

        if ($this->steps[$this->currentStep] == 'dateterm') {
            $this->reset('date', 'term');
        }
    }

    public function create()
    {
        $service = $this->web_app->company->services->find($this->serviceId);

        if (!$service) {
            return redirect()->back()->with([
                'ok' => false,
                'description' => "Service shood be selected" 
            ])->withInput();
        }
        
        $employee = $this->web_app->company->employees->find($this->employeeId);

        if (!$employee) {
            return redirect()->back()->with([
                'ok' => false,
                'description' => "Employee shood be selected" 
            ])->withInput();
        }

        $client = $this->web_app->company->clients()->where('user_id', auth('user')->user()->id)->first();

        if ($client) {
            $appointment = $client->appointments()->create([
                'employee_id' => $this->employeeId,
                'service_id' => $this->serviceId,
                'date' => $this->date,
                'term' => $this->term,
                'status' => 'new',
            ]);
            
            $appointment->sub_services()->sync($this->sub_services);

            event(new NewAppointment($appointment));
        }

        $this->reset('serviceId', 'employeeId', 'date', 'term', 'currentStep', 'sub_services');
    }

    public function cancel($appointmentId) 
    {
        $client = $this->web_app->company->clients()->where('user_id', auth('user')->user()->id)->first();

        if ($client) {
            $client->appointments()->find($appointmentId)->cancel();
        }
    }

    public function resetTerm()
    {
        $this->reset('term');
    }

    public function render()
    {
        if ($this->steps[$this->currentStep] == 'appointments') {
            $client = $this->web_app->company->clients()->where('user_id', auth('user')->user()->id)->first();
            $this->appointments = $client?->appointments?->where('status', 'new') ?? collect([]);
        }

        if ($this->steps[$this->currentStep] == 'services') {
            $this->services = $this->web_app->company->services()?->active()->whereJsonContains('settings->is_available_on_webapp', 'on')?->get();
        }

        if ($this->steps[$this->currentStep] == 'employees') {
            $this->employees = $this->web_app->company->employees()->whereJsonContains('settings->is_available_on_webapp', 'on')?->whereHas('services', function($query){
                return $query->where('service_id', $this->serviceId);
            })->role('employee', 'company')->get();
        }

        if ($this->steps[$this->currentStep] == 'dateterm') {
            $this->unnocupiedDates  = GetEmployeeUnoccupiedScheduleAction::handle(Employee::find($this->employeeId), null, $this->serviceId)?->sortBy('date');
            $this->schedules        = GetEmployeeUnoccupiedScheduleAction::handle(Employee::find($this->employeeId), $this->date, $this->serviceId)?->sortBy('term');
        }
        
        return view("webapp.{$this->steps[$this->currentStep]}");
    }
}
