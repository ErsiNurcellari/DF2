<?php

namespace App\Listeners\User;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\User\VerifyEmailMail;
use App\Mail\User\WelcomeMail;
use Mail;

class UserEventSubscriber
{

    /**
     * Fires when a user registered.
     *
     * @param $event
     */
    public function onUserRegister( $event ) {
        Mail::to($event->user)->send(new WelcomeMail($event->user));
    }



    public function onUserLogin($event) {
        $event->user->last_login = date('Y-m-d H:i:s');
        $event->user->save();
    }


    public function subscribe( $events ) {

        $events->listen(
            'Illuminate\Auth\Events\Registered',
            'App\Listeners\User\UserEventSubscriber@onUserRegister'
        );

        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\User\UserEventSubscriber@onUserLogin'
        );
    }
}
