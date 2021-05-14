<?php
namespace Block\Admin\Customer\CustomerGroup;
\Mage::loadFileByClassName('Block\Core\Grid'); 	

class Grid extends \Block\Core\Grid
{
	protected $template = null;	
	protected $customerGroup = null;
	protected $pages = null;
	protected $filter = null;
	
	public function prepareCollection()
	{
			$customerGroup = \Mage::getModel('Model\Customer\CustomerGroup');
			$offset = ($this->getPages()->getCurrentPage() - 1) * $this->getPages()->getRecordsPerPage();
			$query = "SELECT * FROM {$customerGroup->getTableName()} ";
			if($this->getFilter()->hasFilters()){
				foreach ($this->getFilter()->getFilters() as $controller => $filters) {
					if($controller == 'customerGroup'){
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
			$customerGroup = $customerGroup->fetchAll($query);
			$this->setCollection($customerGroup);
			return $this;
	}

	public function getFilter()
	{
		if(!$this->filter){
			$this->filter = \Mage::getModel('Model\Admin\Filter');
		}
		return $this->filter;
	}

	public function prepareColumns()
	{
		$this->addColumn('groupId',[
			'label' => 'Group Id',
			'field' => 'groupId',
			'type' => 'number',
			'controller' => 'customerGroup'
		]);
		$this->addColumn('name',[
			'label' => 'Name',
			'field' => 'name',
			'type' => 'text',
			'controller' => 'customerGroup'
		]);
		
		return $this;
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
			'label' => 'Add Customer Group',
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

	public function getTitle()
	{
		return 'Customer Groups List';
	}
	
	public function getEditUrl($row)
	{
		$url = $this->getUrl()->getUrl('edit','admin_customer_customerGroup',['groupId'=>$row->groupId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}

	public function getDeleteUrl($row)
	{
		$url = $this->getUrl()->getUrl('delete','admin_customer_customerGroup',['groupId'=>$row->groupId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}
	
	public function getaddNewUrl()
	{
		$url = $this->getUrl()->getUrl('edit','admin_customer_customerGroup',null,true);
		return "object.setUrl('{$url}').resetParam().load()";
	}

	public function getaddFilterUrl()
	{
		$url = $this->getUrl()->getUrl('filter','admin_customer_customerGroup',null);
		return "object.setUrl('{$url}').resetParam().setParams($('#gridForm').serializeArray()).setMethod('POST').load()";
	}

	public function getDefaultType($customerGroup)
	{
		if ($customerGroup->default_type == 1) {
			return "Yes";
		}
		return "No";
	}

	public function setPages(){

		$this->pages = \Mage::getController('Controller\Core\Pager');
		$customerGroupModel = \Mage::getModel('Model\Customer\CustomerGroup');

		$query = "SELECT * FROM `{$customerGroupModel->getTableName()}`";	
		$customerGroupCount = $customerGroupModel->getAdapter()->fetchOne($query);
		$this->pages->setTotalRecords($customerGroupCount);
		$this->pages->setRecordsPerPage(10);
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