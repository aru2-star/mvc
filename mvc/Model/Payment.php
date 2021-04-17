<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');

    class Payment extends \Model\Core\Table{

        const STATUS_ENABLED = 1;
        const  STATUS_DISABLED = 0;
        
        public function __construct() {

            $this->tableName = 'payment';
            $this->primaryKey = 'paymentId';
        }

        public function getStatusOption(){
            return [
                self::STATUS_ENABLED => "Enabled",
                self::STATUS_DISABLED => "Disabled",
            ];
        }
    }        
?>