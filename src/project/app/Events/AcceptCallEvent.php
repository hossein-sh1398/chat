<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class AcceptCallEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public User $user, public bool $isVideoCall)
    {

    }

    public function broadcastOn()
    {
        return new PrivateChannel(
            'is-confirmed-call-channel.' . $this->user->id
        );
    }

    public function broadcastWith()
    {
        return [
            'status' => true,
            'isVideoCall' => $this->isVideoCall,
        ];
    }
}
