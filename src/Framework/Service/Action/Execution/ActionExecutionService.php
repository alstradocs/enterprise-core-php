<?php

namespace Enterprise\Framework\Service\Action\Execution;

use Enterprise\Framework\Service\Action\Execution\ActionExecutionServiceInterface;

/**
 * An action is a type of a controller. Actions have
 * a single public method call execute.
 *
 * @author Edward Banfa
 */
class ActionExecutionService implements ActionExecutionServiceInterface
{
    protected $app;
    protected $actionResolverService;

    public function __construct($app, $actionResolverService) {
        $this->app = $app;
        $this->actionResolverService = $actionResolverService;
    }

    public function execute($actionName, $data)
    {
        $actionResolverService = $this->actionResolverService;
        $action = $actionResolverService->resolve($actionName);
        return $action->execute($data);
    }

}
