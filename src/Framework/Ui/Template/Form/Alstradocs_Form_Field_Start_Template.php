<?php

namespace Enterprise\Framework\Ui\Template\Form;

use Enterprise\Framework\Ui\Template\Alstradocs_Template;

/**
 *
 * @author  Edward Banfa <ebanfa@alstradocs.com>
 */
final class Alstradocs_Form_Field_Start_Template
{
    use Alstradocs_Template;

    /**
     *
     * @param template_data The template data
     */
    protected function do_render($template_data)
    {
      ?>
        <div class="<?php echo $template_data['style_data']['form_field_container_class']; ?>">
          <?php if($template_data['type'] !== 'checkbox')  {?>
            <label for="<?php echo $template_data['name']; ?>"><?php echo $template_data['placeholder']; ?></label>
          <?php } ?>
      <?php
    }
}
