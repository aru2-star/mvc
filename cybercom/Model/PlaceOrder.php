<?php
namespace Model;
\Mage::loadFileByClassName('Model\core\table');

class PlaceOrder extends Core\Table
{
	
	protected $customer = null;
	protected $items = null;
	protected $billingAddress = null;
	protected $shippinggAddress = null;
	protected $payment = null;
	protected $shipping = null;

	public function __construct()
	{
		$this->setTableName('placeorder')->setPrimaryKey('orderId');

	}

	public function setCustomer(\Model\Customer $customer)
	{
		$this->customer = $customer;
		//print_r($this->customer);
		return $this;
	}
	public function getCustomer()
	{
		if($this->customer)
		{
			return $this->customer;
		}
		if(!$this->customerId)
		{
			return false;
		}
		$customer = \Mage::getModel('Model\customer')->load($this->customerId);
		if($customer)
		{
			$this->setCustomer($customer);
		}
		

		return $this->customer;

	}
	
	public function setItems(\Model\PlaceOrder\Item\Collection $items)
	{
		$this->items=$items;
		return $this;
	}

	public function getItems()
	{
		if(!$this->orderId)
		{
			return false;
		}
		$items = \Mage::getModel('model\PlaceOrder\item');

		$query = "select * from `{$items->getTableName()}` where `orderId`={$this->orderId}";
		$items = $items->fetchAll($query);
		if($items)
		{

			$this->setItems($items);
		}
		return $this->items;
		
	}

	public function setShippingAddress(\Model\PlaceOrder\Address $address)
	{
		$this->shippingAddress = $address;
		return $this;
	}

	public function getShippingAddress()
	{
		if(!$this->orderId)
		{
			return false;
		}
		$address = \Mage::getModel('model\PlaceOrder\address');
		$query = "select * from `{$address->getTableName()}` where `orderId`= {$this->orderId} AND `addressType` ='shipping' ";
		
		$address = $address->fetchRow($query);
		if($address)
		{
			$this->setShippingAddress($address);
		}
		
		return $this->shippingAddress;
	}

	public function setBillingAddress(\Model\PlaceOrder\Address $address)
	{
		//print_r($address);
		$this->billingAddress = $address;
		//	print_r($this->billingAddress);
		return $this;
	}

	public function getBillingAddress()
	{
		if(!$this->orderId)
		{
			return false;
		}
		$address = \Mage::getModel('model\PlaceOrder\address');
		$query = "select * from `{$address->getTableName()}` where `orderId`= {$this->orderId} AND `addressType` ='billing' ";
		
		$address = $address->fetchRow($query);
		//print_r($address);
		if($address)
		{
			$this->setBillingAddress($address);
			
		}
		
		
		return $this->billingAddress;
	}


	public function setPaymentMethod(\Model\PaymentMethod $payment){
		$this->payment = $payment;
		return $this;
	}

	public function getPaymentMethod()
	{
		/*echo '<pre>';
		print_r($this->PlaceOrderId);*/
		if($this->payment){
			return $this->payment;
		}
		if(!$this->orderId){
			return false;
		}
		
		$payment = \Mage::getModel('Model\PaymentMethod')->load($this->paymentId);
		
		if($payment)
		{
			$this->setPaymentMethod($payment);
		}
		
		return $this->payment;
	}
	public function setShippingMethod(\Model\ShippingMethod $shipping){
		$this->shipping = $shipping;
		return $this;
	}

	public function getShippingMethod()
	{
		if($this->shipping){
			return $this->shipping;
		}
		if(!$this->orderId){
			return false;
		}
		$shipping = \Mage::getModel('Model\ShippingMethod')->load($this->shippingId);
		if($shipping)
		{
			$this->setShippingMethod($shipping);
		}
		
		return $this->shipping;
	}


}


?>