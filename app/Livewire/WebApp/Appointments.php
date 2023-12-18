<?php

namespace App\Livewire\WebApp;

use Livewire\Component;
use App\Models\WebApp as ModelsWebApp;

class Appointments extends Component
{
    public $web_app;

    public $client;

    // public function mount(ModelsWebApp $web_app)
    // {
    //     $this->web_app = $web_app;
    //     $this->client = $this->web_app->company->clients()->where('user_id', auth('user')->user()->id)->first();
    // }


    public function render()
    {
        $appointments = $this->client?->appointments?->where('status', 'new') ?? collect([]);

        return view('webapp.appointments', compact('appointments'));
    }

    // public function nextStep()
    // {
    //     $this->dispatch('nextStep')->to(WebApp::class);
    // }

    public function cancel($appointmentId) 
    {
        dd($appointmentId);
        if ($this->client) {
            $this->client->appointments()->find($appointmentId)->cancel();
        }
    }
}
