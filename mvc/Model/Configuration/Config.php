<?php
namespace Model\Configuration;

class Config extends \Model\Core\Table
{
    public function __construct() {
        $this->primaryKey = 'configId';
        $this->tableName = 'config';
    }
}


?>