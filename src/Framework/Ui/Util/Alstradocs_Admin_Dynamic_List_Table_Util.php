<?php

namespace Enterprise\Framework\Ui\Util;

use Enterprise\Framework\Configuration\Alstradocs_Configuration_Exception;

/**
 *
 */
class Alstradocs_Admin_Dynamic_List_Table_Util
{
    /**
     * @param page_data
     */
    public static function validate_table_data($page_data)
    {
        if (!array_key_exists('extra_data', $page_data)) {
            throw new Alstradocs_Configuration_Exception('Invalid dynamic list configuration. Template data key not found');
        }
        // code...
    }

    /**
     * @param page_data
     */
    public static function get_fields($page_data)
    {
        if (!array_key_exists('sections', $page_data)) {
            throw new Alstradocs_Configuration_Exception('Invalid dynamic list configuration. No sections found');
        }

        if (empty($page_data['sections'])) {
            throw new Alstradocs_Configuration_Exception('Invalid dynamic list configuration. Empty sections configuration');
        }

        $first_section = $page_data['sections'][0];

        if (empty($first_section)) {
            throw new Alstradocs_Configuration_Exception('Invalid dynamic list configuration. Empty section configuration');
        }

        if (!array_key_exists('fields', $first_section)) {
            throw new Alstradocs_Configuration_Exception('Invalid dynamic list configuration. Section has no fields');
        }

        return $first_section['fields'];
    }

    /**
     * @param page_data
     */
    public static function get_columns($page_data)
    {
        $columns = array();
        $fields = self::get_fields($page_data);

        foreach ($fields as $field_key => $field) {
            $columns[$field['name']] = $field['title'];
        }
        return $columns;
    }

    /**
     * @param page_data
     */
    public static function get_sortable_columns($page_data)
    {
        $columns = array();
        $fields = self::get_fields($page_data);

        foreach ($fields as $field_key => $field) {
            $columns[$field['name']] = $field['name'];
        }
        return $columns;
    }

    /**
     * @param page_data
     */
    public static function get_views($table_data)
    {
        $views = array();
        $view_name = self::get_view_name($table_data);
        $view_path = self::get_view_path($table_data);
        $view_items = self::get_view_items($table_data);

        $current = (!empty($_REQUEST[$view_name]) ? $_REQUEST[$view_name] : 'all');

        foreach ($view_items as $view) {
            $view_url = add_query_arg($view_name, $view['name']);
            $class = ($current == $view['name'] ? ' class="current"' :'');
            $views[$view['name']] = "<a href='{$view_url}' {$class}>{$view['title']}</a>";
        }
        return $views;
    }

    /**
     * @param page_data
     */
    public static function get_linkless_views($table_data)
    {
        $views = array();
        $view_name = self::get_view_name($table_data);
        $view_path = self::get_view_path($table_data);
        $view_items = self::get_view_items($table_data);

        $current = (!empty($_REQUEST[$view_name]) ? $_REQUEST[$view_name] : 'all');

        foreach ($view_items as $view) {
            $view_url = add_query_arg($view_name, $view['name']);
            $class = ($current == $view['name'] ? ' class="current"' :'');
            $views[$view['name']] = $view['title'];
        }
        return $views;
    }

    /**
     * @param page_data
     */
    public static function get_view_name($table_data)
    {
        $table_view_data = $table_data['alstradocs_table_views'];
        if (!array_key_exists('view_name', $table_view_data)) {
            throw new Alstradocs_Configuration_Exception('Invalid dynamic list configuration. Table view name not defined');
        }
        return $table_view_data['view_name'];
    }

    /**
     *
     * @param page_data
     */
    public static function get_view_path($table_data)
    {
        $table_view_data = $table_data['alstradocs_table_views'];
        if (!array_key_exists('view_path', $table_view_data)) {
            throw new Alstradocs_Configuration_Exception('Invalid dynamic list configuration. Table view path not defined');
        }
        return $table_view_data['view_path'];
    }

    /**
     *
     * @param page_data
     */
    public static function get_view_items($table_data)
    {
        $table_view_data = $table_data['alstradocs_table_views'];
        if (!array_key_exists('view_items', $table_view_data)) {
            throw new Alstradocs_Configuration_Exception('Invalid dynamic list configuration. Table view items not defined');
        }
        return $table_view_data['view_items'];
    }

    /**
     *
     * @param page_data
     */
    public static function get_search_field($table_data)
    {
        if (!array_key_exists('alstradocs_table_search_field', $table_data)) {
            throw new Alstradocs_Configuration_Exception('Invalid dynamic list configuration. Table search field not defined');
        }
        return $table_data['alstradocs_table_search_field'];
    }

    /**
     * @param page_data
     */
    public static function get_bulk_actions($table_data)
    {
        $actions = array();

        if (!array_key_exists('alstradocs_table_actions', $table_data)) {
            throw new Alstradocs_Configuration_Exception('Invalid dynamic list configuration. Table actions not defined');
        }

        foreach ($table_data['alstradocs_table_actions'] as $action_key => $action) {
            $actions[$action['name']] = $action['title'];
        }
        return $actions;
    }

    /**
     *
     * @param page_data
     */
    public static function get_action_controller_name($action, $table_data)
    {
        if (!array_key_exists('alstradocs_table_actions', $table_data)) {
            throw new Alstradocs_Configuration_Exception('Invalid dynamic list configuration. Table actions not defined');
        }

        foreach ($table_data['alstradocs_table_actions'] as $action_key => $action_item) {
            if ($action === $action_item['name']) {
                return $action_item['controller'];
            }
        }
        throw new Alstradocs_Configuration_Exception('Invalid dynamic list configuration. Action controller not found for action ' . $action);
    }
}
