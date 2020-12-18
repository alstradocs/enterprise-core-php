<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Container\Container;

use Enterprise\Domain\Auth\Event\Events\UserHasLoggedInEvent;
use Enterprise\Domain\Auth\Event\Listeners\AuditUserHasLoggedIn;

use Enterprise\Framework\EnterpriseApplication;


class EventDispatcherTest extends TestCase
{
    protected $app;
    
    protected function setUp(): void
    {
        $this->app = new EnterpriseApplication();
        $this->app->boot();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
   /*  public function testFireEvent()
    {   
        $dispatcher = $this->app->make('events');
        $dispatcher->dispatch(new UserHasLoggedInEvent('example'));
        $this->assertTrue(true);
    } */


    /**
     * A basic test example.
     *
     * @return void
     */
   /*  public function testListenForEvent()
    {   
        $dispatcher = $this->app->make('events');

        $dispatcher->listen([UserHasLoggedInEvent::class], AuditUserHasLoggedIn::class);

        $dispatcher->dispatch(new UserHasLoggedInEvent('ebanfa@gmail.com'));

        $this->assertTrue(true);
    } */

}
