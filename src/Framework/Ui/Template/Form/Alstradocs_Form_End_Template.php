<?php

namespace Enterprise\Framework\Ui\Template\Form;

use Enterprise\Framework\Ui\Template\Alstradocs_Template;

/**
 *
 * @author  Edward Banfa <ebanfa@alstradocs.com>
 */
final class Alstradocs_Form_End_Template
{
    use Alstradocs_Template;

    /**
     *
     * @param template_data The template data
     */
    protected function do_render($template_data)
    {
        if(array_key_exists('hidden_fields', $template_data)) {
          foreach ($template_data['hidden_fields'] as $key => $field) {
              $field_value = $field['value'];
              if(array_key_exists('data_target', $field)) {
                  $field_target = $template_data['data_controller'] .'.'. $field['data_target'];
                  echo "<input type='hidden' id='{$key}' name='{$key}' value='{$field_value}' data-target='{$field_target}'>";
              }
              else {
                echo "<input type='hidden' id='{$key}' name='{$key}' value='{$field_value}'>";
              }
          }
        }
    ?>
            </form>
        </div>
        <?php

    }
}
