<?php
namespace Enterprise\Framework\Controller;

use Enterprise\Framework\Controller\Alstradocs_Abstract_Controller;
use Enterprise\Framework\Configuration\Alstradocs_Has_Configuration;
use Enterprise\Framework\Configuration\Alstradocs_Configuration_Exception;

/**
 *
 */
class Alstradocs_Configurable_Controller extends Alstradocs_Abstract_Controller
{

    use Alstradocs_Has_Configuration;

    protected $id;

    /**
     */
    protected function do_register()
    {
        if($this->has_data_item('id')){
            $this->id = $this->get_data_item('id');
        }
    }


}
