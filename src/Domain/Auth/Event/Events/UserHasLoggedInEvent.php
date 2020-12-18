<?php

namespace Enterprise\Domain\Auth\Event\Events;

class UserHasLoggedInEvent
{
    protected $username;

    public function __construct($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }
}