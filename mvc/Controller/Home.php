<?php
namespace Controller;
\Mage::loadFileByClassName('Controller\Core\Customer');

class Home extends \Controller\Core\Customer{
    
    public function indexAction()
    {
        try{
            $gridBlock = \Mage::getBlock('Block\Home\Index');
            $layout = $this->getLayout();
            $content = $layout->getChild('content');
            $content->addChild($gridBlock);
            $this->toHtmlLayout();

        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
    public function pageAction()
    {
        $pager = \Mage::getController('Controller\Core\Pager');
        
        $sql = "SELECT * FROM product;";
        $product = \Mage::getModel('Model\Product');
        $productCount = $product->getAdapter()->fetchOne($sql);
        
        $pager->setTotalRecords($productCount);
        $pager->setRecordPerPage(2);
        $pager->setCurrentPage($_GET['p']);
        $pager->calculate();
        echo "<pre>";
        print_r($pager);

    }
}