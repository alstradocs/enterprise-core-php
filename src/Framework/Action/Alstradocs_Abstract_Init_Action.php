<?php
namespace Enterprise\Framework\Action;

use Enterprise\Framework\Action\Alstradocs_Abstract_Action;

/**
 * This is an action the register it's execute method to run during init
 */
abstract class Alstradocs_Abstract_Init_Action extends Alstradocs_Abstract_Action
{
    /**
     *
     */
    protected function do_register() {
        parent::do_register();
        $this->loader->add_action('init',  $this, 'execute', 1, 1);
    }
}
