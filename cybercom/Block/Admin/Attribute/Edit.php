<?php  

namespace Block\Admin\Attribute;
\Mage::loadFileByClassName('Block\Core\Edit');
class Edit extends \Block\Core\Edit
{
	protected $attribute = null;

	function __construct() {
		parent::__construct();
		$this->setTabClass(\Mage::getBlock('Block\Admin\Attribute\Edit\Tabs'));
	}
	
	public function getTitle()
	{
		return '<h4 class="text-muted text-weight-bold">Add/Update Attribute</h4>
		';
	}
	public function getFormUrl()
	{
		return $this->getUrl()->getUrl('save');
	}
}

?>