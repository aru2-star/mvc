<?php 
namespace Model\Cart;

class Address extends \Model\Core\Table
{

	function __construct()
	{
		$this->setTableName('cart_address');
		$this->setPrimaryKey('cartAddressId');
	}

}

?>