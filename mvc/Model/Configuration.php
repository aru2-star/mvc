<?php
namespace Model;

class Configuration extends Core\Table
{
    public function __construct() {
        $this->primaryKey = 'groupId';
        $this->tableName = 'config_group';
    }
}


?>