<?php

namespace Enterprise\Framework\Service\Database;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Capsule\Manager as DB;

class DatabaseService implements DatabaseServiceInterface
{
    protected $db;

    public function __construct(Container $app)
    {
        # code...
        require_once(ABSPATH . 'wp-config.php');
        $this->db = new DB();

        $this->db->addConnection([
            'driver'    => 'mysql',
            'host'      => DB_HOST,
            'database'  => DB_NAME,
            'username'  => DB_USER,
            'password'  => DB_PASSWORD,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => 'wp_',
            'strict'    => false
        ]);

        /** For some reason uncommenting any of the two lines belows causes model events to fail */
        //$db->setEventDispatcher($this->app->make('events'));
        //User::setEventDispatcher($this->app->make('events'));

        // Make this Capsule instance available globally via static methods... (optional)
        $this->db->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $this->db->bootEloquent();

        return $this->db;
    }

    public function getDB()
    {
        return $this->db;
    }

}
