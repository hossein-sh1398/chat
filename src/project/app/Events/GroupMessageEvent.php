<?php

namespace App\Events;

use App\Enums\GroupType;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Str;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class GroupMessageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public Group $group, public User $user, public $message)
    {
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-message.' . $this->group->id . '.' . $this->user->id);
    }

    public function broadcastWith()
    {
        $canDelete = $this->user->isAdminInGroup($this->group);

        $path =
            GroupType::Channel == $this->group->type
                ? 'admin.pages.chat.channel.in-message'
                : 'admin.pages.chat.group.out-message';

        $view = view($path, [
            'message' => $this->message,
            'canDelete' => $canDelete,
        ])->render();

        return [
            'message' => $view,
        ];
    }
}
