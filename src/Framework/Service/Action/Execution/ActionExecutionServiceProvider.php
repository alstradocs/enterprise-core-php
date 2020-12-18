<?php

namespace Enterprise\Framework\Service\Action\Execution;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

use Enterprise\Framework\Service\Action\Resolver\ActionResolverServiceInterface;
use Enterprise\Framework\Service\Action\Execution\ActionExecutionService;
use Enterprise\Framework\Service\Action\Execution\ActionExecutionServiceInterface;

class ActionExecutionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ActionExecutionServiceInterface::class, function ($app)
        {
            $actionResolverService = $app->make(ActionResolverServiceInterface::class);
            return new ActionExecutionService($app, $actionResolverService);
        });

        $this->app->alias(ActionExecutionServiceInterface::class, 'executionService');
    }

    public function provides()
    {
        return [ActionExecutionServiceInterface::class, 'executionService'];
    }
}
