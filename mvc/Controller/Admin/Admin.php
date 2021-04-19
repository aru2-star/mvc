<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Block\Core\Layout');

class Admin extends \Controller\Core\Admin
{
    public function gridAction (){
       
        try{
            $grid = \Mage::getBlock('Block\Admin\Admin\Grid');
            $grid->setController($this);
            $layout = $this->getLayout();
            $content = $layout->getChild('content');
            $content->addChild($grid);
            $this->toHtmlLayout();

        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
    
    
    public function saveAction(){
        date_default_timezone_set('Asia/Kolkata');
        try{
            $admin = \Mage::getModel('Model\Admin');

            if(!$this->getRequest()->isPost()){
                throw new \Exception ("Invalid Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $admin = $admin->load($id);
                if (!$admin){
                    throw new \Exception ("Record not found.");
                }
                $admin->updatedDate = date("Y-m-d H:i:s");

            }
            else {
                $admin->createdDate = date("Y-m-d H:i:s");
            }
            $adminData = $this->getRequest()->getPost('admin'); 
            $admin->setData($adminData);
            $admin->save();
            $this->getMessage()->setSuccess('Inserted Successfully.');    
        }
        catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect("grid",null,null,true);
    }
       
    public function adminUpdateAction()
    {
        try{
            $layout = $this->getLayout(); 
            $content = $layout->getChild('content');
            $layout->setTemplate('./View/core/layout/three_column.php');
            $admin = \Mage::getModel('Model\Admin');
            if ($id = (int)$this->getRequest()->getGet('id')){   
                $admin = $admin->load($id);
            }
            $editBlock =  \Mage::getBlock('Block\Admin\Admin\Edit')->setTableRow($admin);
            $content->addChild($editBlock);
            echo $this->toHtmlLayout();
        
        }catch(\Exception $e){
            echo $e->getMessage();
        }
        
    }
    
    
    public function adminDeleteAction()
    {
        try{
            $id = $this->getRequest()->getGet('id');
            if(!$id){
                throw new \Exception("Invalid ID.");    
            }
            $admin = \Mage::getModel('Model\Admin');
            $admin->load($id);
            if($admin->delete()) {
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
