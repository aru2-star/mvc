<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');

    class Brand extends \Model\Core\Table{

        const STATUS_ENABLED = 1;
        const  STATUS_DISABLED = 0;
        
        public function __construct() {

            $this->tableName = 'brand';
            $this->primaryKey = 'brandId';
        }

        public function getStatusOption(){
            return [
                self::STATUS_ENABLED => "Enabled",
                self::STATUS_DISABLED => "Disabled",
            ];
        }

    }
        
?>