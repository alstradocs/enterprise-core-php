<?php

namespace Enterprise\Framework\Service\Action\Resolver;

use Illuminate\Support\Facades\Facade;

use Enterprise\Framework\Service\Action\Resolver\ActionResolverServiceInterface;

/**
 * s
 */
class ActionResolverServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return ActionResolverService
     */
    protected static function getFacadeAccessor()
    {
        return ActionResolverServiceInterface::class;
    }
}
