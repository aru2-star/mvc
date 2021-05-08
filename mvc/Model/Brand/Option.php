<?php
namespace Model\Brand;
\Mage::loadFileByClassName('Model\Attribute\Option');

class Option extends \Model\Attribute\Option{

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 0;
	protected $attribute = null;	
	
	public function getOptions()
	{
		if(!$this->getAttribute()->attributeId){
			return null;
		}
		$query = "SELECT `brandId` as optionId, `name`,'{$this->getAttribute()->attributeId}' as `attributeId`,`sortOrder` 
		FROM `brand`  
		ORDER BY `sortOrder` ASC";
		$options = \Mage::getModel('Model\Brand')->fetchAll($query);
		if(!$options){
			return null;
		}
		return $options;
	}
	

}

?>