<?php
namespace Block\Admin\Product;
\Mage::loadFileByClassName('Block\Core\Grid');
\Mage::loadFileByClassName('Model\Product');

class Grid extends \Block\Core\Grid{

    protected $filter = null;

    public function getFilter()
    {
        if(!$this->filter){
            $this->filter =  \Mage::getModel('Model\Admin\Filter');
        }
        return $this->filter;
    }
    public function getTitle()
    {
        return  'Product List';
    }
    
    public function prepareCollection()
    {
        $product = \Mage::getModel('Model\Product');
        $query = "SELECT * FROM `{$product->getTableName()}`";

        if($this->getFilter()->hasFilters()){
            
            $query .= " WHERE ";
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                if($type == 'text'){
                    foreach ($filters as $key => $value) {
                        $query .= "(`{$key}` LIKE '%{$value}%') && " ;
                    }
                }
                if($type == 'number'){
                    foreach ($filters as $key => $value) {
                        $query .= "(`{$key}` LIKE '%{$value}%') && " ;
                    }
                }
            }
            $query = substr($query,0,-4);
        }
        $collection = $product->fetchAll($query);
        $this->setCollection($collection);
        return $this;
    }

    public function prepareColumns()
    {
        $this->addColumn('productId',[
            'field' => 'productId',
            'label' => 'Product Id',
            'type' => 'number'
        ]);

        $this->addColumn('sku',[
            'field' => 'sku',
            'label' => 'SKU',
            'type' => 'text'
        ]);

        $this->addColumn('name',[
            'field' => 'name',
            'label' => 'Name',
            'type' => 'text'
        ]);

        $this->addColumn('price',[
            'field' => 'price',
            'label' => 'Price',
            'type' => 'number'
        ]);

        $this->addColumn('discount',[
            'field' => 'discount',
            'label' => 'Discount',
            'type' => 'number'
        ]);

        $this->addColumn('quantity',[
            'field' => 'quantity',
            'label' => 'Quantity',
            'type' => 'number'
        ]);
        $this->addColumn('status',[
            'field' => 'status',
            'label' => 'Status',
            'type' => 'text'
        ]);

        $this->addColumn('createdDate',[
            'field' => 'createdDate',
            'label' => 'CreatedDate',
            'type' => 'datetime'
        ]);

        $this->addColumn('updatedDate',[
            'field' => 'updatedDate',
            'label' => 'UpdatedDate',
            'type' => 'datetime'
        ]);
    }

    public function prepareActions()
    {
        $this->addAction('update',[
            'label' => 'Update',
            'method' => 'getUpdateUrl',
            'ajax' => false
        ]);

        $this->addAction('delete',[
            'label' => 'Delete',
            'method' => 'getDeleteUrl',
            'ajax' => false
        ]);

        $this->addAction('addtocart',[
            'label' => 'Add To Cart',
            'method' => 'addToCartUrl',
            'ajax' => false
        ]);
        
    }

    public function prepareButtons()
    {
        $this->addButton('addnew',[
            'label' => 'Add New',
            'method' => 'addNewUrl',
            'ajax' => false
        ]);

    }

    public function getUpdateUrl($row)
    {
        return $this->getUrl('productUpdate',null,['id' => $row->productId]);
    }

    public function getDeleteUrl($row)
    {
        return $this->getUrl('productdelete',null,['id' => $row->productId]);
    }

    public function addNewUrl()
    {
        return $this->getUrl('productUpdate');
    }

    public function addToCartUrl($row)
    {
        return $this->getUrl('addToCart','admin\cart',['id' => $row->productId]);
    }
}
