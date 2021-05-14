<?php

namespace Block\Admin\Layout;
\Mage::loadFileByClassName('Block\Core\Template');
class Left extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate('./View/admin/layout/left.php');
    }
}

?>