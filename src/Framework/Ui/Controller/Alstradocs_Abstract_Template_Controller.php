<?php

namespace Enterprise\Framework\Ui\Controller;

use Enterprise\Framework\Controller\Alstradocs_Controller_Exception;
use Enterprise\Framework\Controller\Alstradocs_Configurable_Controller;

use Enterprise\Framework\Ui\Controller\Alstradocs_Template_Controller;

/**
 *
 */
class Alstradocs_Abstract_Template_Controller extends Alstradocs_Configurable_Controller implements Alstradocs_Template_Controller
{
    /**
     */
    public function do_register()
    {
        parent::do_register();
        $this->loader->add_action_once('alstradocs_render_' . $this->id . '_component', $this, 'render_template', 1, 1);
        $this->loader->add_action_once('alstradocs_render_' . $this->id . '_header', $this, 'render_named_template', 1, 2);
        $this->loader->add_action_once('alstradocs_render_' . $this->id . '_body_header', $this, 'render_named_template', 1, 2);
        $this->loader->add_action_once('alstradocs_render_' . $this->id . '_body', $this, 'render_named_template', 1, 2);
        $this->loader->add_action_once('alstradocs_render_' . $this->id . '_body_footer', $this, 'render_named_template', 1, 2);
        $this->loader->add_action_once('alstradocs_render_' . $this->id . '_footer', $this, 'render_named_template', 1, 2);
    }

    /**
     * @param template_data
     */
    public function render_template($template_data)
    {
        $template_data = empty($template_data) ? $this->get_config() : $template_data;

        $this->do_template_action('alstradocs_render_' . $this->id . '_header', 'header_template', $template_data);
        $this->do_template_action('alstradocs_render_' . $this->id . '_body_header', 'body_header_template', $template_data);
        $this->do_template_action('alstradocs_render_' . $this->id . '_body', 'body_template', $template_data);
        $this->do_template_action('alstradocs_render_' . $this->id . '_body_footer', 'body_footer_template', $template_data);
        $this->do_template_action('alstradocs_render_' . $this->id . '_footer', 'footer_template', $template_data);
    }

    /**
     * @param template_data
     */
    public function render_named_template($template_name, $template_data)
    {
        if (!isset($template_name)) {
            throw new Alstradocs_Controller_Exception('Invalid template controller configuration. View name not specified');
        }
        $template = $this->app->make($template_name);
        $template->render($template_data);
    }



    /**
     * @param action_name Action name
     * @param template_name Template name
     * @param template_data Template data
     */
    protected function do_template_action($action_name, $template_config_key, $template_data)
    {
        if ($this->has_data_item($template_config_key)) {
            do_action($action_name, $this->get_data_item($template_config_key), $template_data);
        }
    }
}
