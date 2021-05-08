<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');

class ConfigurationGroup extends \Model\Core\Table{

	public function __construct() {
		$this->setTableName('config_group');
		$this->setPrimaryKey('groupId');
	}
	
	
	public function getConfigurations()
	{
		if (!$this->groupId) {
			return false;
		}

		
		return \Mage::getModel('Model\ConfigurationGroup\Configuration')
		->setConfigurationGroup($this)
		->getConfigurations();
		
	
	}

	

}

?>