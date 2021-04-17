<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Block\Core\Layout');

date_default_timezone_set('Asia/Kolkata');
class Shipping extends \Controller\Core\Admin{
    protected $shippings = [];

    public function gridAction (){
       
        try{
            $gridBlock = \Mage::getBlock('Block\Admin\Shipping\Grid');
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
            $shipping = \Mage::getModel('Model\Shipping');

            if(!$this->getRequest()->isPost()){
                throw new \Exception ("Invalid Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $shipping = $shipping->load($id);
                if (!$shipping){
                    throw new \Exception ("Record not found.");
                }
                $shipping->updatedDate = date("Y-m-d H:i:s");

            }
            else {
                $shipping->createdDate = date("Y-m-d H:i:s");
            }
            $shippingData = $this->getRequest()->getPost('shipping'); 
            $shipping->setData($shippingData);
            $shipping->save();
            $this->getMessage()->setSuccess('Inserted Successfully.');    
        }
        catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect("grid",null,null,true);
    }
       
    public function shippingUpdateAction()
    {
        try{
            $layout = $this->getLayout(); 
            $content = $layout->getChild('content');
            $layout->setTemplate('./View/core/layout/three_column.php');
            $shipping = \Mage::getModel('Model\Shipping');
            if ($id = (int)$this->getRequest()->getGet('id')){   
                $shipping = $shipping->load($id);
            }
            $editBlock =  \Mage::getBlock('Block\Admin\Shipping\Edit')->setTableRow($shipping);
            $content->addChild($editBlock);
            echo $this->toHtmlLayout();

        
        }catch(\Exception $e){
            echo $e->getMessage();
        }
        
    }    
    
    public function shippingDeleteAction()
    {
        try{
            $id = $this->getRequest()->getGet('id');
            if(!$id){
                throw new \Exception("Invalid ID.");    
            }
            $shipping = \Mage::getModel('Model\Shipping');
            $shipping->load($id);
            if($shipping->delete()) {
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