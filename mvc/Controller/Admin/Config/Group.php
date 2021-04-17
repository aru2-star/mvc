<?php
namespace Controller\Admin\Config;

class Group extends \Controller\Core\Admin
{    
    public function gridAction (){
       
        try{
            $gridBlock = \Mage::getBlock('Block\Admin\Config\Grid');
            $gridBlock->setController($this);
            $layout = $this->getLayout();
            $content = $layout->getChild('content');
            $content->addChild($gridBlock);
            $this->toHtmlLayout();

        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function saveAction(){

        try{
            $configGroup = \Mage::getModel('Model\Config\Group');

            if(!$this->getRequest()->isPost()){
                throw new \Exception ("Invalid Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $configGroup = $configGroup->load($id);
                if (!$configGroup){
                    throw new \Exception ("Record not found.");
                }
                $configGroup->createdDate = date("Y-m-d H:i:s");

            }      
            $configGroupData = $this->getRequest()->getPost('configGroup'); 
            $configGroup->setData($configGroupData);
            $configGroup->save();
            $this->getMessage()->setSuccess('Inserted Successfully.');    
        }
        catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect("grid",null,null,true);
    }
       
    public function editAction()
    {
        try{
            
            $layout = $this->getLayout();
            $content = $layout->getChild('content');
            $configGroup = \Mage::getModel('Model\Config\Group');
            if ($id = $this->getRequest()->getGet('id')){   
                $configGroup = $configGroup->load($id);
            }   
            $gridBlock = \Mage::getBlock('Block\Admin\Config\Edit')->setTableRow($configGroup);
            $layout->setTemplate('./View/core/layout/three_column.php');
            $content->addChild($gridBlock);
            $this->toHtmlLayout();
        
        }catch(\Exception $e){
            echo $e->getMessage();
        }
        
    }    
    
    public function deleteAction()
    {
        try{
            $id = $this->getRequest()->getGet('id');
            if(!$id){
                throw new \Exception("Invalid Id.");    
            }
            $configGroup = \Mage::getModel('Model\Config\Group');
            $configGroup->load($id);
            // echo "<pre>";
            // print_r($configGroup);
            //die();
            if($configGroup->delete()) {
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
?>