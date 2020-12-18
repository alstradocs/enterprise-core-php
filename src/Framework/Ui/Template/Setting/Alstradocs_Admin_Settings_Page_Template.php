<?php

namespace Enterprise\Framework\Ui\Template\Setting;

use Enterprise\Framework\Ui\Template\Alstradocs_Template;

/**
 *
 * @author  Edward Banfa <ebanfa@alstradocs.com>
 */
final class Alstradocs_Admin_Settings_Page_Template
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
        $section_template = $this->app->make($template_data['section_template']);
    ?>
       <div class="alstradocs-page-container">
         <div class="container-fluid m-t-25">
			<div class="card">
        <div class="header bg-deep-purple">
    			<h2><?php echo $template_data['page_title'] ?></h2>
    			<ul class="header-dropdown m-r-5">
    				<li class="dropdown">
    					<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    						<i class="material-icons">more_vert</i>
    					</a>
    					<ul class="dropdown-menu pull-right">
    						<li><a href="javascript:void(0);">Action</a></li>
    						<li><a href="javascript:void(0);">Another action</a></li>
    						<li><a href="javascript:void(0);">Something else here</a></li>
    					</ul>
    				</li>
    			</ul>
    		</div>
        <div class="body">
			<form class="col s12" method="post" action="options.php">
				<?php settings_fields($template_data['menu_slug']); ?>
				<div class="row clearfix">
					<?php $section_template->render($template_data); ?>
				</div>
				<?php submit_button(); ?>
			</form>
		</div>
  </div>
</div>
</div>

      <?php
    }
}
