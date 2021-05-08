<?php
namespace Block\Admin\Admin;

class Grid extends \Block\Core\Grid
{
	protected $columns = [];
	protected $collection = [];
	protected $actions = [];
	protected $buttons = [];
	protected $pages = null;
	protected $filter = null;	

	public function prepareCollection()
	{
			$admin = \Mage::getModel('Model\Admin');
			$offset = ($this->getPages()->getCurrentPage() - 1) * $this->getPages()->getRecordsPerPage();
			
			$query = "SELECT * FROM {$admin->getTableName()}";
			if($this->getFilter()->hasFilters()){
				foreach ($this->getFilter()->getFilters() as $controller => $filters) {
					if($controller == 'admin'){
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
		$collection = $admin->fetchAll($query);
			$this->setCollection($collection);
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
			'label' => 'Add Admin',
			'method' => 'getaddNewUrl',
			'ajax' => true
		]);
		$this->addButton('addfilter',[
			'label' => 'Apply filter',
			'method' => 'getaddFilterUrl',
			'ajax' => true
		]);

		return $this;
	}

	
	public function getTitle()
	{
		return 'Admin List';
	}
	
	
	public function prepareColumns()
	{
		$this->addColumn('adminId',[
			'label' => 'AdminId',
			'field' => 'adminId',
			'type' => 'number',
			'controller' => 'admin'
		]);
		$this->addColumn('username',[
			'label' => 'Username',
			'field' => 'username',
			'type' => 'text',
			'controller' => 'admin'
		]);
		$this->addColumn('createdAt',[
			'label' => 'CreatedAt',
			'field' => 'createdAt',
			'type' => 'datetime',
			'controller' => 'admin'
		]);
		
		return $this;
	}

	
	public function getEditUrl($row)
	{
		$url = $this->getUrl()->getUrl('edit','admin_admin',['adminId'=>$row->adminId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}

	public function getDeleteUrl($row)
	{
		$url = $this->getUrl()->getUrl('delete','admin_admin',['adminId'=>$row->adminId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}
	
	public function getaddFilterUrl()
	{
		$url = $this->getUrl()->getUrl('filter','admin_admin',null);
		 return "object.setUrl('{$url}').resetParam().setParams($('#gridForm').serializeArray()).setMethod('POST').load()";
	}
	
	public function getStatusName($admin)
	{
		if ($admin->status == 1) {
			return "Enable";
		}
		return "Disable";
	}

	public function getaddNewUrl()
	{
		$url = $this->getUrl()->getUrl('edit','admin_admin',null,true);
		return "object.setUrl('{$url}').resetParam().load()";
	}


	public function setPages(){

		$this->pages = \Mage::getController('Controller\Core\Pager');
		$adminModel = \Mage::getModel('Model\Admin');

		$query = "SELECT * FROM `{$adminModel->getTableName()}`";	
		$adminCount = $adminModel->getAdapter()->fetchOne($query);
		$this->pages->setTotalRecords($adminCount);
		$this->pages->setRecordsPerPage(1);
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