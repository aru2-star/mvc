<?php
Mage::loadFileByClassName('Model_Core_Table');
Mage::loadFileByClassName('Model_Core_Adapter');

class Model_Attribute extends Model_Core_Table
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('attribute');
        $this->setPrimaryKey('attributeId');
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_ENABLE => "Enable",
            self::STATUS_DISABLE => "Disable"
        ];
    }

    public function getBackendTypeOption() {
        return [
            'varchar'=>'Varchar',
            'int'=>'Int',
            'decimal'=>'Decimal',
            'text'=>'Text'
        ];
    }

    public function getInputTypeOption() {
        return [
            'text'=>'Text Box',
            'textarea'=>'Text Area',
            'select'=>'Select',
            'checkbox'=>'Checkbox',
            'radio'=>'Radio'
        ];
    }

    public function getEntityTypeOption() {
        return [
            'product'=>'Product',
            'category'=>'Category'
        ];
    }
}
