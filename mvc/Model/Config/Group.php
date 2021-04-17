<?php
namespace Model\Config;

    class Group extends \Model\Core\Table{
        
        public function __construct() {
            
            $this->tableName = 'config_group';
            $this->primaryKey = 'groupId';
        }

        public function getConfigs()
        {
            $this->setTableName('config');
            if (!$this->groupId) {
                return false;
            }
            $query = "SELECT * FROM `{$this->getTableName()}`
            WHERE `groupId` = '{$this->groupId}' ";
            $configs = \Mage::getModel('Model\Config\Group\Config')->fetchAll($query);
            return $configs;
        }



    }

?>