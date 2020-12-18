<?php

namespace Enterprise\Framework\Ui\Template\Form;

use Enterprise\Framework\Ui\Template\Alstradocs_Template;

/**
 *
 * @author  Edward Banfa <ebanfa@alstradocs.com>
 */
final class Alstradocs_Form_Controls_Template
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
        <div class="btn-controls-container">
          <button type="submit" data-action="<?php echo $template_data['data_controller'] ?>#submit" class="btn bg-blue btn-lg waves-effect">Submit</button>
        </div>
        <?php
        } else {
          ?>
          <div class="btn-controls-container">
            <button type="submit" class="btn bg-blue btn-lg waves-effect">Submit</button>
          </div>
          <?php
        }
    }
}
