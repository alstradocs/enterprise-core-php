<?php
namespace Enterprise\Framework\Ui\Controller;

/**
 *
 */
interface Alstradocs_Template_Controller
{
    /**
     * @param template_data
     */
    public function render_template($template_data);

    /**
     * @param template_data
     */
    public function render_named_template($template_name, $template_data);
}
