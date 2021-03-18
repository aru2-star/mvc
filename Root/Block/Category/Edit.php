<?php
Mage::loadFileByClassName('Block_Core_Template');


class Block_Category_Edit extends Block_Core_Template
{
    protected $category = null;
    protected $templateName = null;


    public function __construct()
    {
        $this->templateName  = './View/category/form.php';
    }


    public function setCategory($category = null)
    {
        if ($category) {
            $this->category = $category;
        }

        $category = Mage::getModel('model_category');

        if ($id = (int) $this->getRequest()->getGet('id')) {
            $category = $category->load($id);
        }

        $this->category = $category;
        return $this;
    }

    public function getCategory()
    {
        if (!$this->category) {
            $this->setCategory();
        }

        return $this->category;
    }
}
