<?php

Mage::loadFileByClassName('Block_Core_Template');

class Block_Product_Edit_Tabs_GroupPrice extends Block_Core_Template {

	protected $product = null;
	protected $customerGroups = [];

	function __construct() {
		$this->setTemplate('View_products_form_tabs_groupPrice.php');
	}

	public function setProduct(Model_Product $product) {
		$this->product = $product;
		return $this;
	}

	public function getProduct() {
		return $this->product;
	}

	public function getCustomerGroup() {
		$query = "SELECT cg.*,pgp.productId, pgp.entityId, pgp.price as groupPrice,
		if(p.price IS NULL,'{$this->getProduct()->price}',p.price) as price
		FROM customer_group cg
		LEFT JOIN product_group_price pgp
			ON pgp.customerGroupId = cg.groupId
				AND pgp.productId = '{$this->getProduct()->productId}'
		LEFT JOIN product p
			ON pgp.productId = p.productId
			";


		$customerGroups = Mage::getModel('Model_CustomerGroup');
		$this->customerGroups = $customerGroups->fetchAll($query);

		return $this->customerGroups;
	}
}
?>