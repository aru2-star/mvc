<?php 

namespace Model\Attribute;
\Mage::loadFileByClassName('Model\Core\Table');

class Option extends \Model\Core\Table 
{
    protected $attribute = null;
    public function __construct()
    {
        $this->setTableName('attribute_option');
        $this->setPrimaryKey('optionId');
    }

    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
        return $this->attribute;
    }

    public function getAttribute()
    {
        return $this->attribute;
    }

    public function getOptions()
    {
        if(!$this->getAttribute()->attributeId){
            return null;
        }
        return $this->getAttribute()->getOptions();
    }

}

?>