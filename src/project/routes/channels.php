<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated profile can listen to the channel.
|
*/
Broadcast::channel('seen-message-channel.{id}', function ($user, $id) {
    return $user->id == $id;
});

Broadcast::channel('delete-message-channel.{id}', function ($user, $id) {
    return $user->groups->contains($id);
});

Broadcast::channel('message-channel.{id}', function ($user, $id) {
    return $user->id == $id;
});

Broadcast::channel('channel-message.{groupId}.{userId}', function (
    $user,
    $groupId,
    $userId
) {
    return $user->groups->contains($groupId);
});

Broadcast::channel('call-video-channel.{id}', function ($user, $id) {
    return $user->id == $id;
});

Broadcast::channel('is-confirmed-call-channel.{id}', function ($user, $id) {
    return $user->id == $id;
});

Broadcast::channel('end-call-channel.{id}', function ($user, $id) {
    return $user->id == $id;
});

Broadcast::channel('chat', function ($user) {
    return auth()->check();
});
