<?php 
namespace Controller\Admin\Configuration;

class Config extends \Controller\Core\Admin  
{
    public function gridAction()
    {
        $layout = $this->getLayout();
        $layout->setTemplate('./View/core/layout/one_Column.php');
        $grid = \Mage::getBlock('Block\Admin\Configuration\Grid');
        $content = $layout->getChild('content');
        $content->addChild($grid);
        echo $this->toHtmlLayout();
    }

    public function editAction()
    {
        try{
            $layout = $this->getLayout(); 
            $content = $layout->getChild('content');
            $config = \Mage::getModel('Model\Configuration\Config');

            if ($id = $this->getRequest()->getGet('id')){   
                $config = $config->load($id);
            }
            $edit =  \Mage::getBlock('Block\Admin\Configuration\Edit')->setTableRow($config);
            $content->addChild($edit);
            echo $this->toHtmlLayout();
        }
        catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function saveAction() {
        date_default_timezone_set('Asia/Kolkata');
        try{
            $config = \Mage::getModel('Model\Configuration\Config');

            if(!$this->getRequest()->isPost()){
                throw new \Exception ("Invalid Request.");
            }

            if ($id = $this->getRequest()->getGet('id')) {
                $config = $config->load($id);

                if (!$config){
                    throw new \Exception ("Record not found.");
                }
            }
            else {
                $config->createdDate = date("Y-m-d H:i:s");
            }
            $configData = $this->getRequest()->getPost('config'); 
            $config->setData($configData);
            $config->save();
            $this->getMessage()->setSuccess('Inserted Successfully.');
        }
        catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('edit','admin\configuration',null,true);
    }

    public function deleteAction()
    {
        try{
            $id = $this->getRequest()->getGet('id');
            if(!$id){
                throw new \Exception("Invalid ID.");    
            }
            $config = \Mage::getModel('Model\Configuration\Config');
            $config->load($id);
            
            if($config->delete()) {
                $this->getMessage()->setSuccess('Deleted Successfully.');
            }
            else {
                $this->getMessage()->setFailure('Unable to Delete.');
            }
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }  
        $this->redirect('edit','admin\configuration',null,true);
        
    }
}
