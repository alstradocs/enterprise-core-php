<?php

namespace Enterprise\Framework\Service\Data;

use Enterprise\Framework\Service\Database\DatabaseServiceInterface;
use Enterprise\Framework\Service\Data\Alstradocs_Data_Provider_Interface;

/**
 *
 */
abstract class Alstradocs_Abstract_Data_Provider implements Alstradocs_Data_Provider_Interface {
    protected $app;
    protected $db;

    /**
     */
    public function __construct($app)
    {
        $this->app = $app;
        $dbService = $this->app->make(DatabaseServiceInterface::class);
        $this->db = $dbService->getDB();
    }

    public function provide($data = []) {
        if(array_key_exists('id', $data)) {
            return $this->db::table($this->get_table_name())->find($data['id']);
        }
        return $this->db::table($this->get_table_name())->get();
    }

    abstract public function get_table_name();
}
