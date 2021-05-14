<?php
namespace Model\PlaceOrder;
\Mage::loadFileByClassName('model\core\table');

class Item extends \Model\Core\Table
{
	protected $order = null;	
	protected $product = null;
	public function __construct()
	{
		$this->setTableName('placeorder_item')->setPrimarykey('orderItemId');
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

	public function setProduct(\Model\Product $product)
	{
		$this->product=$product;
		return $this;
	}

	public function getProduct()
	{
		if(!$this->productId)
		{
			return false;
		}
		$product = \Mage::getModel('model\product')->load($this->productId);
		$this->setProduct($product);
		return $this->product;

	}
}