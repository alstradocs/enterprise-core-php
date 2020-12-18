<?php

namespace Enterprise\Framework\Ui\Component\Container\Table;

use Enterprise\Framework\Ui\Template\Alstradocs_Template;
use Enterprise\Framework\Ui\Component\Container\Table\Alstradocs_Admin_Dynamic_List_Table;

/**
 *
 * @author  Edward Banfa <ebanfa@alstradocs.com>
 */
final class Alstradocs_Admin_Data_List_Template
{
    use Alstradocs_Template;

    protected $data_table;
    /**
     *
     * @param template_data The template data
     */
    protected function before_render($template_data)
    {
        $this->data_table = new Alstradocs_Admin_Dynamic_List_Table($this->app, $template_data);
    }

    /**
     *
     * @param template_data The template data
     */
    protected function do_render($template_data)
    {
        $this->data_table->views($template_data); ?>

      <form id="assignment-filter" method="get">
               <!-- For plugins, we also need to ensure that the form posts back to our current page -->
               <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
                     <!-- Now we can render the completed list table -->
               <?php

                   $this->data_table->process_bulk_action();

        if (isset($_REQUEST['s'])) {
            $this->data_table->prepare_items($_REQUEST['s']);
        } else {
            $this->data_table->prepare_items();
        }

        $this->data_table->search_box('search', 'search_id');
        $this->data_table->display(); ?>
           </form>


      <?php
    }
}
