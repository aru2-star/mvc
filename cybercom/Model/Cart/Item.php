<?php 
namespace Model\Cart;

class Item extends \Model\Core\Table
{

	function __construct()
	{
		$this->setTableName('cart_item');
		$this->setPrimaryKey('cartItemId');
	}

	public function getProduct()
	{
		if(!$this->productId)
		{
			return null;
		}
		$product = \Mage::getModel('Model\Product')->load($this->productId);
		if (!$product) {
			return null;
		}
		return $product;
	}

	public function getCart()
	{
		if(!$this->cartId)
		{
			return null;
		}
		$cart = \Mage::getModel('Model\Cart')->load($this->cartId);
		if (!$cart) {
			return null;
		}
		return $cart;
	}

}

?>