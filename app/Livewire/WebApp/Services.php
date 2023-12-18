<?php

namespace App\Livewire\WebApp;

use Livewire\Component;

class Services extends Component
{
    public $web_app;

    public $serviceId;

    // public function mount(ModelsWebApp $web_app)
    // {
    //     $this->reset('serviceId', 'employeeId', 'date', 'term', 'sub_services');
    //     $this->web_app = $web_app;
    // }

    public function render()
    {
        $services = $this->web_app?->company?->services()->whereJsonContains('settings->is_available_on_webapp', 'on')?->get() ?? collect([]);

        return view('webapp.services', compact('services'));
    }
}
