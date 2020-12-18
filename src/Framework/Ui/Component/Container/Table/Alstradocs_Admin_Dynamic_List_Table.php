<?php

namespace Enterprise\Framework\Ui\Component\Container\Table;

use Enterprise\Framework\Ui\Component\Container\Table\Alstradocs_Abstract_List_Table;
use Enterprise\Framework\Ui\Util\Alstradocs_Admin_Dynamic_List_Table_Util;

class Alstradocs_Admin_Dynamic_List_Table extends Alstradocs_Abstract_List_Table {

    protected $alstradocs_columns = array();
    protected $alstradocs_columns_sortable = array();

    protected $data_views = array();
    protected $bulk_actions = array();

    protected $page_data = array();
    protected $table_data = array();
    protected $view_name = '';
    protected $view_path = '';
    protected $view_items = [];
    protected $search_field = '';
    protected $query_filter;

    public function __construct($app, $page_data)    {
        parent::__construct($app);

        $this->page_data = $page_data;

        // Validate supplied data and ensure all required items are valid
        Alstradocs_Admin_Dynamic_List_Table_Util::validate_table_data($page_data);

        $this->table_data = $page_data['extra_data'];

        $this->alstradocs_table_name = $this->table_data['alstradocs_table_name'];
        $this->alstradocs_singular_label = $this->table_data['alstradocs_singular_label'];
        $this->alstradocs_plural_label = $this->table_data['alstradocs_plural_label'];
        $this->alstradocs_edit_url = $this->table_data['alstradocs_edit_url'];

        $this->alstradocs_columns = Alstradocs_Admin_Dynamic_List_Table_Util::get_columns($page_data);
        $this->alstradocs_columns_sortable = Alstradocs_Admin_Dynamic_List_Table_Util::get_sortable_columns($page_data);

        $this->data_views = Alstradocs_Admin_Dynamic_List_Table_Util::get_linkless_views($this->table_data);
        $this->bulk_actions = Alstradocs_Admin_Dynamic_List_Table_Util::get_bulk_actions($this->table_data);

        $this->view_name = Alstradocs_Admin_Dynamic_List_Table_Util::get_view_name($this->table_data);
        $this->view_path = Alstradocs_Admin_Dynamic_List_Table_Util::get_view_path($this->table_data);
        $this->view_items = Alstradocs_Admin_Dynamic_List_Table_Util::get_view_items($this->table_data);
        $this->search_field = Alstradocs_Admin_Dynamic_List_Table_Util::get_search_field($this->table_data);

        if(array_key_exists('alstradocs_table_filter', $this->table_data)){
            $this->query_filter = $this->app->make($this->table_data['alstradocs_table_filter']);
        }


    }

    /**
     * Display the list of views available on this table.
     * Overriden to display views as dropdown list
     * @since 3.1.0
     */
    public function views()
    {
        $views = $this->get_views();
        /**
         * Filters the list of available list table views.
         *
         * The dynamic portion of the hook name, `$this->screen->id`, refers
         * to the ID of the current screen, usually a string.
         *
         * @since 3.5.0
         *
         * @param string[] $views An array of available list table views.
         */
        $views = apply_filters("views_{$this->screen->id}", $views);

        if (empty($views)) {
            return;
        }

        $this->screen->render_screen_reader_content('heading_views');
        // Check if view_name is present in REQUEST
        $is_all_view = false;
        $selected_id = false;
        if(array_key_exists($this->view_name, $_GET)) {
            $selected_id = filter_input(INPUT_GET, $this->view_name, FILTER_VALIDATE_INT);
            // Render the 'All view if we do not have a valid id'
            if($selected_id) {
               $is_all_view = true;
            }
        }
        // if not then set marker for ftp_alloc
        // If it is present then get the value of the REQUEST param
        // Set the marker for the specified
        echo "<select id='data_table_id' class='subsubsub'>\n";
        foreach ($views as $view_id => $view) {
            if($selected_id && $selected_id === $view_id) {
                echo("<option selected='selected' value='{$view_id}'>{$view}</option>");
            }
            else {
                echo("<option value='{$view_id}'>{$view}</option>");
            }
        }
        echo '</select>';
        $view_url = add_query_arg($this->view_name, 0);
        echo "<script>jQuery('#data_table_id').on('change', function() { window.location = '{$view_url}'.slice(0, -1) + this.value; });</script>";
    }

    /**
     *
     */
    function get_bulk_actions() {
        return $this->bulk_actions;
    }

    public function process_bulk_action() {
        // security check!
        if ( isset( $_POST['_wpnonce'] ) && ! empty( $_POST['_wpnonce'] ) ) {
            $nonce  = filter_input( INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING );
            $action = 'bulk-' . $this->_args['plural'];

            if ( ! wp_verify_nonce( $nonce, $action ) )
                wp_die( 'Nope! Security check failed!' );
        }

        $action = $this->current_action();
        if(!empty($action)) {
          $controller_name = Alstradocs_Admin_Dynamic_List_Table_Util::get_action_controller_name($action, $this->table_data);
          $controller_instance = $this->app->make($controller_name);
        }
        return;
    }

    protected function get_views() {
        return $this->data_views;
    }


}
