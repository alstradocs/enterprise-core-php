<?php

namespace Enterprise\Domain\Auth\Ui\Component\View\Signup;

use Enterprise\Framework\Ui\Template\Alstradocs_Data_Template;

/**
 *
 * @author  Edward Banfa <ebanfa@alstradocs.com>
 */
class Alstradocs_Signup_View_Template
{

      use Alstradocs_Data_Template;
      /**
       *
       * @param template_data The template data
       */
      protected function do_render($template_data)
      {
        ?>

        <div class="content_course_2">
            <div class="row">
                <div id="lp-archive-courses" class="col-md-9 content-single">
                    <div class="thim-course-top switch-layout-container "  style="margin-bottom:10px">
                        <div class="thim-course-switch-layout switch-layout">
                            <a href="#" class="list switchToGrid switch-active"><i class="fa fa-th-large"></i></a>
                            <a href="#" class="grid switchToList"><i class="fa fa-list-ul"></i></a>
                        </div>
                        <div class="course-index">
                            <span></span>
                        </div>
                    </div>
                    <div class="course-summary">
                        <?php do_action('alstradocs_order_writing_form_controller_do_form', $this->data['form_config']); ?>
                    </div>

                </div>

                <div id="sidebar" class="widget-area col-md-3 sticky-sidebar">
                    <div id="lp-archive-courses">
                      <div class="thim-course-top switch-layout-container " style="margin-bottom:0px">
                          <div class="thim-course-switch-layout switch-layout">
                              <a href="#" class="list switchToGrid switch-active"><i class="fa fa-th-large"></i></a>
                          </div>
                          <div class="course-index">
                              <span>Pricing</span>
                          </div>
                      </div>
                    </div>
                    <aside class="thim-course-filter-wrapper">
                        <div class="course_right">
                            <div class="" data-controller="ordercost">
                                <div class="info-box bg-red">
                                    <div class="content">
                                        <h4 class="text">TOTAL</h4>
                                        <h5 class="number count-to" data-target="ordercost.priceDisplay">0.00</h5>
                                    </div>
                                </div>
                                <div class="info-box bg-indigo">
                                    <div class="content">
                                        <h4 class="text">COST PER PAGE</h4>
                                        <h5 class="number count-to" data-target="ordercost.unitPriceDisplay">0.00</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>

                </div>

            </div>

        </div>

      <?php
    }
}
