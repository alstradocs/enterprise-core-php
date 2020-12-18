<?php

namespace Enterprise\Framework\Ui\Controller;

use Enterprise\Framework\Alstradocs_Constants as Constants;
/**
 *
 */
class Alstradocs_Form_Widget_Controller extends Alstradocs_Abstract_Template_Controller
{
    /**
     */
    public function do_register() {
      //parent::do_register();
      $this->controller_id = $this->get_data_item('controller_id');
      /** Actions */

      $this->loader->add_action('alstradocs_' . $this->controller_id . '_controller_do_form', $this, 'do_form', 1);
      $this->loader->add_action('alstradocs_' . $this->controller_id . '_controller_do_before_form', $this, 'do_before_form', 1, 2);
      $this->loader->add_action('alstradocs_' . $this->controller_id . '_controller_do_after_form', $this, 'do_after_form', 1, 2);

      $this->loader->add_action('alstradocs_' . $this->controller_id . '_controller_do_before_form_section', $this, 'do_before_form_section', 1, 2);
      $this->loader->add_action('alstradocs_' . $this->controller_id . '_controller_do_form_section', $this, 'do_form_section', 1, 2);
      $this->loader->add_action('alstradocs_' . $this->controller_id . '_controller_do_after_form_section', $this, 'do_after_form_section', 1, 2);

      $this->loader->add_action('alstradocs_' . $this->controller_id . '_controller_do_before_form_field_group', $this, 'do_before_form_field_group', 1, 2);
      $this->loader->add_action('alstradocs_' . $this->controller_id . '_controller_do_form_field_group', $this, 'do_form_field_group', 1, 2);
      $this->loader->add_action('alstradocs_' . $this->controller_id . '_controller_do_after_form_field_group', $this, 'do_after_form_field_group', 1, 2);

      $this->loader->add_action('alstradocs_' . $this->controller_id . '_controller_do_before_form_field', $this, 'do_before_form_field', 1, 1);
      $this->loader->add_action('alstradocs_' . $this->controller_id . '_controller_do_form_field', $this, 'do_form_field', 1, 1);
      $this->loader->add_action('alstradocs_' . $this->controller_id . '_controller_do_after_form_field', $this, 'do_after_form_field', 1, 1);

      $this->loader->add_action('alstradocs_' . $this->controller_id . '_controller_do_hidden_form_field', $this, 'do_hidden_form_field', 1, 1);

      $this->loader->add_action('alstradocs_' . $this->controller_id . '_controller_do_form_controls', $this, 'do_form_controls', 1, 2);

      /** Filters */
      $this->loader->add_filter('alstradocs_' . $this->controller_id . '_controller_filter_form_data', $this, 'filter_form_data', 1, 1);
      $this->loader->add_filter('alstradocs_' . $this->controller_id . '_controller_filter_form_section_data', $this, 'filter_form_section_data', 1, 2);
      $this->loader->add_filter('alstradocs_' . $this->controller_id . '_controller_filter_form_field_group_data', $this, 'filter_form_field_group_data', 1, 2);
      $this->loader->add_filter('alstradocs_' . $this->controller_id . '_controller_filter_form_field_data', $this, 'filter_form_field_data', 1, 3);

      $this->loader->add_filter('alstradocs_' . $this->controller_id . '_controller_filter_form_class', $this, 'filter_form_class', 1, 1);
      $this->loader->add_filter('alstradocs_' . $this->controller_id . '_controller_filter_form_container_class', $this, 'filter_form_container_class', 1, 1);

      $this->loader->add_filter('alstradocs_' . $this->controller_id . '_controller_filter_form_sections_container_class', $this, 'filter_form_sections_container_class', 1, 1);
      $this->loader->add_filter('alstradocs_' . $this->controller_id . '_controller_filter_form_section_class', $this, 'filter_form_section_class', 1, 1);

      $this->loader->add_filter('alstradocs_' . $this->controller_id . '_controller_filter_form_field_group_class', $this, 'filter_form_field_group_class', 1, 1);
      $this->loader->add_filter('alstradocs_' . $this->controller_id . '_controller_filter_form_field_group_container_class', $this, 'filter_form_field_group_container_class', 1, 1);

      $this->loader->add_filter('alstradocs_' . $this->controller_id . '_controller_filter_form_field_class', $this, 'filter_form_field_class', 1, 1);
      $this->loader->add_filter('alstradocs_' . $this->controller_id . '_controller_filter_form_field_container_class', $this, 'filter_form_field_container_class', 1, 1);

    }

