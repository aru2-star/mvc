<?php
namespace Block\Admin\Layout;
\Mage::loadFileByClassName('Block\Core\Template');

class Head extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate('./View/admin/layout/head.php');
    }
}

?>