<?php
namespace Enterprise\Domain\Auth\Action;

use Enterprise\Framework\Action\Alstradocs_Abstract_Init_Action;

/**
 * This action execute on WP init hook to automatically
 * signin users with auto created accounts.
 */
class Alstradocs_Auto_Signin_Action extends Alstradocs_Abstract_Init_Action
{
    protected $id = 'alstradocs_auth_auto_signin_action';

    /**
     * Do the auto signin stuff
     * @param data
     */
    protected function do_execute($data = [])
    {
        if (!$this->is_valid_request()) 
            return; 
        // Resolve the user from the request data
        $user = $this->get_requesting_user();

        if (!is_wp_error($user) && $this->can_user_auto_signin($user)) {
            // Do the auto sigin
            wp_clear_auth_cookie();
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID);
        }
        // Process redirects if set
        if (isset($_POST['alstradocs_target_url'])) {
            wp_redirect($_POST['alstradocs_target_url']);
            exit();
        }
    }

    /**
     * Function to validate if the request is for this class
     */
    private function is_valid_request() {
        if (isset($_POST['alstradocs_auth_action']) && $_POST['alstradocs_auth_action'] === 'alstradocs_auth_can_auto_signin') {
            if (isset($_POST['user_name']) || isset($_POST['emailAddress'])) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param wp_user The WP_User
     */
    protected function can_user_auto_signin($wp_user) {
        return true;
    }

    /**
     * Get the username or email from the request paramters
     */
    protected function get_requesting_user() {
        if(isset($_POST['user_name'])) {
            return get_user_by('login', $_POST['user_name']);
        }
        elseif(isset($_POST['emailAddress'])) {
            return get_user_by('email', $_POST['emailAddress']);
        } else {
            throw new ActionExecutionException('Invalid request. User identifier not specified');
        }
    }
}
