<?php

namespace Enterprise\Framework\Service\Database;

use Illuminate\Support\ServiceProvider;

use Enterprise\Framework\Service\Database\DatabaseService;
use Enterprise\Framework\Service\Database\DatabaseServiceInterface;

class DatabaseServiceProvider extends ServiceProvider {

    public function boot() {
        $dbService = $this->app->make(DatabaseServiceInterface::class);
    }

    public function register() {
        $this->app->singleton(DatabaseServiceInterface::class, function ($app)
        {
            return new DatabaseService($app);
        });
    }
}
