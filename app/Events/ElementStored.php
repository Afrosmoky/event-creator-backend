<?php

namespace App\Events;

use App\Models\Element;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ElementStored implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Element $element;
    /**
     * Create a new event instance.
     */
    public function __construct(Element $element)
    {
        $this->element = $element;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('elements');
    }
}
