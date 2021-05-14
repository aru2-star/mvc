<?php

namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');

class Customer extends \Model\Core\Table{

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 0;
	
	public function __construct() {
		$this->setTableName('customer_details');
		$this->setPrimaryKey('customerId');
	}

	public function getStatusOptions() {
		return  [
			self::STATUS_ENABLED=>"Enable",
			self::STATUS_DISABLED=>"Disable"
		];
	}

	public function getShippingAddress()
	{
		if (!$this->customerId) {
			return null;
		}
		$shippingAddress = \Mage::getModel('Model\Customer\Address');
		$query = "SELECT * FROM `{$shippingAddress->getTableName()}` WHERE `{$this->getPrimaryKey()}` = '{$this->customerId}' AND `address_type` = '2'";
		return $shippingAddress->fetchRow($query);
	}

	public function getBillingAddress()
	{
		if (!$this->customerId) {
			return null;
		}
		
		$billingAddress = \Mage::getModel('Model\Customer\Address');
		$query = "SELECT * FROM `{$billingAddress->getTableName()}` WHERE `{$this->getPrimaryKey()}` = '{$this->customerId}' AND `address_type` = '1'";
		return $billingAddress->fetchRow($query);
	}

	/*public function getBillingAddress()
	{
		$billingAddress = \Mage::getModel('Model\Customer\Address');
		$query = "SELECT * FROM `{$billingAddress->getTableName()}` WHERE `address_type` = '1' AND `customerId` = {$this->customerId}";
		$billingAddress = $billingAddress->fetchRow($query);
		return $billingAddress;
	}

	public function getShippingAddress()
	{
		$shippingAddress = \Mage::getModel('Model\Customer\Address');
		$query = "SELECT * FROM `{$shippingAddress->getTableName()}` WHERE `address_type` = '2' AND `customerId` = {$this->customerId}";
		$shippingAddress = $shippingAddress->fetchRow($query);
		return $shippingAddress;	
	}*/
	
}
?>