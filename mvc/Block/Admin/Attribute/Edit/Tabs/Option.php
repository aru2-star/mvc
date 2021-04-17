<?php
namespace Block\Admin\Attribute\Edit\Tabs;
\Mage::loadFileByClassName("Block\Core\Edit");

class Option extends \Block\Core\Edit
{
    protected $attribute = [];
    protected $options = [];

    public function __construct()
    {
        $this->setTemplate('./View/admin/attribute/edit/tabs/option.php');
    }

    
    public function setAttribute($attribute = null) 
    {
        if ($attribute){
            $this->attribute = $attribute;
            return $this;
        }
        $attribute = \Mage::getModel('Model\Attribute');
        if ($id = $this->getRequest()->getGet('id')){   
            $attribute = $attribute->load($id);
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

    public function setOptions($options = null){
        if ($options) {
            $this->$options = $options;
            return $this;
        }
        if($attributeId = $this->getTableRow()->attributeId){
            $attributeOption = \Mage::getModel('Model\Attribute\Option');
            $query = "SELECT * FROM {$attributeOption->getTableName()} WHERE `attributeId` = {$attributeId};";
            $options = $attributeOption->fetchAll($query);
            if($options){
                $this->options = $options;
                return $this;
            }
        }
        $this->options = $options;
        return $this;
    }

    public function getOptions(){
        if (!$this->options) {
            $this->setOptions();
        }
        return $this->options;
    }

}
