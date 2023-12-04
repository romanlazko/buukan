<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client as ClientModel;

use Romanlazko\Telegram\App\Bot;

class Client extends Component
{
    public $company;

    public $clientId;

    public $client;

    public function render()
    {
        $this->reset('client');

        if ($this->clientId) {
            $this->client = ClientModel::find($this->clientId);
            if ($telegram_bot = $this->client->telegram_chat?->bot) {
                $bot = new Bot($telegram_bot->token);
    
                $this->client->telegram_chat->photo = $bot::getPhoto(['file_id' => $this->client->telegram_chat->photo]);
            }
        }

        return view('livewire.client');
    }
}
