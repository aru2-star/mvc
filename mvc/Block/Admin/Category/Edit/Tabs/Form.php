<?php
namespace Block\Admin\Category\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Form  extends \Block\Core\Template
{
    
    protected $categories = null;
    protected $categoriesOptions = null;
	protected $tableRow = null;
	function __construct() {
		parent::__construct();
		$this->setTemplate('./View/admin/category/edit/tabs/form.php');
	}
	
	public function setTableRow(\Model\Category $tableRow)
	{
		$this->tableRow = $tableRow;
		return $this;
	}

	public function getTableRow()
	{
		return $this->tableRow;
	}
	public function getParentOptions()
	{
		
		$category = \Mage::getModel('Model\Category');
		if (!$this->categoriesOptions) {

			$query = "SELECT `categoryId`,`name` FROM `{$this->getTableRow()->getTableName()}`";
			$options = $this->getTableRow()->getAdapter()->fetchPairs($query);
			$path = $this->getTableRow()->path;
			$query = "SELECT `categoryId`,`path` FROM `{$this->getTableRow()->getTableName()}` WHERE `path` NOT LIKE '{$path}%' ORDER BY `path` ASC";
			$this->categoriesOptions = $this->getTableRow()->getAdapter()->fetchPairs($query);

			if ($this->categoriesOptions) {

				foreach ($this->categoriesOptions as $categoryId => &$pathId) {

					$pathIds = explode("-",$pathId);

					foreach ($pathIds as $key => &$id) {
						
						if (array_key_exists($id, $options)) {
							$id = $options[$id];
						}
					}
					$pathId = implode('=>',$pathIds);
				}	
			}
		 	$this->categoriesOptions = ['0'=>'Select']+$this->categoriesOptions;	
		}
		return $this->categoriesOptions;
	}
	

}

?>