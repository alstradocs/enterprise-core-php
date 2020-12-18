<?php
namespace Alstradocs\Domain\Auth\Util;

use Enterprise\Framework\Action\Alstradocs_Abstract_Action;

class Alstradocs_Remove_Capability_Action
{
    protected $id = 'alstradocs_auth_user_remove_capability_action';

    /**
     *
     */
    public static function do_execute($role_name, $capability_name)
    {
        // Gets the simple_role role object.
        $role = get_role($role_name);
        // Add a new capability.
        $role->remove_cap($capability_name, true);
    }
}
