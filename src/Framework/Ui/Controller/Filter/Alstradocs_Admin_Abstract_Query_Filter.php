<?php

namespace Enterprise\Framework\Ui\Controller\Filter;

use Enterprise\Framework\Controller\Alstradocs_Abstract_Controller;

/**
 *
 * @package    Alstradocs_Writing
 * @subpackage Alstradocs_Writing/admin
 * @author     Edward Banfa <ebanfa@alstradocs.com>
 */
abstract class Alstradocs_Admin_Abstract_Query_Filter extends Alstradocs_Abstract_Controller implements Alstradocs_Admin_Abstract_Query_Filter_Interface
{

    /**
     *
     * @param query The template information
     */
    public function filter($query)
    {
        $query = $this->before_filter($query);
        return $this->do_filter($query);
    }

    /**
     *
     */
    protected function before_filter($query)
    {
      return $query;
    }

    /**
     *
     */
    abstract protected function do_filter($query);

    protected function do_register() {

    }
}
