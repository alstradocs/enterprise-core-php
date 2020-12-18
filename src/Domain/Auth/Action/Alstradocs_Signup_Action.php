<?php
namespace Enterprise\Domain\Auth\Action;

use Enterprise\Framework\Action\Alstradocs_Abstract_Action;

/**
 *
 */
class Alstradocs_Signup_Action extends Alstradocs_Abstract_Action
{
    protected $id = 'alstradocs_auth_signup_action';

    /**
     *
     */
    protected function do_register() {
        parent::do_register();
        $this->loader->add_action('init',  $this, 'execute', 1, 1);
    }

    /**
     * @param data
     */
    protected function do_execute($data = []) {
        // not the login request?
        if(!isset($_POST['action']) || $_POST['action'] !== 'alstradocs-signup')
          return;

        $redirect_to = '';

        if(!isset($_POST['user_name']) || !isset($_POST['password']) || !isset($_POST['email']) ) {
             $redirect_to = home_url('/register');
             $redirect_to = add_query_arg('result', 'failed', $redirect_to);
        }
        $user_name = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING);
        $user_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $user_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        $user_id = username_exists( $user_name );

        if ( ! $user_id && false == email_exists( $user_email ) ) {
            $user_id = wp_create_user( $user_name, $user_password, $user_email );
            // Redirect URL //
            if (!is_wp_error($user_id)) {
                $user = get_user_by('id', $user_id);
                wp_clear_auth_cookie();
                wp_set_current_user($user->ID);
                wp_set_auth_cookie($user->ID);

                $redirect_to = user_admin_url();
            }
        } else {
             $redirect_to = home_url('/register');
             $redirect_to = add_query_arg('result', 'failed_user_exists', $redirect_to);
        }
        // Handle the redirect_to parameter
        wp_redirect($redirect_to);
        exit;
    }

}
