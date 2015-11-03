<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LogEvent extends Event
{
    use SerializesModels;

    public $eventName;
    public $table;
    public $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($eventName, $table=null, $data=null)
    {
        $this->eventName = $eventName;
        $this->table = $table;
        $this->data = $data;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
