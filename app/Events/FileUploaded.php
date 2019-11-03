<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FileUploaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
	public $filelocation = '';
	public $filename = '';
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($param,$input)
    {
        $this->filelocation = $param;
        $this->filename = $input;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
