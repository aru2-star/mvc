<?php
namespace Block\Customer\Layout;

\Mage::loadFileByClassName('Block\Core\Template');

class Content extends \Block\Core\Template
{
    public function __construct() {
        $this->setTemplate('./View/customer/layout/content.php');
    }
}

?>