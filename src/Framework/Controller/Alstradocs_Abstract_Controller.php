<?php
namespace Enterprise\Framework\Controller;
use Illuminate\Container\Container;
/**
 *
 */
abstract class Alstradocs_Abstract_Controller implements Alstradocs_Controller
{
    protected $app;
    protected $loader;


    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    /**
     * @param app The plugin IoC container
     * @param loader Plugin loader
     */
    public function register($app, $loader)
    {
        $this->app =  $app;
        $this->loader = $loader;
        $this->do_register();
    }

    /**
     */
    abstract protected function do_register();
}
