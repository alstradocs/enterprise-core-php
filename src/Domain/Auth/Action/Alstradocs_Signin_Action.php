<?php
namespace Enterprise\Domain\Auth\Action;

use Enterprise\Framework\Action\Alstradocs_Abstract_Action;

/**
 *
 */
class Alstradocs_Signin_Action extends Alstradocs_Abstract_Action
{
    protected $id = 'alstradocs_auth_signin_action';

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
        if(!isset($_POST['action']) || $_POST['action'] !== 'alstradocs-signin')
            return;

        $redirect_to = '';
        // see the codex for wp_signon()
        $result = wp_signon();

        if(is_wp_error($result)) {
            $redirect_to = home_url('/login');
            // If we have redirect_to parameter we add it to
            // the url of the login page and redirect back to login page
            if ( ! empty( $_POST['redirect_to'] ) ) {
               $redirect_to = add_query_arg('redirect_to', $_POST['redirect_to'], $redirect_to);
            }
        }
        else {
            $redirect_to  = home_url( );
            // Handle the redirect_to parameter
            if ( ! empty( $_POST['redirect_to'] ) ) {
               $redirect_to = $_POST['redirect_to'];
            }
        }

        wp_redirect($redirect_to);

        exit;
    }

}
