<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

Broadcast::channel('App.chat.{id}', function ($user, $id) {

    return (int)$user->chats()->where('id', $id)->count() != 0;
});

Broadcast::channel('App.inbox.{id}', function ($user, $id) {

    return (int)$user->id === (int)$id;
});

Broadcast::channel('App.notifications.doctor.{id}', function ($user, $id) {

    return (int)$user->id === (int)$id;
});
Broadcast::channel('App.notifications.patient.{id}', function ($user, $id) {

    return (int)$user->id === (int)$id;
});
/*'App.calls.' . $this->subscriber . '.' . $this->getSubscriberId()*/

Broadcast::channel('App.calls.doctor.{id}', function ($user, $id) {

    return (int)$user->id === (int)$id;
});
Broadcast::channel('App.calls.patient.{id}', function ($user, $id) {

    return (int)$user->id === (int)$id;
});
