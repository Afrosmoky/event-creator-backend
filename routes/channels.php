<?php


use App\Models\Element;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

//Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});
Broadcast::channel('elements', function ($user) {
    //Allow all user to listen to the "elements" channels
    return true;
});

Broadcast::channel('elements.{elementId}', function (User $user, int $elementId) {
    //Allow only the element's author to listen to the "elements.{elementId}" channel
    return $user->id === Element::findorNew($elementId)->user_id;
});
