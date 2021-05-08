<?php

namespace Block\Admin\PaymentMethod;
\Mage::loadFileByClassName('Block\Core\Edit'); 	

class Edit extends \Block\Core\Edit
{
	
	
	function __construct() {
		parent::__construct();
		$this->setTabClass(\Mage::getBlock('Block\Admin\PaymentMethod\Edit\Tabs'));
	}

	public function getTitle()
	{
		return '<h4 class="text-muted text-weight-bold">Add/Update Payment Methods</h4>
		';
	}
	public function getFormUrl()
	{
		return $this->getUrl()->getUrl('save');
	}
	
}

?>