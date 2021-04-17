<?php
namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Attribute extends \Controller\Core\Admin
{
            
    public function gridAction()
    {
        $grid = \Mage::getBlock('Block\Admin\Attribute\Grid');

        $layout = $this->getLayout();
        $layout->getContent()->addChild($grid);
        echo $layout->toHtml();
    }

    public function attributeUpdateAction()
    {
        $layout = $this->getLayout(); 
        $content = $layout->getChild('content');
        $layout->setTemplate('./View/core/layout/three_column.php');
        $attribute = \Mage::getModel('Model\Attribute');
            if ($id = (int)$this->getRequest()->getGet('id')){   
                $attribute = $attribute->load($id);
            }
        $editBlock =  \Mage::getBlock('Block\Admin\Attribute\Edit')->setTableRow($attribute);
        $content->addChild($editBlock);
        echo $this->toHtmlLayout();
    }

    public function saveAction()
    {
        $attribute = \Mage::getModel('Model\Attribute');
        $data = $this->getRequest()->getPost('attribute');
        if ($id = $this->getRequest()->getGet('id')) {
            echo 2;
            $attribute->load($id)->getData($data);
            $attribute->attributeId = $id;
        }
        $attribute->setData($data);
        $attribute->save();
        $this->redirect('grid', null, null, true);
    }

    public function  attributeDeleteAction()
    {
        $id = $this->getRequest()->getGet('id');

        $attribute = \Mage::getBlock("Model\Attribute");

        $attribute->load($id);

        if ($id != $attribute->attributeId) {
            throw new \Exception('Invalid Id.');
        }
        $attribute->delete();
        $this->redirect('grid', null, null, true);
    }

    public function filterAction()
    {
        echo "<pre>";
        $query = "SELECT * FROM `attribute` WHERE `entityTypeId` = 'product'";
        $attributes = \Mage::getModel('Model\Attribute')->fetchAll($query);
        print_r($attributes);

        foreach ($attributes->getData() as $key => $attribute) {
            $option = \Mage::getModel('Model\Attribute\Option');
            $options = $option->setAttribute($attribute)->getOptions();
            print_r($options);
        }
    }

}
?>