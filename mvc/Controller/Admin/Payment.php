<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Block\Core\Layout');


class Payment extends \Controller\Core\Admin{
    protected $payments = [];
    
    
    public function gridAction (){
       
        try{
            $gridBlock = \Mage::getBlock('Block\Admin\Payment\Grid');
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
            $payment = \Mage::getModel('Model\Payment');

            if(!$this->getRequest()->isPost()){
                throw new \Exception ("Invalid Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $payment = $payment->load($id);
                if (!$payment){
                    throw new \Exception ("Records not found.");
                }
                $payment->updatedDate = date("Y-m-d H:i:s");

            }
            else {
                $payment->createdDate = date("Y-m-d H:i:s");
            }
            $paymentData = $this->getRequest()->getPost('payment'); 
            $payment->setData($paymentData);
            $payment->save();
            $this->getMessage()->setSuccess('Inserted Successfully.');    
        }
        catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect("grid",null,null,true);
    }
       
    public function paymentUpdateAction()
    {
        try{
            
            $layout = $this->getLayout();
            $content = $layout->getChild('content');
            $payment = \Mage::getModel('Model\Payment');
            if ($id = $this->getRequest()->getGet('id')){   
                $payment = $payment->load($id);
            }   
            $gridBlock = \Mage::getBlock('Block\Admin\Payment\Edit')->setTableRow($payment);
            $layout->setTemplate('./View/core/layout/three_column.php');
            $content->addChild($gridBlock);
            $this->toHtmlLayout();
        
        }catch(\Exception $e){
            echo $e->getMessage();
        }
        
    }    
    
    public function paymentDeleteAction()
    {
        try{
            $id = $this->getRequest()->getGet('id');
            if(!$id){
                throw new \Exception("Invalid ID.");    
            }
            $payment = \Mage::getModel('Model\Payment');
            $payment->load($id);
            if($payment->delete()) {
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