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

class VideoAudioCallEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public User $user, public bool $isVideo)
    {
    }

    public function broadcastOn()
    {
        return new PrivateChannel('call-video-channel.' . $this->user->id);
    }

    public function broadcastWith()
    {
        return [
            'user' => auth()->user(),
            'isVideo' => $this->isVideo,
            'avatarUrl' => url(
                auth()
                    ->user()
                    ->avatar()
            )
        ];
    }
}
