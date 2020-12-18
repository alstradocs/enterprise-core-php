<?php

namespace Enterprise\Framework\Ui\Template\Form;

use Enterprise\Framework\Ui\Template\Alstradocs_Template;

/**
 *
 * @author  Edward Banfa <ebanfa@alstradocs.com>
 */
final class Alstradocs_Form_Start_Template
{
    use Alstradocs_Template;

    /**
     *
     * @param template_data The template data
     */
    protected function do_render($template_data)
    {
        if(!array_key_exists('is_ajax', $template_data) || !$template_data['is_ajax']) {

        ?>
          <div class="<?php echo $template_data['style_data']['form_container_class'] ?>">
              <form data-controller="<?php echo $template_data['data_controller'] ?>" class="<?php echo $template_data['style_data']['form_class'] ?>" onsubmit="return false">
        <?php
        } else {
          ?>
            <div class="<?php echo $template_data['style_data']['form_container_class'] ?>">
                <form data-controller="<?php echo $template_data['data_controller'] ?>" method="post" action="<?php echo $template_data['action'] ?>" class="<?php echo $template_data['style_data']['form_class'] ?>">

          <?php
        }
    }
}
