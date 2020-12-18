<?php

namespace Enterprise\Framework\Service\Action\Execution;

use Illuminate\Support\Facades\Facade;

use Enterprise\Framework\Service\Action\Execution\ActionExecutionService;

/**
 * s
 */
class ActionExecutionServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return ActionExecutionService
     */
    protected static function getFacadeAccessor()
    {
        return ActionExecutionServiceInterface::class;
    }
}
