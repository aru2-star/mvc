<?php
namespace Block\Admin\Category;
\Mage::loadFileByClassName('Block\Core\Template');
\Mage::loadFileByClassName('Model\Category');

class Grid extends \Block\Core\Template{
    protected $categories = null;
    protected $categoryOptions = [];

    public function __construct()
    {
       $this->setTemplate('./View/admin/category/grid.php'); 
    }

    public function setCategories($categories =NULL) {

            if(!$categories) {
                $categories = \Mage::getModel('Model\category');
                $categories = $categories->fetchAll();
            }
            $this->categories = $categories;
            return $this;
    }

    public function getCategories() {
        if (!$this->categories) {
            $this->setCategories();
        }
        return $this->categories;
    }

    public function getName($category)
    {
        $categoryModel=\Mage::getModel("Model\Category");
        if(!$this->categoryOptions)
        {
            $query="SELECT `categoryId`,`name` FROM `{$categoryModel->getTableName()}`;";
            $this->categoryOptions=$categoryModel->getAdapter()->fetchPairs($query);
        }

        $pathIds = explode("=",$category->pathId);
        foreach ($pathIds as $key => &$id)
        {
           if(array_key_exists($id,$this->categoryOptions)){
                $id=$this->categoryOptions[$id];
           }
        }
        $name= implode("/",$pathIds);
        return $name;
    }

}
?>