    /**
     * @param form_data
     * @param form_classes
     */
    public function do_form($form_data) {
        $form_data = apply_filters('alstradocs_' . $this->controller_id . '_controller_filter_form_data', $form_data);
        $form_data['style_data']['form_class'] = apply_filters('alstradocs_' . $this->controller_id . '_controller_filter_form_class', $form_data['style_data']['form_class']);
        $form_data['style_data']['form_container_class'] = apply_filters('alstradocs_' . $this->controller_id . '_controller_filter_form_container_class', $form_data['style_data']['form_container_class']);

        do_action('alstradocs_' . $this->controller_id . '_controller_do_before_form', $form_data);

        if(array_key_exists('sections', $form_data)) {
            foreach ($form_data['sections'] as $key => $section_data) {
                $section_data = apply_filters('alstradocs_' . $this->controller_id . '_controller_filter_form_section_data', $form_data, $section_data);

                $section_data['style_data']['form_sections_container_class'] = apply_filters('alstradocs_' . $this->controller_id . '_controller_filter_form_sections_container_class', $section_data['style_data']['form_sections_container_class']);
                $section_data['style_data']['form_section_class'] = apply_filters('alstradocs_' . $this->controller_id . '_controller_filter_form_section_class', $section_data['style_data']['form_section_class']);

                do_action('alstradocs_' . $this->controller_id . '_controller_do_before_form_section', $form_data, $section_data);
                do_action('alstradocs_' . $this->controller_id . '_controller_do_form_section', $form_data, $section_data);
                do_action('alstradocs_' . $this->controller_id . '_controller_do_after_form_section', $form_data, $section_data);
            }
        }
        do_action('alstradocs_' . $this->controller_id . '_controller_do_form_controls', $form_data);
        do_action('alstradocs_' . $this->controller_id . '_controller_do_after_form', $form_data);
    }

    /**
     * @param form_data
     */
    public function do_before_form($form_data) {
        $this->render_named_template(Constants::$alstradocs_form_start_template, $form_data);
    }

    /**
     * @param form_data
     */
    public function do_after_form($form_data) {
        $this->render_named_template(Constants::$alstradocs_form_end_template, $form_data);
    }

    /**
     * @param form_data
     */
    public function do_form_controls($form_data) {
        $this->render_named_template(Constants::$alstradocs_form_controls_template, $form_data);
    }

   /**
    * @param form_data
    */
    public function filter_form_data($form_data) {
      return $form_data;
    }

    /**
     * @param form_class
     */
    public function filter_form_class($form_class) {
      return $form_class;
    }

    /**
     * @param form_container_class
     */
    public function filter_form_container_class($form_container_class) {
      return $form_container_class;
    }

    /**
     * @param section_data
     * @param form_classes
     */
    public function do_before_form_section($section_data) {
        $this->render_named_template(Constants::$alstradocs_form_section_start_template, $section_data);
    }

    /**
     * @param section_data
     * @param form_classes
     */
    public function do_form_section($form_data, $section_data) {
        if(array_key_exists('fields_group', $section_data)) {
            foreach ($section_data['fields_group'] as $key => $fields_group_data) {
                $fields_group_data = apply_filters('alstradocs_' . $this->controller_id . '_controller_filter_form_field_group_data', $section_data, $fields_group_data);

                $fields_group_data['style_data']['form_field_group_container_class'] = apply_filters('alstradocs_' . $this->controller_id . '_controller_filter_form_field_group_container_class', $fields_group_data['style_data']['form_field_group_container_class']);
                $fields_group_data['style_data']['form_field_group_class'] = apply_filters('alstradocs_' . $this->controller_id . '_controller_filter_form_field_group_class', $fields_group_data['style_data']['form_field_group_class']);

                do_action('alstradocs_' . $this->controller_id . '_controller_do_before_form_field_group', $section_data, $fields_group_data);
                do_action('alstradocs_' . $this->controller_id . '_controller_do_form_field_group', $section_data, $fields_group_data);
                do_action('alstradocs_' . $this->controller_id . '_controller_do_after_form_field_group', $section_data, $fields_group_data);
            }
        }
    }

    /**
     * @param section_data
     * @param form_classes
     */
    public function do_after_form_section($form_data, $section_data) {
        $this->render_named_template(Constants::$alstradocs_form_section_end_template, $section_data);
    }

