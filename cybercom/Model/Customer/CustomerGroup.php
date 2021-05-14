<?php

namespace Model\Customer;
\Mage::loadFileByClassName('Model\Core\Table');

class CustomerGroup extends \Model\Core\Table{

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 0;
	
	public function __construct() {
			$this->setTableName('customer_group');
			$this->setPrimaryKey('groupId');
		}	
	public function getStatusOptions() {
			return  [
				self::STATUS_ENABLED=>"Enable",
				self::STATUS_DISABLED=>"Disable"
			];
		}
	
}
?>