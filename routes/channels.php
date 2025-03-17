<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('prescription-status', function () {
    return true;
});

Broadcast::channel('my-channel', function () {
    return true;
});