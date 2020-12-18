<?php

namespace Alstradocs\Framework\Ui\Template\Setting;

use Enterprise\Framework\Ui\Template\Alstradocs_Template;

/**
 *
 * @author  Edward Banfa <ebanfa@alstradocs.com>
 */
final class Alstradocs_Admin_Settings_Section_Template
{
    use Alstradocs_Template {
        Alstradocs_Template::do_render as parent_do_render;
    };

    /**
     *
     * @param template_data The template data
     */
    protected function do_render($template_data)
    {

        //
        global $wp_settings_sections, $wp_settings_fields;

        if (! isset($wp_settings_sections[ $template_data['menu_slug'] ])) {
            return;
        }

        foreach ((array) $wp_settings_sections[ $template_data['menu_slug'] ] as $section) {
            if ($this->isTitleVisible($template_data, $section['id'])) {
                echo "<h5 class='alstradocs-settings-section-title col-md-12 m-b-20'>{$section['title']}</h5>";
            }

            if ($section['callback']) {
                call_user_func($section['callback'], $section);
            }

            if (! isset($wp_settings_fields) || ! isset($wp_settings_fields[ $template_data['menu_slug'] ]) || ! isset($wp_settings_fields[ $template_data['menu_slug'] ][ $section['id'] ])) {
                continue;
            }
            /* echo '<table class="form-table" role="presentation">'; */
            $template_data['page_section_id'] = $section['id'];
            $this->do_settings_fields($template_data);
            /* echo '</table>'; */
        }

        //$section_template->render($template_data);
    }
    /**
     * Renders the fields in admin menu page section.
     *
     * @param page_data The page information
     * @param section The section information
     */
    public function do_settings_fields($template_data)
    {
        global $wp_settings_fields;
        $field_template = $this->app->make($template_data['field_template']);

        if (! isset($wp_settings_fields[ $template_data['menu_slug'] ][ $template_data['page_section_id'] ])) {
            return;
        }

        foreach ((array) $wp_settings_fields[ $template_data['menu_slug'] ][ $template_data['page_section_id'] ] as $field) {
            /* $class = '';
            if ( ! empty( $field['args']['class'] ) ) {
                $class = ' class="' . esc_attr( $field['args']['class'] ) . '"';
            }
            echo "<tr{$class}>";
            if ( ! empty( $field['args']['label_for'] ) ) {
                echo '<th scope="row"><label for="' . esc_attr( $field['args']['label_for'] ) . '">' . $field['title'] . '</label></th>';
            } else {
                echo '<th scope="row">' . $field['title'] . '</th>';
            }
            echo '<td>'; */
            $field_template->render($field['args']);
            //call_user_func( $field['callback'], $field['args'] );
            /* echo '</td>';
            echo '</tr>'; */
        }
    }

    public function isTitleVisible($page_data, $section_id)
    {
        $isVisible = false;
        foreach ($page_data['sections'] as $section) {
            if ($section_id === $section['id']) {
                if (array_key_exists('show_title', $section) && $section['show_title']) {
                    $isVisible = true;
                }
            }
        }
        return $isVisible;
    }
}
