<?php

namespace Model;
\Mage::loadFileByClassName("Model\Core\Table");

class Attribute extends Core\Table
{

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    public function __construct()
    {
        $this->setTableName("attribute");
        $this->setPrimaryKey("attributeId");
    }

    public function getStatusOption()
    {
        return [
            self::STATUS_ENABLED => "Enabled",
            self::STATUS_DISABLED => "Disabled",
        ];
    }

    public function getBackendTypeOption()
    {
        return [
            'varchar'=>'Varchar',
            'int'=>'Int',
            'decimal'=>'Decimal',
            'text'=>'Text'
        ];
    }

    public function getInputTypeOption()
    {
        return [
            'text'=>'Text Box',
            'textarea'=>'Text Area',
            'select'=>'Select',
            'checkbox'=>'Checkbox',
            'radio'=>'Radio'
        ];
    }

    public function getEntityTypeOptions()
    {
        return [
            'product'=>'Product',
            'category'=>'Category',
        ];
    }

    public function getOptions()
    {
        $this->setTableName('attribute_option');
        if (!$this->attributeId) {
            return false;
        }
        $query = "SELECT * FROM `{$this->getTableName()}`
        WHERE `attributeId` = '{$this->attributeId}'
        ORDER BY `sortOrder` ASC";
        $options = \Mage::getModel('Model\Attribute\Option')->fetchAll($query);
        return $options;
    }
}
?>