<?php

namespace Enterprise\Domain\Auth\Ui\Component\View\Signin;

use Enterprise\Framework\Alstradocs_Constants as Constants;

use Enterprise\Framework\Ui\Controller\Alstradocs_Abstract_Template_Controller;

/**
 *
 */
final class Alstradocs_Signin_View_Controller extends Alstradocs_Abstract_Template_Controller
{

      /**
       */
      public function get_config()
      {
          $config_data = [];
          $config_data['id'] = 'alstradocs_signin_order_view';
          $config_data['page_title'] = __('Signin', 'alstradocs-writing');
          $config_data['page_description'] = __('Signin', 'alstradocs-writing');
          $config_data['body_template'] = Constants::$alstradocs_sign_in_form_view_template;
          $config_data['form_configuration'] = Constants::$alstradocs_sign_in_form_config_repo_token;
          return $config_data;
      }
}
