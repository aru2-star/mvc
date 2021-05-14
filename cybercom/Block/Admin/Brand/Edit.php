<?php  

namespace Block\Admin\Brand;
\Mage::loadFileByClassName('Block\Core\Edit');
class Edit extends \Block\Core\Edit
{
	protected $attribute = null;

	function __construct() {
		parent::__construct();
		$this->setTabClass(\Mage::getBlock('Block\Admin\Brand\Edit\Tabs'));
	}
	
	public function getTitle()
	{
		return '<h4 class="text-muted text-weight-bold">Add/Update Brand</h4>
		';
	}
	public function getFormUrl()
	{
		return $this->getUrl()->getUrl('save');
	}
}

?>