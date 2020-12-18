<?php

namespace Enterprise\Domain\Auth\Model;

use Enterprise\Domain\Auth\Model\User;

class UserObserver
{ 
    /**
     * Handle the User "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function retrieved(User $user)
    {
       //var_dump($user);
    }

    /**
     * Handle the User "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function saving(User $user)
    {
        //var_dump('Saving a user@@@' . $user->user_login);
    }
    
    /**
     * Handle the User "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        // var_dump('Created a user@@@' . $user->user_login);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
        //var_dump($user);
        //var_dump('updated a user@@@' . $user->user_login);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function saved(User $user)
    {
        //
        //var_dump($user);
        var_dump('Saved a user@@@' . $user->user_login);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}