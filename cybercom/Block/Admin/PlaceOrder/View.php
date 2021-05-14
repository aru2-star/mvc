<?php
namespace Block\Admin\PlaceOrder;
\Mage::loadFileByClassName('Block\Core\Template');

class View extends \Block\Core\Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('./View/admin/placeOrder/view.php');
	}

	public function getOrderShippingAddress()
	{
		$orderId = $this->getRequest()->getGet('orderId');
		$order = \Mage::getModel('Model\PlaceOrder')->load($orderId);
		if ($order) {
			$shippingAddress = $order->getShippingAddress();
			if ($shippingAddress) {
				return $shippingAddress;
			}
		}
	}

	public function getOrderBillingAddress()
	{
		$orderId = $this->getRequest()->getGet('orderId');;	
		$order = \Mage::getModel('Model\PlaceOrder')->load($orderId);
		if ($order) {
			$billingAddress = $order->getBillingAddress();
			if ($billingAddress) {
				return $billingAddress;
			}
		} 
	}

	public function getOrder()
	{
		$id = $this->getRequest()->getGet('orderId');
		return \Mage::getModel('Model\PlaceOrder')->load($id);
	}

	public function getProducts()
	{
		$orderId = $this->getRequest()->getGet('orderId');
		$products = \Mage::getModel('Model\PlaceOrder')->load($orderId)->getItems();
		return $products;
	}

	public function getCustomers()
	{
		$orderId = $this->getRequest()->getGet('orderId');
		$customers = \Mage::getModel('Model\PlaceOrder')->load($orderId)->getCustomer();
		return $customers;
	}
}
?>