<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Block\Core\Layout');

date_default_timezone_set('Asia/Kolkata');
class Customer extends \Controller\Core\Admin{
    protected $customers = [];

    public function gridAction (){
       
        try{
            $gridBlock = \Mage::getBlock('Block\Admin\Customer\Grid');
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
            $customer = \Mage::getModel('Model\Customer');

            if(!$this->getRequest()->isPost()){
                throw new \Exception ("Invalid Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $customer = $customer->load($id);
                if (!$customer){
                    throw new \Exception ("Record not found.");
                }
                $customer->updatedDate = date("Y-m-d H:i:s");

            }
            else {
                $customer->createdDate = date("Y-m-d H:i:s");
            }
            $customerData = $this->getRequest()->getPost('customer'); 
            $customer->setData($customerData);
            
            $customer->save();
            $this->getMessage()->setSuccess('Inserted Successfully.');    
        }
        catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect("grid",null,null,true);
    }

    public function addressSaveAction(){
        try{
            $customerBilling = \Mage::getModel("Model\Customer");
            $customerShipping = \Mage::getModel("Model\Customer");
            $customerBilling->setTableName('customer_address');
            $customerShipping->setTableName('customer_address');
            $customerBilling->setPrimaryKey('customerId');
            $customerShipping->setPrimaryKey('customerId');
            $customerShipping->addressType = 'Shipping';
            $customerBilling->addressType = 'Billing';

            $customer = \Mage::getModel("Model\Customer");
            $customer->setData($_POST);

            foreach($customer->getData() as $key=>$value){
                if(strpos($key,'shipping') !== false){
                    $key = substr($key,8);
                    $customerShipping->$key = $value;
                }else{
                    $customerBilling->$key = $value;
                }
            }
            if($id = $this->getRequest()->getGet('id')){
                $Pid = $customer->getPrimaryKey();
                $customerBilling->$Pid = $id;
                $customerShipping->$Pid = $id;
            }
            if($customerBilling->addressSave1() && $customerShipping->addressSave1() && $id){
                $this->getMessage()->setSuccess("Update Successfully");
            }else{
                throw new \Exception("Unable To Update");
            }
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect("grid",null,null,true);
    }

       
    public function customerUpdateAction()
    {
        try{
            $layout = $this->getLayout(); 
            $content = $layout->getChild('content');
            $layout->setTemplate('./View/core/layout/three_column.php');
            $customer = \Mage::getModel('Model\Customer');
            if ($id = (int)$this->getRequest()->getGet('id')){   
                $customer = $customer->load($id);
            }
            $editBlock =  \Mage::getBlock('Block\Admin\Customer\Edit')->setTableRow($customer);

            $content->addChild($editBlock);
            echo $this->toHtmlLayout();

        
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }    
    
    public function customerDeleteAction()
    {
        try{
            $id = $this->getRequest()->getGet('id');
            if(!$id){
                throw new \Exception("Invalid Id.");    
            }
            $customer = \Mage::getModel('Model\customer');
            $customer->load($id);
            if($customer->delete()) {
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