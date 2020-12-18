<?php

namespace Enterprise\Framework\Ui\Template\Form;

use Enterprise\Framework\Ui\Template\Alstradocs_Template;
use Enterprise\Framework\Application\Configuration\Alstradocs_Configuration_Exception;

/**
 *
 * @author  Edward Banfa <ebanfa@alstradocs.com>
 */
final class Alstradocs_Form_Field_Template
{
    use Alstradocs_Template;

    /**
     *
     * @param template_data The template data
     */
    protected function do_render($field_data)
    {
        // Validate the field type
        if (!array_key_exists('type', $field_data)) {
            throw new Alstradocs_Configuration_Exception('Invalid form field type');
        }
        // Load any data required by the field
        if(array_key_exists('dataProvider', $field_data)) {
            $dataProvider = $this->app->make($field_data['dataProvider']);
            $field_data['data'] = $dataProvider->provide([]);
        }
        if ($field_data['type'] === 'text' || $field_data['type'] === 'password' || $field_data['type'] === 'number') {
            $this->render_text_field($field_data);
        }
        if ($field_data['type'] === 'hidden') {
            $this->render_hidden_field($field_data);
        }
        if ($field_data['type'] === 'select') {
            $this->render_select_field($field_data);
        }
        if ($field_data['type'] === 'checkbox') {
            $this->render_checkbox_field($field_data);
        }
        if ($field_data['type'] === 'radio') {
            $this->render_text_field($field_data);
        }
        if ($field_data['type'] === 'textarea') {
            $this->render_textarea_field($field_data);
        }
    }

    /**
     *
     * @param template_data The template data
     */
    protected function render_text_field($field_data)
    {
        ?>
        <div class="form-line">
          <input type="<?php echo $field_data['type']; ?>"
              id="<?php echo $field_data['name']; ?>"
              name="<?php echo $field_data['name']; ?>"
              <?php if(array_key_exists('data_target', $field_data)) { echo ' data-target="' . $field_data['data_target'] . '" '; } ?>
              <?php if(array_key_exists('data_action', $field_data)) { echo ' data-action="' . $field_data['data_action'] . '" '; } ?>
              class="<?php echo $field_data['style_data']['form_field_class']; ?>" placeholder="<?php echo $field_data['placeholder']; ?>">
        </div>
        <?php
    }

    /**
     *
     * @param template_data The template data
     */
    protected function render_hidden_field($field_data)
    {
        ?>
          <input type="hidden"
              id="<?php echo $field_data['name']; ?>"
              name="<?php echo $field_data['name']; ?>"
              value="<?php echo $field_data['value']; ?>"
              <?php if(array_key_exists('data_target', $field_data)) { echo ' data-target="' . $field_data['data_target'] . '" '; } ?>
              <?php if(array_key_exists('data_action', $field_data)) { echo ' data-action="' . $field_data['data_action'] . '" '; } ?>>
        <?php
    }


    /**
     *
     * @param template_data The template data
     */
    protected function render_textarea_field($field_data)
    {
        ?>
        <div class="form-line">
            <textarea id="<?php echo $field_data['name']; ?>"
                name="<?php echo $field_data['name']; ?>"
                <?php if(array_key_exists('data_target', $field_data)) { echo ' data-target="' . $field_data['data_target'] . '" '; } ?>
                <?php if(array_key_exists('data_action', $field_data)) { echo ' data-action="' . $field_data['data_action'] . '" '; } ?>
                rows="4" class="<?php echo $field_data['style_data']['form_field_class']; ?>"
                placeholder="<?php echo $field_data['placeholder']; ?>"></textarea>
        </div>
        <?php
    }

    /**
     *
     * @param template_data The template data
     */
    protected function render_checkbox_field($field_data)
    {
        ?>
          <input type="checkbox"
              name="<?php echo $field_data['name']; ?>"
              <?php if(array_key_exists('data_target', $field_data)) { echo ' data-target="' . $field_data['data_target'] . '" '; } ?>
              <?php if(array_key_exists('data_action', $field_data)) { echo ' data-action="' . $field_data['data_action'] . '" '; } ?>
              class="filled-in" id="<?php echo $field_data['name']; ?>">
          <label for="<?php echo $field_data['name']; ?>"><?php echo $field_data['placeholder']; ?></label>
      <?php
    }

    /**
     *
     * @param template_data The template data
     */
    protected function render_select_field($field_data)
    {
        ?>
          <select id="<?php echo $field_data['name']; ?>"
              name="<?php echo $field_data['name']; ?>"
              <?php if(array_key_exists('data_target', $field_data)) { echo ' data-target="' . $field_data['data_target'] . '" '; } ?>
              <?php if(array_key_exists('data_action', $field_data)) { echo ' data-action="' . $field_data['data_action'] . '" '; } ?>
              class="<?php echo $field_data['style_data']['form_field_class']; ?>">
              <?php foreach ($field_data['data'] as $key => $data_item)  { ?>
              <option value="<?php echo $data_item->id; ?>" <?php $this->add_extra_data_attribute($field_data, $data_item); ?>>
                <?php echo $data_item->name; ?>
              </option>
              <?php } ?>
          </select>
      <?php
    }


    public function add_extra_data_attribute($field_data, $data_item) {
        $data_item_array = json_decode(json_encode($data_item), true);
        if(!array_key_exists('extra_data_attribute_name', $field_data) || !array_key_exists('extra_data_attribute_value', $field_data)) {
            return;
        }
        if(!array_key_exists($field_data['extra_data_attribute_value'], $data_item_array)) {
            return;
        }
        echo ' data-' . $field_data['extra_data_attribute_name'] . '="' . $data_item_array[$field_data['extra_data_attribute_value']] . '"';
    }
}
