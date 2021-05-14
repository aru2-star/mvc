<?php

namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');

class PaymentMethod extends \Model\Core\Table{

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 0;
	
	public function __construct() {
		$this->setTableName('payment_method');
		$this->setPrimaryKey('paymentMethodId');
	}

public function getStatusOptions() {
		return  [
			self::STATUS_ENABLED=>"Enable",
			self::STATUS_DISABLED=>"Disable"
		];
	}
	
}

?>