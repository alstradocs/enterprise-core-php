<?php

namespace Enterprise\Framework\Service\Action\Execution;

use Illuminate\Support\ServiceProvider;

interface ActionExecutionServiceInterface
{
    /**
     * @return result The result from the executed action
     */
    public function execute($controllerName, $data);
}
