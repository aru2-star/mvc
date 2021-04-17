<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Block\Core\Layout');

date_default_timezone_set('Asia/Kolkata');
class CmsPage extends \Controller\Core\Admin{
    protected $cmsPages = [];

    public function gridAction (){
       
        try{
            $gridBlock = \Mage::getBlock('Block\Admin\CmsPage\Grid');
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
            $cmsPage = \Mage::getModel('Model\CmsPage');

            if(!$this->getRequest()->isPost()){
                throw new \Exception ("Invalid Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $cmsPage = $cmsPage->load($id);
                if (!$cmsPage){
                    throw new \Exception ("Record not found.");
                }
                $cmsPage->updatedDate = date("Y-m-d H:i:s");
            }
            else {
                $cmsPage->createdDate = date("Y-m-d H:i:s");
            }
            $cmsPageData = $this->getRequest()->getPost('cmsPage'); 
            $cmsPage->setData($cmsPageData);
            // echo"<pre>";
            // print_r($cmsPage);
            // die();
            $cmsPage->save();
            $this->getMessage()->setSuccess('Inserted Successfully.');    
        }
        catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect("grid",null,null,true);
    }
       
    public function cmsPageUpdateAction()
    {
        try{
            $layout = $this->getLayout(); 
            $content = $layout->getChild('content');
            $layout->setTemplate('./View/core/layout/three_column.php');
            $cmsPage = \Mage::getModel('Model\CmsPage');
            if ($id = (int)$this->getRequest()->getGet('id')){   
                $cmsPage = $cmsPage->load($id);
            }
            $editBlock =  \Mage::getBlock('Block\Admin\CmsPage\Edit')->setTableRow($cmsPage);;
            $content->addChild($editBlock);
            echo $this->toHtmlLayout();
        
        }catch(\Exception $e){
            echo $e->getMessage();
        }
        
    }
    
    
    public function cmsPageDeleteAction()
    {
        try{
            $id = $this->getRequest()->getGet('id');
            if(!$id){
                throw new \Exception("Invalid ID.");    
            }
            $cmsPage = \Mage::getModel('Model\CmsPage');
            $cmsPage->load($id);
            if($cmsPage->delete()) {
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


