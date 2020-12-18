<?php

namespace Enterprise\Framework\Service\Action\Resolver;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

use Enterprise\Framework\Service\Action\Resolver\ActionResolverService;
use Enterprise\Framework\Service\Action\Resolver\ActionResolverServiceInterface;

class ActionResolverServiceProvider extends ServiceProvider
{
    protected $actionControllers;

    public function __construct($app){
        $this->app = $app;
    }
    /**
     * Register the action resolver services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ActionResolverServiceInterface::class, function ($app)
        {
            return new ActionResolverService($app);
        });
        $this->app->alias(ActionResolverServiceInterface::class, 'actionResolverService');
    }

    public function provides()
    {
        return [ActionResolverServiceInterface::class, 'actionResolverService'];
    }
}
