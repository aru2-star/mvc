<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Block\Core\Layout');

class CustomerGroup extends \Controller\Core\Admin 
{
    public function gridAction () {
        //echo __CLASS__;
        //echo __FUNCTION__;

        try {
            $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Grid');
            $grid->setController($this);
            $layout = $this->getLayout(); 
            $content = $layout->getChild('content');
            $content->addChild($grid);
            $this->toHtmlLayout();
        }
        catch (Exception $e) {
            $e->getMessage();
        } 
    }

    public function saveAction() {
        try{
            $customerGroup = \Mage::getModel('Model\CustomerGroup');

            if(!$this->getRequest()->isPost()){
                throw new \Exception ("Invalid Request.");
            }

            if ($id = $this->getRequest()->getGet('id')) {
                $customerGroup = $customerGroup->load($id);

                if (!$customerGroup){
                    throw new \Exception ("Record not found.");
                }
            }
            else {
                $customerGroup->createdDate = date("Y-m-d H:i:s");
            }
            $customerGroupData = $this->getRequest()->getPost('customerGroup'); 
            $customerGroup->setData($customerGroupData);
            $customerGroup->save();
            $this->getMessage()->setSuccess('Inserted Successfully.');
        }
        catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect("grid",null,null,true);
    }

    public function customerGroupUpdateAction(){
        try{
            $layout = $this->getLayout(); 
            $content = $layout->getChild('content');
            $layout->setTemplate('./View/core/layout/three_column.php');
            $customerGroup = \Mage::getModel('Model\CustomerGroup');
            if ($id = (int)$this->getRequest()->getGet('id')){   
                $customerGroup = $customerGroup->load($id);
            }
            $editBlock =  \Mage::getBlock('Block\Admin\CustomerGroup\Edit')->setTableRow($customerGroup);
            $content->addChild($editBlock);
            echo $this->toHtmlLayout();

        }
        catch (Exception $e) {
            $e->getMessage();
        }  
    }
    
    public function customerGroupDeleteAction()
    {
        try{
            $id = $this->getRequest()->getGet('id');
            if(!$id){
                throw new \Exception("Invalid Id.");    
            }
            $customerGroup = \Mage::getModel('Model\CustomerGroup');
            $customerGroup->load($id);
            if($customerGroup->delete()) {
                $this->getMessage()->setSuccess('Deleted Successfully.');
            }
            else {
                $this->getMessage()->setFailure('Unable to Delete Record.');
            }
        }
        catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        } 
        $this->redirect("grid",null,null,true);
        
    }
}
