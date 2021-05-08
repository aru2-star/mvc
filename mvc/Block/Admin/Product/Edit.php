<?php
namespace Block\Admin\Product;
\Mage::loadFileByClassName('Block\Core\Edit'); 	

class Edit extends \Block\Core\Edit
{
	
	protected $product = null;
	public function __construct() {
		parent::__construct();
		$this->setTabClass(\Mage::getBlock('Block\Admin\Product\Edit\Tabs'));
	}

	public function getTitle()
	{
		return '<h4 class="text-muted text-weight-bold">Add/Update Product</h4>
		';
	}
	public function getFormUrl()
	{
		return $this->getUrl()->getUrl('save');
	}	
}

?>