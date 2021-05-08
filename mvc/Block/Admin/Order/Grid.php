<?php 
namespace Block\Admin\Order;
class Grid extends \Block\Core\Template{

	public function __construct(){
		parent::__construct();
		$this->setTemplate('./View/admin/order/grid.php');
	}

	public function getData(){
		$order = \Mage::getModel('Model\Order');
		$query="
		SELECT pla.orderId,pla.shippingAmount,pla.total,cus.customerId,cus.firstName,cus.lastName,cus.email,cus.mobile,pay.name as PaymentName,shi.name as ShippingName,pa.address,pa.zipcode,pa.state,pa.country 
		FROM `placeorder` As pla, `customer` As cus, `payment` As pay, `shipping` As shi, `placeorder_address` As pa 
		WHERE pla.customerId = cus.customerId 
			AND pla.paymentmethodId = pay.methodId 
			AND pla.shippingmethodId = shi.methodId
			AND pla.orderId = pa.orderId";
		$order = $order->fetchAll($query);
		return $order;
	}
} ?>