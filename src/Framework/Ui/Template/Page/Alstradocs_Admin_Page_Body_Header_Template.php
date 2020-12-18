<?php

namespace Enterprise\Framework\Ui\Template\Page;

use Enterprise\Framework\Ui\Template\Alstradocs_Template;

/**
 *
 * @author  Edward Banfa <ebanfa@alstradocs.com>
 */
final class Alstradocs_Admin_Page_Body_Header_Template
{
    use Alstradocs_Template;

    /**
     *
     * @param template_data The template data
     */
    protected function do_render($template_data)
    {
        ?>
        <div class="alstradocs-page-container">
            <div class="container-fluid">

    <?php
    }
}
