<?php

namespace App\Livewire\WebApp;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Service;
use App\Models\WebApp as ModelsWebApp;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.web-app')]
class WebApp extends Component
{
    public ModelsWebApp $web_app;

    public Client $client;

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
    //     

    // }
    

    public function nextStep()
    {
        $this->currentStep++;

        if ($this->steps[$this->currentStep] == 'services') {
            $this->reset('serviceId', 'employeeId', 'date', 'term');
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
            $this->reset('serviceId', 'employeeId', 'date', 'term');
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

        $client = $this->web_app->company->clients->find($this->client->id);

        if ($client) {
            $client->appointments()->create([
                'employee_id' => $this->employeeId,
                'service_id' => $this->serviceId,
                'date' => $this->date,
                'term' => $this->term,
                'status' => 'new',
            ]);
        }

        $this->reset('serviceId', 'employeeId', 'date', 'term', 'currentStep');
    }

    public function render()
    {
        $this->appointments = $this->client->appointments->where('status', 'new');
        $this->services = $this->web_app->company->services;
        $this->employees = Service::find($this->serviceId)?->employees;

        $this->unnocupiedDates = Employee::find($this->employeeId)?->unoccupiedSchedules()
            ->orderBy('date')
            ->get()
            ->when($this->serviceId, function($collection) {
                return $collection->where('service_id', $this->serviceId);
            });
        
        $this->schedules = Employee::find($this->employeeId)?->unoccupiedSchedules($this->date)
            ->orderBy('term')
            ->get()
            ->when($this->serviceId, function($collection) {
                return $collection->where('service_id', $this->serviceId);
            });

        return view("livewire.web-app.{$this->steps[$this->currentStep]}");
    }
}
