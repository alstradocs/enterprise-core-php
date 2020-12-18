<?php
namespace Enterprise\Domain\Auth\Action;

use Enterprise\Framework\Action\Alstradocs_Abstract_Action;

class Alstradocs_Add_Capability_Action extends Alstradocs_Abstract_Action
{
    protected $id = 'alstradocs_auth_add_user_capability_action';

    /**
     *
     */
    protected static function do_execute($role_name, $capability_name)
    {
        // Gets the simple_role role object.
        $role = get_role($role_name);
        // Add a new capability.
        $role->add_cap($capability_name, true);
    }
}
