<?php

namespace Block\Admin\Customer;
\Mage::loadFileByClassName('Block\Core\Grid'); 	

class Grid extends \Block\Core\Grid
{
	protected $template = null;	
	protected $customers = null;
	protected $groups = null;
	protected $pages = null;
	protected $filter = null;
	
	public function prepareCollection() {

			$customers = \Mage::getModel('Model\Customer');
			
			$offset = ($this->getPages()->getCurrentPage() - 1) * $this->getPages()->getRecordsPerPage();
			$query = "SELECT * FROM {$customers->getTableName()}";


			if($this->getFilter()->hasFilters()){
				foreach ($this->getFilter()->getFilters() as $controller => $filters) {
					if($controller == 'customer'){
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

			$customers = $customers->fetchAll($query);
			foreach ($customers->getData() as $key => &$customer) {
				$customer->groupId = $this->getCustomerGroups($customer);
				$customer->address = $this->getBillingAddress($customer);
			}

		$this->setCollection($customers);
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

	public function prepareColumns()
	{
		$this->addColumn('customerId',[
			'label' => 'Customer Id',
			'field' => 'customerId',
			'type' => 'number',
			'controller' => 'customer'
		]);
		$this->addColumn('fname',[
			'label' => 'First Name',
			'field' => 'fname',
			'type' => 'text',
			'controller' => 'customer'
		]);
		
		$this->addColumn('lname',[
			'label' => 'Last Name',
			'field' => 'lname',
			'type' => 'text',
			'controller' => 'customer'
		]);

		$this->addColumn('email',[
			'label' => 'Email',
			'field' => 'email',
			'type' => 'text',
			'controller' => 'customer'
		]);

		$this->addColumn('mobile',[
			'label' => 'Mobile',
			'field' => 'mobile',
			'type' => 'text',
			'controller' => 'customer'
		]);

		$this->addColumn('groupId',[
			'label' => 'Group ',
			'field' => 'groupId',
			'type' => 'text',
			'controller' => 'customer'
		]);
		
		$this->addColumn('address',[
			'label' => 'Address',
			'field' => 'address',
			'type' => 'text',
			'controller' => 'customer'
		]);
		return $this;
	}

	public function prepareButtons()
	{
		$this->addButton('addNew',[
			'label' => 'Add Customer',
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
		return 'Customer List';
	}
	
	public function getEditUrl($row)
	{
		$url = $this->getUrl()->getUrl('edit','admin_customer',['customerId'=>$row->customerId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}

	public function getDeleteUrl($row)
	{
		$url = $this->getUrl()->getUrl('delete','admin_customer',['customerId'=>$row->customerId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}
	
	public function getaddNewUrl()
	{
		$url = $this->getUrl()->getUrl('edit','admin_customer',null,true);
		return "object.setUrl('{$url}').resetParam().load()";
	}

	public function getaddFilterUrl()
	{
		$url = $this->getUrl()->getUrl('filter','admin_customer',null);
		return "object.setUrl('{$url}').resetParam().setParams($('#gridForm').serializeArray()).setMethod('POST').load()";
	}

	public function getCustomerGroups($customer)
	{
		$customerModel = \Mage::getModel('Model\Customer');
		$name = '';
		if (!$this->groups) {
			$query = "SELECT groupId,name FROM customer_group";
			$this->groups = $customerModel->getAdapter()->fetchPairs($query);
			
		}
		$customerGroupId[] = $customer->groupId;
		foreach ($customerGroupId as $groupId) {
			if (array_key_exists($groupId, $this->groups)) {
					$name = $this->groups[$groupId];
				}	
		}	
		return $name;
	}

	public function getBillingAddress($customer)
	{	
		$customerModel = \Mage::getModel('Model\Customer');
		$id = $customer->customerId;
		$billingAddress = '';
		
		$query = "SELECT zipcode FROM `customer_address` WHERE `customerId` ='{$id}' AND `address_type`='1'";	
		$address = 	$customerModel->fetchAll($query);
		if($address){
			foreach ($address->getData() as $key => $value) 
			{
				$billingAddress = $value->zipcode;
			}
		}
		return $billingAddress;
	}

	public function getStatusName($customer)
	{
		if ($customer->status == 1)
		{
			return "Enable";
		}
		return "Disable";
	}

	public function setPages(){

		$this->pages = \Mage::getController('Controller\Core\Pager');
		$customerModel = \Mage::getModel('Model\Customer');

		$query = "SELECT * FROM `{$customerModel->getTableName()}`";	
		$customerCount = $customerModel->getAdapter()->fetchOne($query);
		$this->pages->setTotalRecords($customerCount);
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