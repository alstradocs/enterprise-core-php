<?php
namespace Enterprise\Framework\Action;

use Enterprise\Framework\Action\Alstradocs_Action;
use Enterprise\Framework\Controller\Alstradocs_Configurable_Controller;
use Enterprise\Framework\Configuration\Alstradocs_Configuration_Exception;

/**
 *
 */
abstract class Alstradocs_Abstract_Action extends Alstradocs_Configurable_Controller implements Alstradocs_Action
{
    /**
     *
     */
    protected function do_register() {
        parent::do_register();
        $this->loader->add_action_once('alstradocs_execute_' . $this->get_id() . '_action',  $this, 'execute', 1, 1);
    }

    /**
     * @param data The data required to execute the action
     */
    public function execute($data = [])
    {
        return $this->do_execute($data);
    }

    /**
     * @param data The data required to execute the action
     */
    abstract protected function do_execute($data);
    /***/
    protected function get_id(){
        if(is_null($this->id) || $this->id === '')  {
            throw new Alstradocs_Configuration_Exception('Action id is required' . get_called_class() );
        }
        return $this->id;
    }

}
