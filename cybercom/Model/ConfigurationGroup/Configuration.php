<?php
namespace Model\ConfigurationGroup;
\Mage::loadFileByClassName('Model\Core\Table');

class Configuration extends \Model\Core\Table{

	protected $configurationGroup;
	
	public function __construct() {
		$this->setTableName('config');
		$this->setPrimaryKey('configId');
	}
	
	
	public function setConfigurationGroup($configurationGroup)
	{
		$this->configurationGroup = $configurationGroup;
		return $this;
	}

	public function getConfigurations()
	{
		if(!$this->getConfigurationGroup()->groupId){
			return null;
		}
		
		$query = "SELECT * FROM `config` WHERE `groupId` = '{$this->getConfigurationGroup()->groupId}'";
		return $this->fetchAll($query);
	}

	public function getConfigurationGroup()
	{
		return $this->configurationGroup;
	}


}

?>