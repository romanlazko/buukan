<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client as ClientModel;

use Romanlazko\Telegram\App\Bot;
use Livewire\Attributes\Reactive;
use App\Livewire\Forms\ClientForm;
use App\Livewire\Forms\AppointmentForm;
use App\Models\Company;
use Livewire\Attributes\Modelable;

class Client extends Component
{
    public Company $company;

    #[Reactive]
    public $client_id;

    public $client;

    public $isClientFormOpen = false;

    public $client_data = [];

    public function mount(Company $company)
    {
        $this->company = $company;
    }

    public function render()
    {
        if ($this->client_id != $this->client?->id) {
            $this->toggleClientForm(false);

            $this->client = ClientModel::find($this->client_id);

            $this->client_data = [
                'id' => $this->client?->id,
                'first_name' => $this->client?->first_name,
                'last_name' => $this->client?->last_name,
                'phone' => $this->client?->phone,
                'email' => $this->client?->email,
                'avatar' => $this->client?->avatar,
                'comment' => $this->client?->comment,
                'social_media' => json_decode($this->client?->social_media, true) ?? [],
            ];
        }

        return view('livewire.client');
    }

    public function save()
    {
        $this->client = $this->client ?? new ClientModel;
        $this->client->company_id   = $this->company->id;
        $this->client->first_name   = $this->client_data['first_name'] ?? $this->client?->first_name;
        $this->client->last_name    = $this->client_data['last_name'] ?? $this->client?->last_name;
        $this->client->phone        = $this->client_data['phone'] ?? $this->client?->phone;
        $this->client->email        = $this->client_data['email'] ?? $this->client?->email;
        $this->client->comment      = $this->client_data['comment'] ?? $this->client?->comment;
        $this->client->social_media      = json_encode($this->client_data['social_media']) ?? $this->client?->social_media;

        $this->client->save();

        $this->dispatch('setClient', $this->client->id)->to(AppointmentModal::class);

        $this->toggleClientForm(false);
        
    }

    public function toggleClientForm(bool $status = null)
    {
        $this->isClientFormOpen = is_null($status) ? !$this->isClientFormOpen : $status;
        $this->dispatch('toggleIsClientFormOpen', $this->isClientFormOpen)->to(AppointmentModal::class);
    }
}
