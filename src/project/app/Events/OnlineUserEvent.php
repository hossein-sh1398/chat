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

class OnlineUserEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

        /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public User $user, public bool $isOnline)
    {

    }

    public function broadcastOn()
    {
        return new Channel('online-user-channel');
    }

    public function broadcastWith()
    {
        return [
            'user' => $this->user,
            'isOnline' => $this->isOnline
        ];
    }
}
