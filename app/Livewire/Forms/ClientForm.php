<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Client;
use Romanlazko\Telegram\App\Bot;

class ClientForm extends Form
{
    public ?Client $client;
    public $client_id = null;
    public $first_name = null;
    public $last_name = null;
    public $email = null;
    public $phone = null;
    public $avatar = null;
    public $company_id = 2;

    public function set(?Client $client)
    {
        $this->client = $client;
        $this->company_id = 2;
        $this->first_name = $client?->first_name;
        $this->last_name = $client?->last_name;
        $this->email = $client?->email;
        $this->phone = $client?->phone;
        // if ($telegram_bot = $client?->telegram_chat?->bot) {
        //     $bot = new Bot($telegram_bot->token);

        //     $this->avatar = $bot::getPhoto(['file_id' => $client->telegram_chat->photo]);
        // }
    }

    public function save()
    {
        $client = $this->client ?? new Client;
        $client->first_name   = $this->first_name;
        $client->last_name    = $this->last_name;
        $client->phone        = $this->phone;
        $client->email        = $this->email;
        $client->company_id   = $this->company_id;

        $client->save();
    }

    public function store()
    {
        return Client::create([
            'company_id'    => $this->company_id,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'phone'         => $this->phone,
            'email'         => $this->email,
        ]);
    }

    public function update()
    {
        $this->client->update([
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'phone'         => $this->phone,
            'email'         => $this->email,
        ]);
    }
}
