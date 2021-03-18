<?php
Mage::loadFileByClassName('Block_Core_Template');

class Block_Category_Grid extends Block_Core_Template
{
    protected $categories = null;
    protected $templateName = null;


    public function __construct()
    {
        $this->templateName  = './View/category/grid.php';
    }

    public function setCategories($categories = null)
    {
        if (!$categories) {
            $categories = Mage::getModel('model_category');
            $categories = $categories->fetchAll();

            if ($categories) {
                $categories = $categories->getData();
            }
        }

        $this->categories = $categories;
        return $this;
    }

    public function getCategories()
    {
        if (!$this->categories) {
            $this->setCategories();
        }

        return $this->categories;
    }
}
