<?php

namespace Block\Admin\ConfigurationGroup;

class Grid extends \Block\Core\Grid
{
	protected $filter = null;
	protected $pages = null;
	
	public function prepareCollection()
	{
		$configurationGroup = \Mage::getModel('Model\ConfigurationGroup');
		$offset = ($this->getPages()->getCurrentPage() - 1)* $this->getPages()->getRecordsPerPage();

		$query = "SELECT * FROM `{$configurationGroup->getTableName()}`";
		$configurationGroup = $configurationGroup->fetchAll($query);
		$this->setCollection($configurationGroup);
		return $this;
	}

	public function prepareColumns()
	{
		$this->addColumn('groupId',[
			'label' => 'Id',
			'field' => 'groupId',
			'type' => 'number',
			'controller' => 'configurationGroup'
		]);
		
		$this->addColumn('name',[
			'label' => 'Name',
			'field' => 'name',
			'type' => 'text',
			'controller' => 'configurationGroup'
		]);

		return $this;
	}

	public function prepareActions()
	{
		$this->addActions('edit',[
			'label' => 'Edit',
			'method' => 'getEditUrl',
			'ajax' => true

		]);

		$this->addActions('delete',[
			'label' => 'Delete',
			'method' => 'getDeleteUrl',
			'ajax' => true

		]);

		return $this;
	}

	public function prepareButtons()
	{
		$this->addButton('addNew',[
			'label' => 'Add Group',
			'method' => 'getaddNewUrl',
			'ajax' => true

		]);

		$this->addButton('addfilter',[
			'label' => 'Add Filter',
			'method' => 'getaddFilterUrl',
			'ajax' => true

		]);

		return $this;
	}

	public function getTitle()
	{
		return 'Configuration List';
	}
	public function getaddNewUrl()
	{
		$url = $this->getUrl()->getUrl('edit','admin_configurationGroup',null,true);
		return "object.setUrl('{$url}').resetParam().load()";
	}

	public function getaddFilterUrl()
	{
		$url = $this->getUrl()->getUrl('filter','admin_configurationGroup',null);
		return "object.setUrl('{$url}').resetParam().setParams($('#gridForm').serializeArray()).setMethod('POST').load()";
	}

	public function getDeleteUrl($row)
	{
		$url = $this->getUrl()->getUrl('delete','admin_configurationGroup',['configurationGroupId'=>$row->groupId],true);
		return "object.setUrl('{$url}').resetParam().load()";
	}

	public function getEditUrl($row)
	{
		$url = $this->getUrl()->getUrl('edit','admin_configurationGroup',['configurationGroupId'=>$row->groupId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}

	public function getFilter()
	{
		if(!$this->filter){
			$this->filter = \Mage::getModel('Model\Admin\Filter');
		}
		return $this->filter;
	}

	public function setPages()
	{
		$this->pages = \Mage::getController('Controller\Core\Pager');
		$configurationGroup = \Mage::getModel('Model\ConfigurationGroup');
		$query = "SELECT * FROM `{$configurationGroup->getTableName()}`";
		$configurationGroupCount = $configurationGroup->getAdapter()->fetchOne($query);
		$this->pages->setTotalRecords($configurationGroupCount);
		$this->pages->setRecordsPerPage(3);
		if(isset($_GET['page'])){
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