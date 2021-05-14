<?php  

namespace Block\Admin\Brand;
\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
	protected $brand = null;
	protected $filter = null;
	protected $pages = null;
	
	public function prepareCollection()
	{
			
		$brand = \Mage::getModel('Model\Brand');
		$offset = ($this->getPages()->getCurrentPage() - 1) * $this->getPages()->getRecordsPerPage();

		$query = "SELECT * FROM {$brand->getTableName()}";
		if($this->getFilter()->hasFilters()){
				foreach ($this->getFilter()->getFilters() as $controller => $filters) {
					if($controller == 'brand'){
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

		$brand = $brand->fetchAll($query);
		$this->setCollection($brand);
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
			'label' => 'Add Brand',
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
		$this->addColumn('brandId',[
			'label' => 'Brand Id',
			'field' => 'brandId',
			'type' => 'number',
			'controller' => 'brand'
		]);
		
		$this->addColumn('name',[
			'label' => 'name',
			'field' => 'name',
			'type' => 'text',
			'controller' => 'brand'
		]);
		
		return $this;
	}

	public function getTitle()
	{
		return 'Brand List';
	}
	
	public function getEditUrl($row)
	{
		$url = $this->getUrl()->getUrl('edit','admin_brand',['brandId'=>$row->brandId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}

	public function getaddFilterUrl()
	{
		$url = $this->getUrl()->getUrl('filter','admin_brand',null);
		return "object.setUrl('{$url}').resetParam().setParams($('#gridForm').serializeArray()).setMethod('POST').load()";

	}
	
	public function getDeleteUrl($row)
	{
		$url = $this->getUrl()->getUrl('delete','admin_brand',['brandId'=>$row->brandId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}
	
	public function getaddNewUrl()
	{
		$url = $this->getUrl()->getUrl('edit','admin_brand',null,true);
		return "object.setUrl('{$url}').resetParam().load()";
	}

	public function setPages(){

		$this->pages = \Mage::getController('Controller\Core\Pager');
		$brandModel = \Mage::getModel('Model\Brand');

		$query = "SELECT * FROM `{$brandModel->getTableName()}`";	
		$brandCount = $brandModel->getAdapter()->fetchOne($query);

		$this->pages->setTotalRecords($brandCount);
		$this->pages->setRecordsPerPage(5);
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