<?php

namespace Block\Admin\PaymentMethod;
\Mage::loadFileByClassName('Block\Core\Grid'); 	

class Grid extends \Block\Core\Grid
{
	protected $template = null;
	protected $methods = null;
	protected $pages = null;
	protected $filter = null;
	
	public function prepareCollection()
	{
			$methods = \Mage::getModel('Model\PaymentMethod');	
			$offset = ($this->getPages()->getCurrentPage() - 1) * $this->getPages()->getRecordsPerPage();
			
			$query = "SELECT * FROM {$methods->getTableName()} ";

			if($this->getFilter()->hasFilters()){
				foreach ($this->getFilter()->getFilters() as $controller => $filters) {
					if($controller == 'paymentMethod'){
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
			
			
			$methods = $methods->fetchAll($query);
			$this->setCollection($methods);
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
			'label' => 'Add Payment Method',
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
		$this->addColumn('paymentMethodId',[
			'label' => 'Id',
			'field' => 'paymentMethodId',
			'type' => 'number',
			'controller' => 'paymentMethod'
		]);
		$this->addColumn('name',[
			'label' => 'Name',
			'field' => 'name',
			'type' => 'text',
			'controller' => 'paymentMethod'
		]);
		$this->addColumn('createdAt',[
			'label' => 'CreatedAt',
			'field' => 'createdAt',
			'type' => 'datetime',
			'controller' => 'paymentMethod'
		]);
		
		return $this;
	}

	public function getTitle()
	{
		return 'Payment List';
	}
	
	public function getEditUrl($row)
	{
		$url = $this->getUrl()->getUrl('edit','admin_paymentMethod',['paymentMethodId'=>$row->paymentMethodId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}

	public function getDeleteUrl($row)
	{
		$url = $this->getUrl()->getUrl('delete','admin_paymentMethod',['paymentMethodId'=>$row->paymentMethodId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}
	
	public function getaddNewUrl()
	{
		$url = $this->getUrl()->getUrl('edit','admin_paymentMethod',null,true);
		return "object.setUrl('{$url}').resetParam().load()";
	}

	public function getaddFilterUrl()
	{
		$url = $this->getUrl()->getUrl('filter','admin_paymentMethod',null);
		return "object.setUrl('{$url}').resetParam().setParams($('#gridForm').serializeArray()).setMethod('POST').load()";
	}

	public function setPages(){

		$this->pages = \Mage::getController('Controller\Core\Pager');
		$paymentMethodModel = \Mage::getModel('Model\PaymentMethod');

		$query = "SELECT * FROM `{$paymentMethodModel->getTableName()}`";	
		$paymentMethodCount = $paymentMethodModel->getAdapter()->fetchOne($query);
		$this->pages->setTotalRecords($paymentMethodCount);
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