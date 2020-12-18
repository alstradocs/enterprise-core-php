<?php

namespace Enterprise\Framework\Ui\Controller;

use Enterprise\Framework\Controller\Alstradocs_Abstract_Controller;

/**
 *
 */
class Alstradocs_Controller_Shortcode extends Alstradocs_Abstract_Controller
{
    /**
     */
    public function do_register()
    {
        if (! is_admin()) {
            $this->loader->add_action('init', $this, 'do_register_shortcode');
        }
    }

    public function do_register_shortcode()
    {
        add_shortcode('alstradocs_execute_controller', array($this, 'do_alstradocs_shortcode'));
    }

    /**
     * @param atts
     */
    public function do_alstradocs_shortcode($atts)
    {
        $atts = shortcode_atts(array(
          'name' => false,
        ), $atts);
        if(!$atts['name']) return '';
        ob_start();
        do_action($atts['name']);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

}
