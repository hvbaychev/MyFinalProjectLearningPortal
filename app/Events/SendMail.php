<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $user;
    public $email_type;
    public $expires;
    public $course;
    
    /**
     * Create a new event instance.
     */
    public function __construct($user, $email_type, $expires = null, $course = null)
    {
        $this->user = $user;
        $this->email_type = $email_type;
        $this->expires = $expires;
        $this->course = $course;

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
