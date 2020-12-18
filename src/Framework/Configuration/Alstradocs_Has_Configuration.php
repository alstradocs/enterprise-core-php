<?php

namespace Enterprise\Framework\Configuration;

/**
 *
 * @author     Edward Banfa <ebanfabanfa@alstradocs.com>
 */
trait Alstradocs_Has_Configuration
{
    protected $config_data = [];

    /**
     *
     */
    public function get_config()
    {
        return $this->config_data;
    }

    /**
     *
     */
    public function set_config($item_key, $config_data)
    {
        if($this->has_data_item($item_key)) {
          throw new Alstradocs_Configuration_Exception('Configureation item ' . $item_key . 'already exists');
        }
        $this->config_data = $config_data;
    }

    /**
     * @param item_key Configuration item index
     */
    public function get_data_item($item_key)
    {
        $this->config_data = $this->get_config();
        if (!array_key_exists($item_key, $this->config_data)) {
            throw new Alstradocs_Configuration_Exception('Controller config item: '. $item_key . ' not found');
        }
        return $this->config_data[$item_key];
    }

    /**
     * @param item_key Configuration item index
     */
    public function has_data_item($item_key)
    {
        $this->config_data = $this->get_config();
        if (!array_key_exists($item_key, $this->config_data)) {
            return false;
        }
        return true;
    }
}
