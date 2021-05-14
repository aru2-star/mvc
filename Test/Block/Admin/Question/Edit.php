<?php
namespace Block\Admin\Question;
\Mage::loadFileByClassName('Block\Core\Edit');

class Edit extends \Block\Core\Edit
{
	protected $question = null;

	public function __construct() {
		parent::__construct();
		$this->setTabClass(\Mage::getBlock('Block\Admin\Question\Edit\Tabs'));
	}
	
	public function getTitle()
	{
		return '<h4 class="text-muted text-weight-bold">Add/Update Question</h4>
		';
	}
	public function getFormUrl()
	{
		return $this->getUrl()->getUrl('save');
	}
}

?>