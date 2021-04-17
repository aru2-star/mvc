<?php
namespace Block\Admin;
\Mage::loadFileByClassName('Block\Core\Layout');

class Layout extends \Block\Core\Layout 
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/layout.php');
    }

}
?>