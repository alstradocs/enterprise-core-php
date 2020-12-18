<?php

namespace Enterprise\Framework\Ui\Template;;

/**
 *
 * @author     Edward Banfa <ebanfa@alstradocs.com>
 */
trait Alstradocs_Template
{
    protected $app;


    public function __construct($app){
        $this->app = $app;
    }

    /**
     *
     * @param template_data The template data
     */
    public function render($template_data)
    {
        $this->before_render($template_data);
        $this->do_render($template_data);
        $this->after_render($template_data);
    }

    /**
     *
     * @param template_data The template data
     */
    protected function before_render($template_data)
    {
    }
    /**
     *
     * @param template_data The template data
     */
    protected function after_render($template_data)
    {
    }

    /**
     *
     * @param template_data The template data
     */
    abstract protected function do_render($template_data);
}
