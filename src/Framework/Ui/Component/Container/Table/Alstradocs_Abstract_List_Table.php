<?php

namespace Enterprise\Framework\Ui\Component\Container\Table;

use Enterprise\Framework\Service\Database\DatabaseServiceInterface;

abstract class Alstradocs_Abstract_List_Table extends Alstradocs_List_Table
{
    protected $app;
    protected $db;
    protected $alstradocs_table_name = '';
    protected $alstradocs_singular_label = '';
    protected $alstradocs_plural_label = '';
    protected $alstradocs_supports_ajax = false;
    protected $alstradocs_display_count = 10;
    protected $alstradocs_edit_url = '';

    protected $alstradocs_columns = array();

    protected $alstradocs_columns_sortable = array();
    protected $query_filter = [];

    /**
     * Constructor, we override the parent to pass our own arguments
     * We usually focus on three parameters: singular and plural labels, as well as whether the class supports AJAX.
     */
    public function __construct($app)
    {
        parent::__construct(array(
            'singular'=> $this->alstradocs_singular_label, //Singular label
            'plural' => $this->alstradocs_plural_label, //plural label, also this well be one of the table css class
            'ajax'   => $this->alstradocs_supports_ajax //We won't support Ajax for this table
        ));
        $this->app = $app;

        $dbService = $this->app->make(DatabaseServiceInterface::class);

        $this->db = $dbService->getDB();
    }

    /**
     * Add extra markup in the toolbars before or after the list
     * @param string $which, helps you decide if you add the markup after (bottom) or before (top) the list
     */
    public function extra_tablenav($which)
    {
        if ($which == "top") {
            $this->do_top_nav();
        }
        if ($which == "bottom") {
            $this->do_bottom_nav();
        }
    }

    /**
     *
     */
    protected function do_bottom_nav()
    {
        echo '';
    }

    /**
     *
     */
    protected function do_top_nav()
    {
        echo '';
    }

    /**
     * Define the columns that are going to be used in the table
     * @return array $columns, the array of columns to use with the table
     */
    public function get_columns()
    {
        return $this->alstradocs_columns;
    }

    /**
     * Decide which columns to activate the sorting functionality on
     * @return array $sortable, the array of columns that can be sorted by the user
     */
    public function get_sortable_columns()
    {
        return $this->alstradocs_columns_sortable;
    }

    /**
     *
     */
    public function column_default($item, $column_name)
    {
        return $item->$column_name;
    }

    /**
     * Prepare the table with different parameters, pagination, columns and table elements
     */
    public function prepare_items($search='')
    {
        global $wpdb, $_wp_column_headers;
        $screen = get_current_screen();

        //Retrieve $customvar for use in query to get items.
        $view_name_var = (isset($_REQUEST[$this->view_name]) ? $_REQUEST[$this->view_name] : 'all');


        /* -- Preparing your query -- */
        //$query = "SELECT * FROM $wpdb->links";
        $query = $this->db::table($this->alstradocs_table_name);

        if($view_name_var !== 'all' && $this->view_path !== '') {
            $query = $query->where($this->view_path, $view_name_var);
        }

        if(!empty($search)){
            $query = $query->where($this->search_field, 'like', '%' . $search . '%');
            //$query .= " AND (name LIKE '%{$search}%' OR fullame LIKE '%{$search}%' OR email LIKE '%{$search}%' )";
        }
        /* -- Ordering parameters -- */
        //Parameters that are going to be used to order the result
        //$order = !empty($_GET["order"]) ? $_GET["order"] : 0;
        //$orderby = !empty($_GET["orderby"]) ? $_GET["orderby"] : 'DESC';
        $order = 'id';
        $orderby = 'DESC';

        if (!empty($orderby) & !empty($order)) {
            //$query.=' ORDER BY '.$orderby.' '.$order;
            $query = $query->orderBy($order, $orderby);
        }
        if(!is_null($this->query_filter)) {
            $query = $this->query_filter->filter($query);
        }

        /* -- Pagination parameters -- */
        //Number of elements in your table?
        $totalitems = $query->count(); //return the total number of affected rows

        //How many to display per page?
        $perpage = $this->alstradocs_display_count;

        //Which page is this?
        $paged = !empty($_GET["paged"]) ? $_GET["paged"] : 0;

        //Page Number
        if (empty($paged) || !is_numeric($paged) || $paged<=0) {
            $paged = 1;
        }

        //How many pages do we have in total?
        $totalpages = ceil($totalitems / $perpage);

        //adjust the query to take pagination into account
        if (!empty($paged) && !empty($perpage)) {
            $offset = ($paged - 1) * $perpage;
            //$query.=' LIMIT '.(int)$offset.','.(int)$perpage;
            $query = $query->offset($offset)->limit($perpage);
        }

        /* -- Register the pagination -- */
        $this->set_pagination_args(array(
            "total_items" => $totalitems,
            "total_pages" => $totalpages,
            "per_page" => $perpage,
        ));
        //The pagination links are automatically built according to those parameters

        /* -- Register the Columns -- */
        $columns = $this->get_columns();
        $_wp_column_headers[$screen->id] = $columns;

        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);

        /* -- Fetch the items -- */
        $this->items = $query->get();
    }


    public function column_id($item)
    {
        $actions = array(
          'edit' => sprintf('<a href="?page=%s&action=%s&id=%s">View</a>', $this->alstradocs_edit_url, 'edit', $item->id),
          // 'delete' => sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>', $_REQUEST['page'], 'delete', $item->id),
        );
        return sprintf('%1$s %2$s', $item->id, $this->row_actions($actions));
    }

    protected function get_views()
    {
        $status_links = array(
            "all"       => __("<a href='#'>All</a>", 'my-plugin-slug'),
            "inquiries" => __("<a href='#'>Inquiries</a>", 'my-plugin-slug'),
            "in_progress"   => __("<a href='#'>In Progress</a>", 'my-plugin-slug'),
            "completed"   => __("<a href='#'>Completed</a>", 'my-plugin-slug'),
            "revision"   => __("<a href='#'>Revision</a>", 'my-plugin-slug'),
            "disputed"   => __("<a href='#'>Disputed</a>", 'my-plugin-slug')
        );
        return $status_links;
    }


}
