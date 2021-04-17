<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::getBlock("Block\Core\Edit");

class Category extends \Block\Core\Edit
{
    function __construct()
    {   
       $this->setTemplate('./View/admin/product/edit/tabs/category.php'); 
    }

    public function setTableRow(\Model\Product $tableRow)
    {
    	$this->tableRow = $tableRow;
    	return $this;
    }


    public function getTableRow()
    {
        return $this->tableRow;
    }

    public function getCategories()
    {
        
        $category = \Mage::getModel('Model\Category');
        if (!$this->categoriesOptions) {

            $query = "SELECT `categoryId`,`name` FROM `{$category->getTableName()}`";
            $options = $category->getAdapter()->fetchPairs($query);
        
            $query = "SELECT `categoryId`,`path` FROM `{$category->getTableName()}`";
            $this->categoriesOptions = $category->getAdapter()->fetchPairs($query);

            if ($this->categoriesOptions) {

                foreach ($this->categoriesOptions as $categoryId => &$pathId) {

                    $pathIds = explode("-",$pathId);

                    foreach ($pathIds as $key => &$id) {
                        
                        if (array_key_exists($id, $options)) {
                            $id = $options[$id];
                        }
                    }
                    $pathId = implode('=>',$pathIds);
                }   
            }    
        }
        return $this->categoriesOptions;
    }    
    

    public function getSelectedCategories()
    {
        $productCategoryModel = \Mage::getModel('Model\Product\Category');
        $query = "SELECT `categoryId` FROM `{$productCategoryModel->getTableName()}` WHERE `productId` = '{$this->getTableRow()->productId}'";
    
        $productCategories = $productCategoryModel->fetchAll($query);
        return $productCategories;
    }
}

?>