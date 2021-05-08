<?php

namespace Block\Admin\Admin;
	
class Edit extends \Block\Core\Edit
{
	
	
	function __construct() {

		parent::__construct();
		$this->setTabClass(\Mage::getBlock('Block\Admin\Admin\Edit\Tabs'));
	}

	public function getTitle()
	{
		return '<h4 class="text-muted text-weight-bold">Add/Update Admin</h4>
		';
	}

}

?>