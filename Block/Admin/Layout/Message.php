<?php

namespace Block\Admin\Layout;
\Mage::loadFileByClassName('Block\Core\Template');
\Mage::loadFileByClassName('Controller\Core\Admin');

class Message extends \Block\Core\Template
{
    public function __construct() {
        $this->setTemplate('./View/core/layout/message.php');
       // $this->setController(Mage::getController(Controller_Admin_Core_Admin));
    }
}

?>