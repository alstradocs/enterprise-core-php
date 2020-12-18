<?php
namespace Enterprise\Framework\Controller;

/**
 *
 */
interface Alstradocs_Controller
{
    /**
     * @param app The plugin IoC container
     * @param loader Plugin loader
     */
    public function register($app, $loader);
}
