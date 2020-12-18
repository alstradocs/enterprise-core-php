<?php

namespace Enterprise\Framework\Service\Action\Resolver;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

use Enterprise\Framework\EnterpriseApplication;
use Enterprise\Framework\Service\Action\ControllerActionInterface;
use Enterprise\Framework\Service\Action\Resolver\ActionNotFoundException;
use Enterprise\Framework\Service\Action\Resolver\ActionResolverServiceInterface;

/**
 * Resolves/Finds actions.
 *
 * @author Edward Banfa
 */
class ActionResolverService implements ActionResolverServiceInterface
{
    protected $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function resolve($actionName)
    {
        return $this->app->make($actionName);
    }

}
