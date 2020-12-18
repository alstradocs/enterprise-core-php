<?php

namespace Enterprise\Framework\Ui\Util;


/**
 *
 */
class Alstradoc_Field_Render_Util
{
    public static function render_field($field_data, $field_classes)
    {
  		if(!array_key_exists('placeholder', $field_data)) {
  			$field['placeholder'] = $field_data['title'];
  		}

      if(!array_key_exists('type', $['style_data']['style_data']field_data)) {
          $field_data['type'] = 'text';
      }

      if($field_data['type'] === 'text') {
          Alstradoc_Field_Render_Util::render_text_field($field_data, $field_classes);
      }

      if($field_data['type'] === 'email') {
          Alstradoc_Field_Render_Util::render_email_field($field_data, $field_classes);
      }

      if($field_data['type'] === 'number') {
          Alstradoc_Field_Render_Util::render_number_field($field_data, $field_classes);
      }

      if($field_data['type'] === 'checkbox') {
          Alstradoc_Field_Render_Util::render_checkbox_field($field_data, $field_classes);
      }

      if($field_data['type'] === 'select') {
          Alstradoc_Field_Render_Util::render_select_field($field_data, $field_classes);
      }

      if($field_data['type'] === 'radio') {
          Alstradoc_Field_Render_Util::render_radio_field($field_data, $field_classes);
      }

      if($field_data['type'] === 'textarea') {
          Alstradoc_Field_Render_Util::render_textarea_field($field_data, $field_classes);
      }
    }

    public static function render_text_field($field_data, $field_classes)
    {?>
    		<input type="text"  id="<?php echo $field_data['name']; ?>"
            placeholder="<?php echo $field_data['placeholder'] ?>"
            name="<?php  echo $field_data['name']?>"
            <?php if(array_key_exists('data_target', $field_data)) { echo ' data-target="' . $field_data['data_target'] . '" '; } ?>
            <?php if(array_key_exists('data_action', $field_data)) { echo ' data-action="' . $field_data['data_action'] . '" '; } ?>
            class="<?php echo $field_classes[$field_data['name'] . '_class'] ?>"/>
    <?php
    }

    public static function render_email_field($field_data, $field_classes)
    { ?>
    		<input type="email"  id="<?php echo $field_data['name']; ?>"
            placeholder="<?php echo $field_data['placeholder'] ?>"
            name="<?php  echo $field_data['name']?>"
            <?php if(array_key_exists('data_target', $field_data)) { echo ' data-target="' . $field_data['data_target'] . '" '; } ?>
            <?php if(array_key_exists('data_action', $field_data)) { echo ' data-action="' . $field_data['data_action'] . '" '; } ?>
            class="<?php echo $field_classes[$field_data['name'] . '_class'] ?>"/>
    <?php
    }

    public static function render_number_field($field_data, $field_classes)
    {?>
    		<input type="number"  id="<?php echo $field_data['name']; ?>"
            placeholder="<?php echo $field_data['placeholder'] ?>"
            name="<?php  echo $field_data['name']?>"
            <?php if(array_key_exists('data_target', $field_data)) { echo ' data-target="' . $field_data['data_target'] . '" '; } ?>
            <?php if(array_key_exists('data_action', $field_data)) { echo ' data-action="' . $field_data['data_action'] . '" '; } ?>
            class="<?php echo $field_classes[$field_data['name'] . '_class'] ?>"/>
    <?php
    }

    public static function render_select_field($field_data, $field_classes)
    { ?>
      <select id="<?php echo $field_data['name']; ?>"
      <?php if(array_key_exists('data_target', $field_data)) { echo ' data-target="' . $field_data['data_target'] . '" '; } ?>
      <?php if(array_key_exists('data_action', $field_data)) { echo ' data-action="' . $field_data['data_action'] . '" '; } ?>
              class="<?php echo $field_classes[$field_data['name'] . '_class']; ?>">
      <?php foreach ($field_data['data'] as $key => $data_item)  { ?>
        <option value="<?php echo $data_item->id; ?>" <?php self::add_extra_data_attribute($field_data, $data_item); ?>>
          <?php echo $data_item->name; ?>
        </option>
      <?php } ?>
      </select>
    <?php
    }

    public static function render_checkbox_field($field_data, $field_classes)
    { ?>
      <input type="checkbox"
      <?php if(array_key_exists('data_target', $field_data)) { echo ' data-target="' . $field_data['data_target'] . '" '; } ?>
      <?php if(array_key_exists('data_action', $field_data)) { echo ' data-action="' . $field_data['data_action'] . '" '; } ?>
            class="<?php echo $field_classes[$field_data['name'] . '_class']; ?>" id="<?php echo $field_data['name']; ?>" />
    <?php
    }

    public static function render_radio_field($field_data, $field_classes)
    {
      // code...
    }

    public static function render_textarea_field($field_data, $field_classes)
    {
          $text_area = '<textarea id="' . $field_data['name'] . '" class="';
          $text_area .= $field_classes[$field_data['name'] . '_class'] . '"';
          if(array_key_exists('data_target', $field_data)) {
              $text_area .= ' data-target="' . $field_data['data_target'] . '" ';
          }
          if(array_key_exists('data_action', $field_data)) {
              $text_area .= ' data-action="' . $field_data['data_action'] . '" ';
          }
          $text_area .= ' rows="5" placeholder="Your message"></textarea>';
          echo $text_area;
    }

    public static function add_extra_data_attribute($field_data, $data_item) {
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
