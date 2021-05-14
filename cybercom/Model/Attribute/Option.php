<?php
namespace Model\Attribute;
\Mage::loadFileByClassName('Model\Core\Table');

class Option extends \Model\Core\Table{

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 0;
	protected $attribute = null;

	public function __construct() {
		$this->setTableName('attribute_option');
		$this->setPrimaryKey('optionId');
	}
	
	public function getStatusOptions() {
		return  [
			self::STATUS_ENABLED =>"Enable",
			self::STATUS_DISABLED =>"Disable"
		];
	}

	public function setAttribute($attribute)
	{
		$this->attribute = $attribute;
		return $this;
	}

	public function getOptions()
	{
		if(!$this->getAttribute()->attributeId){
			return null;
		}
		$query = "SELECT * FROM `attribute_option` WHERE `attributeId` = '{$this->getAttribute()->attributeId}' ORDER BY `sortOrder` ASC";
		return $this->fetchAll($query);
	}

	public function getAttribute()
	{
		return $this->attribute;
	}


}

?>