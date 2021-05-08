<?php 
namespace Block\Admin\Cart;

\Mage::loadFileByClassName('Block\Core\Grid');

class Products extends \Block\Core\Grid
{
	protected $pages = null;
	protected $filter = null;
	public function prepareCollection()
	{
		$product = \Mage::getModel('Model\Product');
		$offset = ($this->getPages()->getCurrentPage() - 1) * $this->getPages()->getRecordsPerPage();

		$query = "SELECT * FROM {$product->getTableName()} LIMIT {$offset},{$this->getPages()->getRecordsPerPage()}";

		$collection = $product->fetchAll($query);
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

	public function prepareColumns()
	{
		$this->addColumn('id',[
			'field' => 'productId',
			'label' => 'ID',
			'type' => 'number',
			'controller' => 'cart'
		]);
		$this->addColumn('sku',[
			'field' => 'sku',
			'label' => 'Sku',
			'type' => 'text',
			'controller' => 'cart'
		]);
		$this->addColumn('name',[
			'field' => 'name',
			'label' => 'Name',
			'type' => 'text',
			'controller' => 'cart'
		]);
		$this->addColumn('price',[
			'field' => 'price',
			'label' => 'Price(in Rs.)',
			'type' => 'decimal',
			'controller' => 'cart'
		]);
		$this->addColumn('discount',[
			'field' => 'discount',
			'label' => 'Discount(in Rs.)',
			'type' => 'decimal',
			'controller' => 'cart'
		]);
		return $this;
	}

	public function prepareActions()
	{
		$this->addActions('addtocart',[
			'label' => 'Add To Cart',
			'method' => 'getAddToCartUrl',
			'ajax' => true
		]);
		return $this;
	}

	public function getAddToCartUrl($row)
	{
		$url = $this->getUrl()->getUrl('addToCart',null,['productId' => $row->productId]);
		return "object.setUrl('{$url}').load()";
	}

	public function getTitle()
	{
		return 'Product List';
	}

	public function setPages(){

		$this->pages = \Mage::getController('Controller\Core\Pager');
		$productModel = \Mage::getModel('Model\Product');

		$query = "SELECT * FROM `{$productModel->getTableName()}`";
		$productCount = $productModel->getAdapter()->fetchOne($query);
		$this->pages->setTotalRecords($productCount);
		$this->pages->setRecordsPerPage(40);
		if(isset($_GET['page'])) {
		$this->pages->setCurrentPage($_GET['page']);
		}else {
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