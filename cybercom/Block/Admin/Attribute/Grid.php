<?php  

namespace Block\Admin\Attribute;
\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
	protected $attribute = null;
	protected $filter = null;
	protected $pages = null;
	
	public function prepareCollection()
	{
			
		$attribute = \Mage::getModel('Model\Attribute');
		$offset = ($this->getPages()->getCurrentPage() - 1) * $this->getPages()->getRecordsPerPage();
			
		
		$query = "SELECT * FROM {$attribute->getTableName()}";
		if($this->getFilter()->hasFilters()){
			foreach ($this->getFilter()->getFilters() as $controller => $filters) {
					if($controller == 'attribute'){
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
		//echo $query;
		$attribute = $attribute->fetchAll($query);
		$this->setCollection($attribute);
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
			'label' => 'Add Attribute',
			'method' => 'getaddNewUrl',
			'ajax' => true
		]);
		$this->addButton('addfilter',[
			'label' => 'Apply filter',
			'method' => 'getaddFilterUrl',
			'ajax' => true
		]);
		$this->addButton('clearfilter',[
			'label' => 'Clear filter',
			'method' => 'getclearFilterUrl',
			'ajax' => true
		]);
		return $this;
	}

	public function prepareColumns()
	{
		$this->addColumn('attributeId',[
			'label' => 'Attribute Id',
			'field' => 'attributeId',
			'type' => 'number',
			'controller' => 'attribute'
		]);
		$this->addColumn('entityTypeId',[
			'label' => 'EntityTypeId',
			'field' => 'entityTypeId',
			'type' => 'text',
			'controller' => 'attribute'
		]);
		$this->addColumn('name',[
			'label' => 'name',
			'field' => 'name',
			'type' => 'text',
			'controller' => 'attribute'
		]);
		$this->addColumn('inputType',[
			'label' => 'InputType',
			'field' => 'inputType',
			'type' => 'text',
			'controller' => 'attribute'
		]);
		$this->addColumn('code',[
			'label' => 'Code',
			'field' => 'code',
			'type' => 'text',
			'controller' => 'attribute'
		]);
		return $this;
	}

	public function getTitle()
	{
		return 'Attribute List';
	}
	
	public function getEditUrl($row)
	{
		$url = $this->getUrl()->getUrl('edit','admin_attribute',['attributeId'=>$row->attributeId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}

	public function getaddFilterUrl()
	{
		$url = $this->getUrl()->getUrl('filter','admin_attribute',null);
		return "object.setUrl('{$url}').resetParam().setParams($('#gridForm').serializeArray()).setMethod('POST').load()";

	}
	
	public function getclearFilterUrl()
	{
		$url = $this->getUrl()->getUrl('clearFilter','admin_attribute',null,true);
		return "object.setUrl('{$url}').resetParam().load()";
	}

	public function getDeleteUrl($row)
	{
		$url = $this->getUrl()->getUrl('delete','admin_attribute',['attributeId'=>$row->attributeId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}
	
	public function getaddNewUrl()
	{
		$url = $this->getUrl()->getUrl('edit','admin_attribute',null,true);
		return "object.setUrl('{$url}').resetParam().load()";
	}

	public function setPages(){

		$this->pages = \Mage::getController('Controller\Core\Pager');
		$attributeModel = \Mage::getModel('Model\Attribute');

		$query = "SELECT * FROM `{$attributeModel->getTableName()}`";	
		$attributeCount = $attributeModel->getAdapter()->fetchOne($query);
		$this->pages->setTotalRecords($attributeCount);
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