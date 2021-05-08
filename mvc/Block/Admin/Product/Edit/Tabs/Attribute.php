<?php
namespace Block\Admin\Product\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');

class Attribute extends \Block\Core\Template
{
    protected $tableRow = null;
    protected $attribute = null;
    protected $options = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/product/edit/tabs/attribute.php');
    }

    public function setAttribute($attribute = null)
    {
        if (!$attribute) {
            $attribute = \Mage::getModel('Model\Attribute');
            $attribute = $attribute->fetchAll();
        }
        $this->attribute = $attribute;
        return $this;
    }

    public function getAttribute()
    {
        if (!$this->attribute) {
            $this->setAttribute();
        }
        return $this->attribute;
    }

    public function setTableRow(\Model\Product $tableRow)
    {
    	$this->tableRow = $tableRow;
    	return $this;
    }


    public function getTableRow()
    {
        return $this->tableRow;
    }

    public function getProductAttribute() 
    {
        $attribute = \Mage::getModel('Model\Attribute');
        $query = "SELECT * FROM `{$attribute->getTableName()}` WHERE `entityTypeId` = 'product'";
        $attribute = $attribute->fetchAll($query);
        if(!$attribute){
            $attribute = \Mage::getModel('Model\Attribute');
        }

        $this->attribute = $attribute;
        return $this->attribute;
    }

    public function getAttributeOptions()
    {

        $options = \Mage::getModel('Model\Attribute\Option');

        $query = "SELECT ap.attributeId,ap.optionId,ap.name,ap.sortOrder FROM `{$options->getTableName()}` ap INNER JOIN `attribute` a ON a.attributeId = ap.attributeId  WHERE a.entityTypeId = 'product'";   
        $options = $options->fetchAll($query);
        if(!$options){
            $options = \Mage::getModel('Model\Attribute\Option');
        }

        $this->options = $options;
        return $this->options;
    }
}
?>