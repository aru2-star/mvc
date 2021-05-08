<?php
namespace Block\Admin\ShippingMethod;
\Mage::loadFileByClassName('Block\Core\Edit'); 	
		
class Edit extends \Block\Core\Edit
{
	
	public function __construct() {
		parent::__construct();
		$this->setTabClass(\Mage::getBlock('Block\Admin\ShippingMethod\Edit\Tabs'));
	}

	public function getTitle()
	{
		return '<h4>Add/Update Shipping Methods</h4>
		';
	}
	public function getFormUrl()
	{
		return $this->getUrl()->getUrl('save');
	}	
}
?>