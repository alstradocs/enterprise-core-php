<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Events\Dispatcher;

use Enterprise\Domain\Auth\Model\User;
use Enterprise\Framework\EnterpriseApplication;

class DatabaseConnectionTest extends TestCase
{
    protected $app;
    
    protected function setUp(): void
    {
        $this->app = new EnterpriseApplication();
        $this->app->boot();

        $db = new DB();

        $db->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'wordpress',
            'username'  => 'wordpressuser',
            'password'  => 'Netfilter@2019',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => 'wp_',
            'strict'    => false
        ]);

        /** For some reason uncommenting any of the two lines belows causes model events to fail */   
        //$db->setEventDispatcher($this->app->make('events'));
        //User::setEventDispatcher($this->app->make('events'));

        // Make this Capsule instance available globally via static methods... (optional)
        $db->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $db->bootEloquent();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEloquentCapsule()
    {   
        $users = DB::table('users')->get();
        $this->assertTrue(true);
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEloquentModel()
    {   
        $users = User::all();
        $this->assertTrue(true);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEloquentCreate()
    {   
        $date = new \DateTime("2018-12-31 13:05:21");
        User::Create([
            'ID' => 2,
            'user_login' => 'blitzdocument@gmail.com',
            'user_pass' => 'Netfilter@2019',
            'user_nicename' => 'blitzdocument@gmail.com',
            'user_email' => 'blitzdocument@gmail.com',
            'user_url' => 'Developer',
            'user_registered' => $date->format('Y-m-d H:i:s'),
            'user_activation_key' => 'Developer',
            'user_status' => 0,
            'display_name' => 'blitzdocument@gmail.com',
        ]);
        $this->assertTrue(true);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEloquentUpdate()
    {   
        $name = 'Tarra White';

        $user = User::where(['ID' => 1]);
        $user->update(['user_nicename' => $name]);
        
        $user = User::find(1);

        $this->assertEquals($name, $user->user_nicename);
    }

}
