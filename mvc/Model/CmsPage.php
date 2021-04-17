<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');

    class CmsPage extends \Model\Core\Table{
        
        const STATUS_ENABLED = 1;
        const  STATUS_DISABLED = 0;

        public function __construct() {
            
            $this->tableName = 'cms_page';
            $this->primaryKey = 'pageId';
        }

        public function getStatusOption(){
            return [
                self::STATUS_ENABLED => "Enabled",
                self::STATUS_DISABLED => "Disabled",
            ];
        }
    }

?>