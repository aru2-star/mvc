<?php
namespace Block\Admin\Brand;
\Mage::loadFileByClassName('Block\Core\Template');
\Mage::loadFileByClassName('Model\Brand');

class Grid extends \Block\Core\Template{
    protected $brands = [];

    public function __construct()
    {
       $this->setTemplate('./View/admin/brand/grid.php'); 
    }

    public function setBrands($brands =NULL) {

            if(!$brands) {
                $brands = \Mage::getModel('Model\Brand');
                $brands = $brands->fetchAll();
            }
            $this->brands = $brands;
            return $this;
    }

    public function getBrands() {
        if (!$this->brands) {
            $this->setBrands();
        }
        return $this->brands;
    }

}