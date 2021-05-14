<?php

namespace Block\Admin\ConfigurationGroup;

class Edit extends \Block\Core\Edit
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTabClass(\Mage::getBlock('Block\Admin\ConfigurationGroup\Edit\Tabs'));
	}

	public function getTitle()
	{
		return '<h4 class="text-muted text-weight-bold">Add/Update Cms</h4>
		';
	}

	public function getFormUrl()
	{
		return $this->getUrl()->getUrl('save');
	}
}

?>