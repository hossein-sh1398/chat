<?php

namespace App\Events;

use App\Models\ChatMessages;
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

class PrivateChatMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public User $user, public ChatMessages $message, public int $countUnseen)
    {
    }

    public function broadcastOn()
    {
        return new PrivateChannel('message-channel.' . $this->user->id);
    }

    public function broadcastAs()
    {
        return 'PrivateChatMessage';
    }

    public function broadcastWith()
    {
        return [
            'message' => view('admin.pages.chat.out-message', [
                'message' => $this->message,
            ])->render(),
            'user' => auth()->user(),
            'isSeen' => $this->message->seen,
            'countUnseen' => $this->countUnseen,
        ];
    }
}
