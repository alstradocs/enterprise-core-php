<?php

namespace Enterprise\Framework\Service\Action\Resolver;

use Illuminate\Support\ServiceProvider;

interface ActionResolverServiceInterface
{
    /**
     * @return result Resolve/Find an action by name
     */
    public function resolve($actionName);
}
