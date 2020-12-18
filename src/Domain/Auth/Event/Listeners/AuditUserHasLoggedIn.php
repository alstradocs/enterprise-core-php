<?php

namespace Enterprise\Domain\Auth\Event\Listeners;

use Enterprise\Domain\Auth\Event\Events\UserHasLoggedInEvent;

class AuditUserHasLoggedIn {
    public function handle(UserHasLoggedInEvent $event)
    {
        var_dump($event->getUsername());
    }
}