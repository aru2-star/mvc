<?php
namespace Block\Admin\PaymentMethod;
\Mage::loadFileByClassName('Block\Core\Edit'); 	

class Edit extends \Block\Core\Edit
{
	public function __construct() {
		parent::__construct();
		$this->setTabClass(\Mage::getBlock('Block\Admin\PaymentMethod\Edit\Tabs'));
	}

	public function getTitle()
	{
		return 'Add/Update Payment';
	}

	public function getFormUrl()
	{
		return $this->getUrl()->getUrl('save');
	}
	
}
?>