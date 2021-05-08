<?php

namespace Block\Admin\Layout;
\Mage::loadFileByClassName('Block\Core\Template');

class Message extends \Block\Core\Template 
{
    public function __construct()
    {
        $this->setTemplate('./View/admin/layout/message.php');
    }

}


?>