<?php

namespace Block\Admin\Category;
\Mage::loadFileByClassName('Block\Core\Edit'); 	
	
class Edit extends \Block\Core\Edit
{
	
	function __construct() {

		parent::__construct();
		$this->setTabClass(\Mage::getBlock('Block\Admin\Category\Edit\Tabs'));
	}

	public function getTitle()
	{
		return '<h4 class="text-muted text-weight-bold">Add/Update Category</h4>
		';
	}
}

?>