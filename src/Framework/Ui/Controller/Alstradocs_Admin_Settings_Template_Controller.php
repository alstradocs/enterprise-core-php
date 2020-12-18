<?php

namespace Enterprise\Framework\Ui\Controller;

use Enterprise\Framework\Controller\Alstradocs_Controller_Exception;

/**
 *
 */
class Alstradocs_Admin_Settings_Template_Controller extends Alstradocs_Abstract_Template_Controller
{

    /**
     */
    public function do_register()
    {
        parent::do_register();
        if(array_key_exists('sections', $this->config_data)) {
            $this->loader->add_action('admin_init', $this, 'add_admin_menu_fields');
        }
    }

    /**
     * @param config_data The page information
     */
    public function add_admin_menu_fields()
    {
        /** Check permissions. */
        if (! current_user_can('manage_options')) {
            return;
        }

        $field_callback = [ /* $field_template, 'render'  */];

        $section_callback = [ /* $section_template, 'render' */ ];

        foreach ($this->config_data['sections'] as $index => $section) {
            /** Adds section. */
            add_settings_section($section['id'], $section['title'], $section_callback, $this->config_data['menu_slug']);

            foreach ($section['fields'] as $field) {
                /** Adds field. */
                add_settings_field($field['name'], $field['title'], $field_callback, $this->config_data['menu_slug'], $section['id'], $field);

                //$field_validator = $this->app->make(Alstradocs_Admin_Field_Validator::class);

                /** Register field. */
                $args = array(
                    'type'              => 'string',
                    'show_in_rest'      => true,
                    'sanitize_callback' => function ($input) use ($field) {
                        //return Alstradocs_Admin_Field_Validator::validate_field_callback($input, $field);
                        return $input;
                    }
                );

                register_setting($this->config_data['menu_slug'], $field['name'], function ($input) {
                    //return $field_validator->validate_field_callback($input, $field);
                    return $input;
                });
            }
        }
    }

    /**
     * @param template_data
     */
    public function render_template($template_data)
    {
        if(!isset($template_data) || empty($template_data)) {
            $template_data = $this->get_data();
        }

        $this->do_template_action('alstradocs_render_' . $this->id . '_header', Constants::$admin_page_header_template, $template_data);
        $this->do_template_action('alstradocs_render_' . $this->id . '_body_header', Constants::$admin_page_body_header_template, $template_data);

        if(!array_key_exists('field_template', $this->config_data) || !array_key_exists('field_template', $this->config_data)) {
            throw new Alstradocs_Controller_Exception('Missing field or section template');
        }

        $this->template = $this->app->makeWith($this->config_data['page_template']);

        $this->template->render($this->config_data);

        $this->do_template_action('alstradocs_render_' . $this->id . '_body_footer', Constants::$admin_page_body_footer_template, $template_data);
        $this->do_template_action('alstradocs_render_' . $this->id . '_footer', Constants::$admin_page_footer_template, $template_data);
    }
}
