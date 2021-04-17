<?php

namespace Block\Admin\Attribute;

class Display extends \Block\Core\Template
{
    protected $attribute = null;
    protected $options = null;
    protected $product = null;

    public function __construct(){
        $this->setTemplate('View/admin/attribute/display.php');
    }

    public function setProduct($product){
        $this->product = $product;
        return $this;
    }

    public function getProduct(){
        return $this->product;
    }

    public function setAttribute($attribute = null)
    {
        $this->attribute = $attribute;
        return $this;
    }

    public function getAttribute()
    {
        return $this->attribute;
    }

    public function setOptions()
    {
        $option = \Mage::getModel('Model\Attribute\Option');
        $query = "SELECT * FROM `{$option->getTableName()}` WHERE `attributeId` = '{$this->getAttribute()->attributeId}';";
        $this->options = $option->fetchAll($query);
        return $this;
    }

    public function getOptions()
    {   
        if (!$this->options) {
            $this->setOptions();
        }
        return $this->options;
    }
}


?>