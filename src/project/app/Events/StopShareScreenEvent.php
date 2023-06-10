<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\ChatMessages;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class StopShareScreenEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public User $user)
    {
    }

    public function broadcastOn()
    {
        return new PrivateChannel('message-channel.' . $this->user->id);
    }

    public function broadcastWith()
    {
        return [
            'user' => $this->user
        ];
    }
}
