<?php
namespace Enterprise\Domain\Auth\Action;

use Enterprise\Framework\Action\Alstradocs_Abstract_Action;

class Alstradocs_Redirect_To_Custom_Login_Page_Action extends Alstradocs_Abstract_Action
{
    protected $id = 'auth_redirect_to_custom_login_page';

    /**
     *
     */
    protected function do_register() {
        parent::do_register();
        $this->loader->add_action('init',  $this, 'execute', 1, 1);
    }

    /**
     *
     */
    protected function do_execute($data = [])
    {
        // WP tracks the current page - global the variable to access it
        global $pagenow;
        // Check if a $_GET['action'] is set, and if so, load it into $action variable
        $action = (isset($_GET['action'])) ? $_GET['action'] : '';
        // Check if we're on the login page, and ensure the action is not 'logout'
        if( $pagenow == 'wp-login.php' && ( ! $action || ( $action && ! in_array($action, array('logout', 'lostpassword', 'rp', 'resetpass'))))) {
           // Load the home page url
           $login_page  = home_url( '/login/' );
           // Handle the redirect_to parameter
           if ( ! empty( $_GET['redirect_to'] ) ) {
          		$redirect_to = $requested_redirect_to = $_GET['redirect_to'];
          		$login_page = add_query_arg( 'redirect_to', $redirect_to, $login_page );
           }
           // Redirect to the home page
           wp_redirect($login_page);
           // Stop execution to prevent the page loading for any reason
           exit();
        }
    }
}
