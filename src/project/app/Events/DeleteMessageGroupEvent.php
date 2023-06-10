<?php

namespace App\Events;

use App\Models\GroupMessage;
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

class DeleteMessageGroupEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public GroupMessage $group_message)
    {

    }

    public function broadcastOn()
    {
        return new Channel(
            'delete-message-channel.' . $this->group_message->group_id
        );
    }

    public function broadcastWith()
    {
        return [
            'messageId' => $this->group_message->id,
        ];
    }
}
