 <?php
Mage::loadFileByClassName('Controller_Core_Admin');

class Controller_Attribute extends Controller_Core_Admin
{

    public function gridAction()
    {
        $grid = Mage::getBlock('Block_Admin_Attribute_Grid');

        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $content->addChild($grid);

        $this->renderLayout();
    }

    public function formAction() {
    	$edit = Mage::getModel('Block_Admin_Attribute_Edit');
        $layout = $this->getLayout();
        $layout->setTemplate('View/core/layout/threeColumn.php');
    	$content = $layout->getChild('content');
        $content->addChild($edit);
        $this->renderLayout();
        //echo $content->toHtml();
    }

    public function addAction() {
        $attribute = Mage::getModel('Model_Attribute');
        $data = $this->getRequest()->isPost();
        $attribute->setData($this->getRequest()->getPost('attribute'));
        //$attribute->setData($data);
        
        // echo "<pre>";
        // print_r($attribute);
        // die();
        $attribute->save();
        $this->redirect('attribute', 'grid', null, true);
    }

    public function optionsAction() {
        $attribute = MAge::getModel('Model_Attribute');
        $id = $this->getRequest()->getGet('attributeId');
    }
}