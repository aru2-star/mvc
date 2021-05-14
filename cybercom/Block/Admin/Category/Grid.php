<?php
namespace Block\Admin\Category;
\Mage::loadFileByClassName('Block\Core\Grid'); 	

class Grid extends \Block\Core\Grid
{
	protected $categories = null;
	protected $categoriesOptions = [];
	protected $pages = null;
	protected $filter = null;
	
	public function prepareCollection()
	{
			$categories = \Mage::getModel('Model\Category');	
			$offset = ($this->getPages()->getCurrentPage() - 1) * $this->getPages()->getRecordsPerPage();
			
			$query = "SELECT * FROM {$categories->getTableName()} ";
			if($this->getFilter()->hasFilters()){
				foreach ($this->getFilter()->getFilters() as $controller => $filters) {
					if($controller == 'category'){
						$query.= " WHERE 1 = 1";
						foreach ($filters as $type => $filter) {
							if ($type == 'text') {
								foreach ($filter as $key => $value) {
									$query.= " AND (`{$key}` LIKE '%{$value}%')";		
								}
							}
						}
					}
				}
			}
		$query.= " LIMIT {$offset},{$this->getPages()->getRecordsPerPage()}";
		$categories = $categories->fetchAll($query);
			
			foreach ($categories->getData() as $key => &$category) {
				$category->name = $this->getName($category);
			}
			$this->setCollection($categories);
			return $this;
	}
	
	public function getFilter()
	{
		if(!$this->filter){
			$this->filter = \Mage::getModel('Model\Admin\Filter');
		}
		return $this->filter;
	}

	public function prepareActions()
	{
		$this->addActions('edit',[
			'label' => 'Edit',
			'method' =>'getEditUrl',
			'ajax' => true
		]);
		$this->addActions('delete',[
			'label' => 'Delete',
			'method' =>'getDeleteUrl',
			'ajax' => true
		]);
		return $this;
	}

	public function prepareButtons()
	{
		$this->addButton('addNew',[
			'label' => 'Add Category',
			'method' => 'getaddNewUrl',
			'ajax' => true
		]);
		$this->addButton('addfilter',[
			'label' => 'Add filter',
			'method' => 'getaddFilterUrl',
			'ajax' => true
		]);

		return $this;
	}

	public function prepareColumns()
	{
		$this->addColumn('categoryId',[
			'label' => 'Category Id',
			'field' => 'categoryId',
			'type' => 'number',
			'controller' => 'category'
		]);
		$this->addColumn('name',[
			'label' => 'Name',
			'field' => 'name',
			'type' => 'text',
			'controller' => 'category'
		]);
		
		return $this;
	}

	public function getTitle()
	{
		return 'Category List';
	}
	
	public function getEditUrl($row)
	{
		$url = $this->getUrl()->getUrl('edit','admin_category',['categoryId'=>$row->categoryId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}

	public function getDeleteUrl($row)
	{
		$url = $this->getUrl()->getUrl('delete','admin_category',['categoryId'=>$row->categoryId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}
	
	public function getaddNewUrl()
	{
		$url = $this->getUrl()->getUrl('edit','admin_category',null,true);
		return "object.setUrl('{$url}').resetParam().load()";
	}

	public function getaddFilterUrl()
	{
		$url = $this->getUrl()->getUrl('filter','admin_category',null);
		return "object.setUrl('{$url}').resetParam().setParams($('#gridForm').serializeArray()).setMethod('POST').load()";
	}

	public function getName($category)
	{
		$categoryModel = \Mage::getModel('Model\Category');
		if (!$this->categoriesOptions) {
			$query = "SELECT `categoryId`, `name` FROM 	`{$categoryModel->getTableName()}`";
			$this->categoryOptions = $categoryModel->getAdapter()->fetchPairs($query);
		
		}
		$pathId = explode('-',$category->path);

		foreach ($pathId as $key => &$ids) {
			if (array_key_exists($ids, $this->categoryOptions)) {
				$ids = $this->categoryOptions[$ids];
			}
		}
		$name = implode('=>',$pathId);	
		
		return $name;
	}

	public function getStatusName($category)
	{
		if ($category->status == 1) {
			return "Enable";
		}
		return "Disable";
	}

	public function setPages(){

		$this->pages = \Mage::getController('Controller\Core\Pager');
		$categoryModel = \Mage::getModel('Model\Category');

		$query = "SELECT * FROM `{$categoryModel->getTableName()}`";	
		$categoryCount = $categoryModel->getAdapter()->fetchOne($query);
		$this->pages->setTotalRecords($categoryCount);
		$this->pages->setRecordsPerPage(20);
		if(isset($_GET['page'])) {
			$this->pages->setCurrentPage($_GET['page']);	
		} else {
			$this->pages->setCurrentPage(1);
		}
		$this->pages->calculate();


	}

	public function getPages()
	{
		if(!$this->pages){
			$this->setPages();
		}
		return $this->pages;
	}
}
?>