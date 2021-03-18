<?php
Mage::loadFileByClassName('Model_Core_Table');
Mage::loadFileByClassName('Model_Core_Adapter');

class Model_Attribute_Option extends Model_Core_Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('attribute_option');
        $this->setPrimaryKey('optionId');
    }
}
?>
