<?php
namespace Block\Admin\Shipping;
\Mage::loadFileByClassName('Block\Core\Template');
\Mage::loadFileByClassName('Model\Shipping');

class Grid extends \Block\Core\Template
{
    protected $shippings = [];

    public function __construct() {
        $this->setTemplate('./View/admin/shipping/grid.php');
    }

    public function setShippings($shippings = NULL) {
        if(!$shippings) {
            $shippings = \Mage::getModel('Model\Shipping');
            $shippings = $shippings->fetchAll();
           
        }
        $this->shippings = $shippings;
        //print_r($shippings); die();
        return $this;
    }

    public function getShippings() 
    {
        if (!$this->shippings) {
            $this->setShippings();
        }
        return $this->shippings;
    }
    
}
?>
