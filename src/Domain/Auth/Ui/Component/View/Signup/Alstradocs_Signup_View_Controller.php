<?php

namespace Enterprise\Domain\Auth\Ui\Component\View\Signup;

use Enterprise\Framework\Alstradocs_Constants as Constants;
use Enterprise\Framework\Ui\Controller\Alstradocs_Abstract_Template_Controller;

/**
 *
 */
final class Alstradocs_Signup_View_Controller extends Alstradocs_Abstract_Template_Controller
{
    /**
     */
    public function get_config()
    {
        $config_data = [];
        $config_data['id'] = 'alstradocs_signup_order_view';
        $config_data['page_title'] = __('Signup', 'alstradocs-writing');
        $config_data['page_description'] = __('Signup', 'alstradocs-writing');
        $config_data['body_template'] = Constants::$alstradocs_sign_up_form_view_controller;
        $config_data['form_configuration'] = Constants::$alstradocs_sign_up_form_config_repo_token;
        return $config_data;
    }
}
