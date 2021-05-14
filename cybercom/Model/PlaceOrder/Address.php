<?php
namespace Model\PlaceOrder;
\Mage::loadFileByClassName('model\core\table');

class Address extends \Model\Core\Table
{
	protected $order = null;
	protected $billingAddress = null;
	protected $shippingAddress = null;

	const ADDRESS_TYPE_BILLING = 'Billing';
	const ADDRESS_TYPE_SHIPPING = 'Shipping';
	
	public function __construct()
	{
		$this->setTableName('placeorder_address')->setPrimarykey('orderAddressId');
	}

	public function setorder(\Model\PlaceOrder $order)
	{
		$this->order=$order;
		return $this;
	}

	public function getorder()
	{
		if(!$this->orderId)
		{
			return false;
		}
		$order = \Mage::getModel('model\PlaceOrder')->load($this->orderId);
		$this->setorder($order);
		return $this->order;

	}

	public function setBillingAddress(\Model\Customer\Address $address)
	{
		$this->billingAddress = $address;
		return $this;
	}
	public function getBillingAddress()
	{
		
		if(!$this->addressId)
		{
			return false;
		}
		$address = \Mage::getModel('model\customer\address');
		$query = "select * from `{$address->getTableName()}` where `addressId`= {$this->addressId} AND `addressType` ='billing' ";
		
		$address->fetchAll($query);
		$this->setBillingAddress($address);
		return $this->address;


	}

	public function setShippingAddress(\Model\Customer\Address $address)
	{
		$this->shippingAddress = $address;
		return $this;
	}
	public function getShippingAddress()
	{
		if(!$this->addressId)
		{
			return false;
		}
		$address = \Mage::getModel('model\customer\address');
		$query = "select * from `{$address->getTableName()}` where `addressId`= {$this->addressId} AND `addressType` ='shipping' ";
		$address->fetchAll($query);
		$this->setBillingAddress($address);
		return $this->address;


	}
}



?>