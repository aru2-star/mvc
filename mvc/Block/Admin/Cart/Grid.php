<?php

namespace Block\Admin\Cart;
		
class Grid extends \Block\Core\Template
{
	protected $cart = null;
	function __construct()
	{
		$this->setTemplate('./View/admin/cart/grid.php');

	}

	public function setCart(\Model\Cart $cart)
	{
		$this->cart = $cart;
		return $this;
	}

	public function getCart()
	{
		if(!$this->cart){
			throw new \Exception("Cart is not set");
			
		}
		return $this->cart;
	}

	public function getCustomers()
	{
		$customerModel = \Mage::getModel('Model\Customer');
		$customerModel = $customerModel->fetchAll();

		return $customerModel->getData();
	}

	public function getShippingAddress()
	{
		$cartShippingAddress = $this->getCart()->getShippingAddress();
		if($cartShippingAddress)
		{
			return $cartShippingAddress;
		}
		else{

			$cartShippingAddress = \Mage::getModel('Model\Cart\Address');
			if ($this->getCart()->getCustomer()) {
				$shippingAddress = $this->getCart()->getCustomer()->getShippingAddress();
				$cartShippingAddress->address = $shippingAddress->address;
				$cartShippingAddress->city = $shippingAddress->city;
				$cartShippingAddress->state = $shippingAddress->state;
				$cartShippingAddress->zipcode = $shippingAddress->zipcode;
				$cartShippingAddress->country = $shippingAddress->country;
				$cartShippingAddress->address_type = $shippingAddress->address_type;
				$cartShippingAddress->cartId = $this->getCart()->cartId;
				$cartShippingAddress->save();
				return $cartShippingAddress;
			}
			else {
				$cartShippingAddress = \Mage::getModel('Model\Cart\Address');
				return $cartShippingAddress;
			}
		}

		
	}

	public function getBillingAddress()
	{
		$cartBillingAddress = $this->getCart()->getBillingAddress();
		if($cartBillingAddress)
		{
			return $cartBillingAddress;
		} 
		else {
			$cartbillingAddress = \Mage::getModel('Model\Cart\Address');
			if ($this->getCart()->getCustomer()) {
				$billingAddress = $this->getCart()->getCustomer()->getBillingAddress();
				
				$cartbillingAddress->address = $billingAddress->address;
				$cartbillingAddress->city = $billingAddress->city;
				$cartbillingAddress->state = $billingAddress->state;
				$cartbillingAddress->zipcode = $billingAddress->zipcode;
				$cartbillingAddress->country = $billingAddress->country;
				$cartbillingAddress->address_type = $billingAddress->address_type;
				$cartbillingAddress->cartId = $this->getCart()->cartId;
				$cartbillingAddress->save();
				return $cartbillingAddress;
			}
			else {
				$cartbillingAddress = \Mage::getModel('Model\Cart\Address');
				return $cartbillingAddress;
			}
		}
	}

	public function getPaymentDetails()
	{
		$payment = \Mage::getModel('Model\PaymentMethod');
		return $payment->fetchAll();
	}

	public function getShippingDetails()
	{
		$shipping = \Mage::getModel('Model\ShippingMethod');
		return $shipping->fetchAll();
	}
}

?>