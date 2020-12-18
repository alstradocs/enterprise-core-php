<?php


namespace Enterprise\Framework\Ui\Template\Setting;

use Enterprise\Framework\Ui\Template\Alstradocs_Template;

/**
 *
 * @author  Edward Banfa <ebanfa@alstradocs.com>
 */
final class Alstradocs_Admin_Settings_Field_Template
{
    use Alstradocs_Template {
        Alstradocs_Template::do_render as parent_do_render;
    };

    /**
     *
     * @param template_data The template data
     */
    public function do_render($field)
    {
        $colspan = 'col-md-12';
        if (array_key_exists('colspan', $field)) {
            $colspan = 'col-md-' . $field['colspan'];
        }

        if (!array_key_exists('placeholder', $field)) {
            $field['placeholder'] = $field['title'];
        }

        $iconHTML = '';
        if (array_key_exists('icon', $field)) {
            $iconHTML = '<span class="input-group-addon">
 				      		<i class="material-icons">' . $field['icon'] . '</i>
 						</span>';
        }

        echo '	<div class="' . $colspan . '">
 					<label for="email_address">' . $field['title'] . '</label>
 					<div class="input-group">
 						' . $iconHTML . '
 						<div class="form-line">
 							<input type="' . $field['type'] . '"
 								placeholder="' . $field['placeholder'] . '"
 								name="' . $field['name'] . '"
 								class="form-control"
 								value="' . esc_attr(get_option($field['name'])) . '"/>
 						</div>
 					</div>
 				</div>';
    }
}
