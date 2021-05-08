<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');

class Attribute extends \Model\Core\Table{

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 0;
	const BACKEND_TYPE_VARCHAR = 'VARCHAR';
	const BACKEND_TYPE_INT = 'INT';
	const BACKEND_TYPE_DECIMAL = 'DECIMAL';
	const BACKEND_TYPE_TEXT = 'TEXT';
	const INPUT_TYPE_SELECT = 'select';
	const INPUT_TYPE_CHECKBOX = 'checkbox';
	const INPUT_TYPE_RADIO = 'radio';
	const INPUT_TYPE_TEXT = 'text';
	const INPUT_TYPE_TEXTAREA = 'textarea';
	const ENTITY_TYPE_PRODUCT = 'product';
	const ENTITY_TYPE_CATEGORY = 'category';
	
	public function __construct() {
		$this->setTableName('attribute');
		$this->setPrimaryKey('attributeId');
	}
	
	public function getStatusOptions() {
		return  [
			self::STATUS_ENABLED =>"Enable",
			self::STATUS_DISABLED =>"Disable"
		];
	}

	public function getBackendTypeOptions()
	{
		return [

			self::BACKEND_TYPE_VARCHAR => 'Varchar',
			self::BACKEND_TYPE_INT => 'Int',
			self::BACKEND_TYPE_DECIMAL => 'Decimal',
			self::BACKEND_TYPE_TEXT => 'Text'
		];
	}
	
	public function getInputTypeOptions()
	{
		return [

			self::INPUT_TYPE_SELECT => 'Select',
			self::INPUT_TYPE_TEXT => 'Text',
			self::INPUT_TYPE_CHECKBOX => 'Checkbox',
			self::INPUT_TYPE_TEXTAREA => 'Textarea',
			self::INPUT_TYPE_RADIO=> 'Radio'
		];
	}

	public function getEntityType()
	{
		return [
			self::ENTITY_TYPE_PRODUCT => 'Product',
			self::ENTITY_TYPE_CATEGORY => 'Category'
		];
	}

	public function getOptions()
	{
		if (!$this->attributeId) {
			return false;
		}

		
		return \Mage::getModel($this->backendModel)
		->setAttribute($this)
		->getOptions();
		
	
	}

	

}

?>