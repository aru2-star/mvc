<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');

    class Admin extends \Model\Core\Table{
        
        const STATUS_ENABLED = 1;
        const  STATUS_DISABLED = 0;

        public function __construct() {
            
            $this->tableName = 'admin';
            $this->primaryKey = 'adminId';
        }

        public function getStatusOption(){
            return [
                self::STATUS_ENABLED => "Enabled",
                self::STATUS_DISABLED => "Disabled",
            ];
        }
    }

?>