<?php

namespace Enterprise\Framework\Ui\Controller\Filter;

/**
 *
 * @author     Edward Banfa <ebanfa@alstradocs.com>
 */
interface Alstradocs_Admin_Abstract_Query_Filter_Interface {

	/**
	 *
	 * @param $query The template information
   */
	public function filter($query);
}
