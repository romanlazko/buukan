<?php

namespace App\Bots\buukan_bot\Events;

use App\Models\Appointment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TomorrowAppointment
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    
    /**
     * Create a new event instance.
     */
    public function __construct(public Appointment $appointment)
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
