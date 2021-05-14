<?php
namespace Block\Admin\Cms;
\Mage::loadFileByClassName('Block\Core\Grid'); 	

class Grid extends \Block\Core\Grid
{
	
	protected $page = null;
	protected $pages = null;
	protected $filter = null;
	
	public function prepareCollection()
	{
			
			$page = \Mage::getModel('Model\Cms');
			$offset = ($this->getPages()->getCurrentPage() - 1) * $this->getPages()->getRecordsPerPage();
			
			$query = "SELECT * FROM {$page->getTableName()}";
			if($this->getFilter()->hasFilters()){
				foreach ($this->getFilter()->getFilters() as $controller => $filters) {
					if($controller == 'cms'){
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
							
			$page = $page->fetchAll($query);
			$this->setCollection($page);
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
			'label' => 'Add Cms Page',
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
		$this->addColumn('pageId',[
			'label' => 'Id',
			'field' => 'pageId',
			'type' => 'number',
			'controller' => 'cms'
		]);
		$this->addColumn('title',[
			'label' => 'Title',
			'field' => 'title',
			'type' => 'text',
			'controller' => 'cms'
		]);
		
		$this->addColumn('identifier',[
			'label' => 'Identifier',
			'field' => 'identifier',
			'type' => 'number',
			'controller' => 'cms'
		]);

		return $this;
	}

	public function getTitle()
	{
		return 'CMS List';
	}
	
	public function getEditUrl($row)
	{
		$url = $this->getUrl()->getUrl('edit','admin_cms',['pageId'=>$row->pageId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}

	public function getaddFilterUrl()
	{
		$url = $this->getUrl()->getUrl('filter','admin_cms',null);
		return "object.setUrl('{$url}').resetParam().setParams($('#gridForm').serializeArray()).setMethod('POST').load()";
	}
	
	public function getDeleteUrl($row)
	{
		$url = $this->getUrl()->getUrl('delete','admin_cms',['pageId'=>$row->pageId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}
	
	public function getaddNewUrl()
	{
		$url = $this->getUrl()->getUrl('edit','admin_cms',null,true);
		return "object.setUrl('{$url}').resetParam().load()";
	}

	public function setPages(){

		$this->pages = \Mage::getController('Controller\Core\Pager');
		$cmsModel = \Mage::getModel('Model\Cms');

		$query = "SELECT * FROM `{$cmsModel->getTableName()}`";	
		$cmsCount = $cmsModel->getAdapter()->fetchOne($query);
		$this->pages->setTotalRecords($cmsCount);
		$this->pages->setRecordsPerPage(2);
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