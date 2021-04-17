<?php
namespace Block\Admin\CmsPage;
\Mage::loadFileByClassName('Block\Core\Template');
\Mage::loadFileByClassName('Model\Shipping');

class Grid extends \Block\Core\Template
{
    protected $cmsPages = [];

    public function __construct() {
        $this->setTemplate('./View/admin/cmsPage/grid.php');
    }

    public function setCmsPages($cmsPages = NULL) {
        if(!$cmsPages) {
            $cmsPages = \Mage::getModel('Model\CmsPage');
            $cmsPages = $cmsPages->fetchAll();
           
        }
        $this->cmsPages = $cmsPages;
        //print_r($cmsPages); die();
        return $this;
    }

    public function getCmsPages() 
    {
        if (!$this->cmsPages) {
            $this->setCmsPages();
        }
        return $this->cmsPages;
    }
    
}
?>