   /**
    * @param section_data
    */
    public function filter_form_section_data($form_data, $section_data) {
      $section_data['style_data'] = $form_data['style_data'];
      return $section_data;
    }

    /**
     * @param form_section_class
     */
    public function filter_form_section_class($form_section_class) {
      return $form_section_class;
    }

    /**
     * @param form_section_container_class
     */
    public function filter_form_sections_container_class($form_sections_container_class) {
      return $form_sections_container_class;
    }

    /**
     * @param section_data
     * @param form_field_group_data
     */
    public function do_before_form_field_group($section_data, $form_field_group_data) {
        $this->render_named_template(Constants::$alstradocs_form_field_group_start_template, $form_field_group_data);
    }

    /**
     * @param section_data
     * @param form_field_group_data
     */
     public function do_form_field_group($section_data, $form_field_group_data) {
         if(array_key_exists('fields', $form_field_group_data)) {
             foreach ($form_field_group_data['fields'] as $key => $field_data) {
                 $field_data['name'] = $key;
                 if(!array_key_exists('is_hidden', $field_data) || $field_data['is_hidden'] !== true) {
                     $field_data = apply_filters('alstradocs_' . $this->controller_id . '_controller_filter_form_field_data', $section_data, $form_field_group_data, $field_data);

                     $field_data['style_data']['form_field_class'] = apply_filters('alstradocs_' . $this->controller_id . '_controller_filter_form_field_class', $field_data['style_data']['form_field_class']);
                     $field_data['style_data']['form_field_container_class'] = apply_filters('alstradocs_' . $this->controller_id . '_controller_filter_form_field_container_class', $field_data['style_data']['form_field_container_class']);

                     do_action('alstradocs_' . $this->controller_id . '_controller_do_before_form_field', $field_data);
                     do_action('alstradocs_' . $this->controller_id . '_controller_do_form_field', $field_data);
                     do_action('alstradocs_' . $this->controller_id . '_controller_do_after_form_field', $field_data);
                 }
                 elseif(array_key_exists('is_hidden', $field_data) && $field_data['is_hidden'] === true) {
                    do_action('alstradocs_' . $this->controller_id . '_controller_do_hidden_form_field', $field_data);
                 }
             }
         }
     }

    /**
     * @param section_data
     * @param form_field_group_data
     */
    public function do_after_form_field_group($section_data, $form_field_group_data) {
        $this->render_named_template(Constants::$alstradocs_form_field_group_end_template, $form_field_group_data);
    }

   /**
    * @param form_field_group_data
    */
    public function filter_form_field_group_data($section_data, $form_field_group_data) {
        $form_field_group_data['style_data'] = $section_data['style_data'];
        return $form_field_group_data;
    }

    /**
     * @param form_field_group_class
     */
    public function filter_form_field_group_class($form_field_group_class) {
        return $form_field_group_class;
    }

    /**
     * @param form_field_group_container_class
     */
    public function filter_form_field_group_container_class($form_field_group_container_class) {
        return $form_field_group_container_class;
    }

   /**
    * @param field_data
    */
   public function filter_form_field_data($section_data, $form_field_group_data, $field_data) {
       if(array_key_exists('style_data', $field_data)) {
          $field_data['style_data'] = array_merge($form_field_group_data['style_data'], $field_data['style_data']);
       }
       else {
          $field_data['style_data'] = $form_field_group_data['style_data'];
       }
       return $field_data;
   }

   /**
    * @param form_field_class
    */
   public function filter_form_field_class($form_field_class) {
       return $form_field_class;
   }

   /**
    * @param form_field_container_class
    */
   public function filter_form_field_container_class($form_field_container_class) {
       return $form_field_container_class;
   }

   /**
    * @param field_data
    */
   public function do_before_form_field($field_data) {
       $this->render_named_template(Constants::$alstradocs_form_field_start_template, $field_data);
   }

   /**
    * @param field_data
    */
   public function do_form_field($field_data) {
       $this->render_named_template(Constants::$alstradocs_form_field_template, $field_data);
   }

   /**
    * @param field_data
    */
   public function do_hidden_form_field($field_data) {
       $this->render_named_template(Constants::$alstradocs_form_field_template, $field_data);
   }

   /**
    * @param field_data
    */
   public function do_after_form_field($field_data) {
       $this->render_named_template(Constants::$alstradocs_form_field_end_template, $field_data);
   }

}
