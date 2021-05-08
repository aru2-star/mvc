<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');

class ShippingMethod extends \Model\Core\Table{

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 0;

	public function __construct() {
		$this->setTableName('shipping_methods');
		$this->setPrimaryKey('shippingMethodId');
	}
	public function getStatusOptions() {
		return  [
			self::STATUS_ENABLED=>"Enable",
			self::STATUS_DISABLED=>"Disable"
		];
	}	
}

?>