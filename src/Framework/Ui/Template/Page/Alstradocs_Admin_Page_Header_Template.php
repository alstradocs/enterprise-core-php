<?php

namespace Enterprise\Framework\Ui\Template\Page;

use Enterprise\Framework\Ui\Template\Alstradocs_Template;

/**
 *
 * @author  Edward Banfa <ebanfa@alstradocs.com>
 */
final class Alstradocs_Admin_Page_Header_Template
{
    use Alstradocs_Template;

    /**
     *
     * @param template_data The template data
     */
    protected function do_render($template_data)
    {
        ?>
      <div class="block-header m-t-25 m-l-15">
    	    <h2>
    				   <?php echo $template_data['page_title']; ?>
    				   <small><?php echo $template_data['page_description']; ?></small>
    			</h2>
  		</div>
    <?php
    }
}
