<?php


namespace Model;

class ConfigGroup extends \Model\Core\Table
{
	
	function __construct()
	{
		$this->setTableName('config_group');
		$this->setPrimaryKey('groupId');
	}
}
?>