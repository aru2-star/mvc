<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Block\Core\Layout');


class Brand extends \Controller\Core\Admin{
    protected $brands = [];
    
    
    public function gridAction (){
       
        try{
            $gridBlock = \Mage::getBlock('Block\Admin\Brand\Grid');
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
            $brand = \Mage::getModel('Model\Brand');

            if(!$this->getRequest()->isPost()){
                throw new \Exception ("Invalid Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $brand = $brand->load($id);
                if (!$brand){
                    throw new \Exception ("Record not found.");
                }
            }
            else {
                $brand->createdDate = date("Y-m-d H:i:s");
            }
            if($this->getRequest()->getPost('image')){
                $name = $_FILES['imagefile']['name'];
                $type = $_FILES['imagefile']['type'];
                $tmp_name = $_FILES['imagefile']['tmp_name'];
                $location = 'skin/admin/pictures/';
    
                if(move_uploaded_file($tmp_name,$location.$name)){
                    $media->$Pid = $id;
                    $data = $media->getData();
                    $query = "INSERT INTO `{$media->getTableName()}` (".implode(",", array_keys($data)) . ") VALUES ('" . implode("','", array_values($data)) . "')";
                    $media->save($query);
                    header("location:".$this->getUrl('grid'));
                }
            }
            $brandData = $this->getRequest()->getPost('brand'); 
            $brand->setData($brandData);
            $brand->save();
            $this->getMessage()->setSuccess('Inserted Successfully.');    
        }
        catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect("grid",null,null,true);
    }
       
    public function brandUpdateAction()
    {
        try{
            
            $layout = $this->getLayout();
            $content = $layout->getChild('content');
            $brand = \Mage::getModel('Model\Brand');
            if ($id = $this->getRequest()->getGet('id')){   
                $brand = $brand->load($id);
            }   
            $gridBlock = \Mage::getBlock('Block\Admin\Brand\Edit')->setTableRow($brand);
            $layout->setTemplate('./View/core/layout/three_column.php');
            $content->addChild($gridBlock);
            $this->toHtmlLayout();
        
        }catch(\Exception $e){
            echo $e->getMessage();
        }
        
    }
    
    
    public function brandDeleteAction()
    {
        try{
            $id = $this->getRequest()->getGet('id');
            if(!$id){
                throw new \Exception("Invalid ID.");    
            }
            $brand = \Mage::getModel('Model\Brand');
            $brand->load($id);
            if($brand->delete()) {
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